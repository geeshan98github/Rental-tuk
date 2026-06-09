<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Library\MobitelSms;
use App\Models\SmsTemplate;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Events\LoggableEvent;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Event;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Driver;
use App\Models\Instructor;
use App\Models\Mechanic;
use App\Models\Branch;
use Auth;


class UserController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('user-list|user-create|user-edit|user-delete', only: ['list']), new Middleware('user-create', only: ['index', 'store']), new Middleware('user-edit', only: ['edit', 'update']), new Middleware('user-delete', only: ['destroy'])];
    }

    public function index()
    {
        $roles = Role::pluck('name', 'name')->all();
        $branches = Branch::where('is_delete', 0)->where('status', 'Y')->get();
        return view('admin.users.index', compact('roles', 'branches'));
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('is_delete', 0)->orderBy('id', 'DESC');
            //var_dump($data); exit();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {
                    $edit_url = url('adminpanel/user-edit', encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fal fa-edit"></i></a>';
                    return $btn;
                })
                ->addColumn('role', function ($row) {
                    $v = '';
                    if (!empty($row->getRoleNames())) {
                        foreach ($row->getRoleNames() as $v) {
                            $v;
                        }
                    }
                    return $v;
                })
                ->addColumn('activation', function ($row) {
                    if ($row->status == 'Y') {
                        $status = 'fal fa-check';
                    } else {
                        $status = 'fal fa-backspace';
                    }

                    $url = url('adminpanel/changestatus-user', $row->id);
                    $btn = '<a href="' . $url . '"><i class="' . $status . '"></i></a>';

                    return $btn;
                })

                ->addColumn('user-delete', 'admin.users.actionsBlock')
                ->rawColumns(['edit', 'role', 'activation', 'user-delete'])
                ->make(true);
        }

        return view('admin.users.list');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm_password',
            'roles' => 'required',
            
        ]);

        try {
            DB::beginTransaction();

            $input = $request->all();
            $input['password'] = Hash::make($input['password']);

            $user = User::create($input);
            $user->assignRole($request->input('roles'));

            DB::commit();

            Event::dispatch(new LoggableEvent($user, 'created'));

            return redirect()->route('user-list')->with('success', 'User created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical('Exception in createBay : ', [$e->getMessage()]);
            return redirect()->back()->withInput()->with('error', 'User not created successfully');
        }
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $branches = Branch::where('is_delete', 0)->where('status', 'Y')->get();
        $userRole = $user->roles->pluck('name')->first();

        return view('admin.users.edit', compact('user', 'roles', 'branches', 'userRole'));
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm_password',
            'roles' => 'required',
        ]);

        $input = $request->all();
       
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);

        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));
        // Dispatch Activity Event to log this creation
        Event::dispatch(new LoggableEvent($user, 'update'));
        return redirect()->route('user-list')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $id = decrypt($id);

        try {
            DB::beginTransaction();

            $user = User::find($id);
            $user->is_delete = 1;
            $user->update();

            DB::commit();

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($user, 'deleted'));

            return redirect()->route('user-list')->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::critical('Exception in deleteBay : ', [$e->getMessage()]);
            return redirect()->route('user-list')->with('error', 'User not deleted successfully');
        }
    }

    public function activation(Request $request)
    {
        $data = User::find($request->id);

        if ($data->status == 'Y') {
            $data->status = 'N';
            $data->save();
            $id = $data->id;

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'statuschange'));

            return redirect()->route('user-list')->with('success', 'Record deactivate successfully.');
        } else {
            $data->status = 'Y';
            $data->save();
            $id = $data->id;

            // Dispatch Activity Event to log this creation
            Event::dispatch(new LoggableEvent($data, 'statuschange'));
            return redirect()->route('user-list')->with('success', 'Record activate successfully.');
        }
    }

    public function checkEmailAvailability(Request $request)
    {
        // echo $request->startTime;
        //   exit();
        // \DB::enableQueryLog();
        $users = User::where('email', $request->email)->get();
        // $events = \DB::getQueryLog();
        // print_r($events);
        // exit();

        return response()->json($users);
    }

    public function editProfile($id)
    {
        $id = decrypt($id);
        $user = User::find($id);

        $user = Auth::guard('web')->user();
        $role = $user->role();

        if ($role == 'Driver') {
            $data = Driver::where('email', $user->email)->first();
        } elseif ($role == 'Mechanics') {
            $data = Mechanic::where('email', $user->email)->first();
        } elseif ($role == 'Instructors') {
            $data = Admin::where('email', $user->email)->first();
        } else {
            $data = '';
        }

        return view('admin.users.profile', compact('user', 'data'));
    }

    public function updateProfile(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required|string|max:100',
            'password' => 'same:confirm_password',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }

        $user = User::find($id);
        $user->update($input);

        // Dispatch Activity Event to log this creation
        Event::dispatch(new LoggableEvent($user, 'update'));
        return back()->with('success', 'profile updated successfully');
    }
}