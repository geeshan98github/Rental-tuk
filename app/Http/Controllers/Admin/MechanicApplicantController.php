<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mechanic;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\Middleware;
use App\Events\LoggableEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Auth;
use App\Models\User;

class MechanicApplicantController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('mechanic-applicant-list', only: ['list', 'view'])];
    }

    public function list(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();
        $user_branch = $user->branch_id;

        if ($request->ajax()) {
            if ($role == 'Admin') {
                $data = Mechanic::where('is_delete', 0)->where('approve_status', 'ongoing')->orderBy('created_at', 'asc');
            } elseif ($role == 'Branch Manager') {
                $data = DB::table('applicants_for_mechanic')->join('tbl_city', 'tbl_city.id', '=', 'applicants_for_mechanic.city_id')->where('tbl_city.branch_id', $user_branch)->where('applicants_for_mechanic.is_delete', 0)->where('applicants_for_mechanic.approve_status', 'pending')->select('applicants_for_mechanic.*')->orderBy('applicants_for_mechanic.created_at', 'asc');
            } else {
                //empty data for other roles
                $data = Mechanic::where('id', 0); // This will return an empty collection
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('view', function ($row) {
                    $view_url = url('adminpanel/view-mechanic-applicant/' . encrypt($row->id) . '');
                    $btn = '<a href="' . $view_url . '"><i class="fal fa-file"></i></a>';
                    return $btn;
                })

                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y H:i:s', strtotime($row->created_at));
                })
                ->rawColumns(['view'])

                ->make(true);
        }

        return view('admin.mechanic.list');
    }

    public function view(Request $request)
    {
        $id = decrypt($request->id);
        $data = Mechanic::find($id);
        return view('admin.mechanic.index', compact('data'));
    }

    public function sendApprovel(Request $request)
    {
        $data = Mechanic::find($request->id);

        $data->update([
            'approve_status' => 'ongoing',
        ]);
        return redirect()->route('mechanic-applicant-list')->with('success', 'Send to Approval Successfully');
    }

    public function action(Request $request)
    {
        $id = $request->id;
        return view('admin.mechanic.action', compact('id'));
    }

    public function saveAction(Request $request)
    {
        $data = Mechanic::find($request->id);

        $length = 8; // adjust the length to your needs
        $password = Str::random($length);
        $name = $data->first_name;
        $email = $data->email;

        $input = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ];

        if ($request->action == 'Approve') {
            $data->update([
                'approve_status' => 'approved',
            ]);

            $user = User::create($input);

            $user->assignRole('Mechanics');
            $data->update([
                'user_id' => $user->id,
            ]);

            $to_email = $user->email;
            $bcc_email = 'geeshanmadarasinghe@gmail.com';
            $baseUrl = config('app.url');

            \Mail::send('email.account_detail_mail', ['data' => $user, 'baseUrl' => $baseUrl, 'password' => $password], function ($message) use ($to_email, $bcc_email) {
                $message->from('rent.tuk123@gmail.com', 'Tuk Tuk');
                $message->to($to_email)->bcc($bcc_email)->subject('Account Details');
            });
            return redirect()->route('mechanic-applicant-list')->with('success', 'Approved Successfully');
        }
        if ($request->action == 'Reject') {
            $data->update([
                'approve_status' => 'rejected',
            ]);
            return redirect()->route('mechanic-applicant-list')->with('success', 'Rejected Successfully');
        }
    }
}