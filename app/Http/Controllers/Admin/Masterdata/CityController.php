<?php

namespace App\Http\Controllers\Admin\Masterdata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use App\Models\City;

class CityController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('cities-list|cities-create|cities-edit|cities-delete', only: ['list', 'view']), new Middleware('cities-create', only: ['index', 'store']), new Middleware('cities-edit', only: ['edit', 'update']), new Middleware('cities-delete', only: ['destroy'])];
    }

    public function list(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();

        if ($request->ajax()) {
            //join city with branch table
            $data = DB::table('tbl_city')->join('tbl_branches', 'tbl_city.branch_id', '=', 'tbl_branches.id')->select('tbl_city.*', 'tbl_branches.name as branch_name')->where('tbl_city.is_delete', 0)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {
                    $edit_url = url('adminpanel/cities-edit', encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fal fa-edit"></i></a>';
                    return $btn;
                })
                ->addColumn('activation', function ($row) {
                    if ($row->status == 'Y') {
                        $status = 'fal fa-check';
                    } else {
                        $status = 'fal fa-backspace';
                    }

                    $url = url('adminpanel/changestatus-cities', $row->id);
                    $btn = '<a href="' . $url . '"><i class="' . $status . '"></i></a>';

                    return $btn;
                })

                ->addColumn('cities-delete', 'admin.masterdata.city.actionsBlock')

                ->rawColumns(['edit', 'activation', 'cities-delete'])
                ->make(true);
        }

        return view('admin.masterdata.city.list');
    }

    public function index(Request $request)
    {
        $branches = DB::table('tbl_branches')->where('is_delete', 0)->get();
        return view('admin.masterdata.city.index', compact('branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'branch_id' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'branch_id' => $request->branch_id,

            'status' => $request->status,
        ];

        $record = City::create($data);

        Event::dispatch(new LoggableEvent($record, 'created'));

        return redirect()->route('cities-list')->with('success', 'Successfully saved the record.');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = City::find($id);
        $branches = DB::table('tbl_branches')->where('is_delete', 0)->get();
        return view('admin.masterdata.city.edit', compact('data', 'branches'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $record = City::find($id);

        $data = [
            'name' => $request->name,
            'branch_id' => $request->branch_id,

            'status' => $request->status,
        ];

       
        $record->update($data);

        DB::commit();

        // Dispatch Activity Event to log this creation
        Event::dispatch(new LoggableEvent($record, 'update'));

        return redirect()->route('cities-list')->with('success', 'Record updated successfully');
    }

    public function activation(Request $request)
    {
        $data = City::find($request->id);

        if ($data->status == 'Y') {
            $data->status = 'N';
            $data->save();
            $id = $data->id;

            Event::dispatch(new LoggableEvent($data, 'status-change'));

            return redirect()->route('cities-list')->with('success', 'Record deactivate successfully.');
        } else {
            $data->status = 'Y';
            $data->save();
            $id = $data->id;

            Event::dispatch(new LoggableEvent($data, 'status-change'));

            return redirect()->route('cities-list')->with('success', 'Record activate successfully.');
        }
    }

    public function destroy(Request $request)
    {
        $data = City::find($request->id);
        $data->is_delete = 1;
        $data->save();
        $id = $data->id;

        Event::dispatch(new LoggableEvent($data, 'delete'));

        return redirect()->route('cities-list')->with('success', 'Record deleted successfully.');
    }
}