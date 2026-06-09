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
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\Branch;

class VehicleController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('vehicle-list|vehicles-create|vehicles-edit|vehicles-delete', only: ['list', 'view']), new Middleware('vehicles-create', only: ['index', 'store']), new Middleware('vehicles-edit', only: ['edit', 'update']), new Middleware('vehicles-delete', only: ['destroy'])];
    }

    public function list(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();

        if ($request->ajax()) {
            //join vehicle with branch table
            $data = DB::table('vehicle_details')->join('tbl_branches', 'vehicle_details.branch_id', '=', 'tbl_branches.id')->join('vehicle_types', 'vehicle_details.type_id', '=', 'vehicle_types.id')->select('vehicle_details.*', 'tbl_branches.name as branch_name', 'vehicle_types.name as type_name')->where('vehicle_details.is_delete', 0)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {
                    $edit_url = url('adminpanel/vehicle-edit', encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fal fa-edit"></i></a>';
                    return $btn;
                })
                ->addColumn('activation', function ($row) {
                    if ($row->status == 'Y') {
                        $status = 'fal fa-check';
                    } else {
                        $status = 'fal fa-backspace';
                    }

                    $url = url('adminpanel/changestatus-vehicle', $row->id);
                    $btn = '<a href="' . $url . '"><i class="' . $status . '"></i></a>';

                    return $btn;
                })
                ->addColumn('thumbnail', function ($row) {

                    $btn = '<img src="' . url('storage/app/private/' . $row->thumbnail) . '" style="height:50px;width:80px;object-fit:cover;border-radius:4px;">';
                    return $btn;
                })

                ->addColumn('vehicle-delete', 'admin.masterdata.vehicle.actionsBlock')

                ->rawColumns(['edit', 'activation', 'thumbnail', 'vehicle-delete'])
                ->make(true);
        }

        return view('admin.masterdata.vehicle.list');
    }

    public function index(Request $request)
    {
        $branches = DB::table('tbl_branches')->where('is_delete', 0)->get();
        $vehicleTypes = DB::table('vehicle_types')->where('is_delete', 0)->get();
        return view('admin.masterdata.vehicle.index', compact('branches', 'vehicleTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehicle_number' => 'required',
            'branch_id' => 'required',
            'type_id' => 'required',
            'thumbnail' => 'required',
        ]);

        if (!$request->file('thumbnail') == '') {
            $thumbnail = $request->file('thumbnail')->getClientOriginalName();

            $thumbnail = $request->file('thumbnail')->store('public/documents');
        } else {
            $thumbnail = '';
        }


        $data = [
            'vehicle_number' => $request->vehicle_number,
            'branch_id' => $request->branch_id,
            'type_id' => $request->type_id,
            'thumbnail' =>  $thumbnail,

            'status' => $request->status,
        ];

        $record = Vehicle::create($data);

        Event::dispatch(new LoggableEvent($record, 'created'));

        return redirect()->route('vehicle-list')->with('success', 'Successfully saved the record.');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = Vehicle::find($id);
        $branches = DB::table('tbl_branches')->where('is_delete', 0)->get();
        $vehicleTypes = DB::table('vehicle_types')->where('is_delete', 0)->get();
        return view('admin.masterdata.vehicle.edit', compact('data', 'branches', 'vehicleTypes'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $record = Vehicle::find($id);

         $request->validate([
            'vehicle_number' => 'required',
            'branch_id' => 'required',
            'type_id' => 'required',
           
        ]);

        if (!$request->file('thumbnail') == '') {
            $thumbnail = $request->file('thumbnail')->getClientOriginalName();

            $thumbnail = $request->file('thumbnail')->store('public/documents');
        } else {
            $thumbnail = $record->thumbnail;
        }

        $data = [
           'vehicle_number' => $request->vehicle_number,
            'branch_id' => $request->branch_id,
            'type_id' => $request->type_id,
            'thumbnail' =>  $thumbnail,
        ];

        $record->update($data);

        DB::commit();

        // Dispatch Activity Event to log this creation
        Event::dispatch(new LoggableEvent($record, 'update'));

        return redirect()->route('vehicle-list')->with('success', 'Record updated successfully');
    }

    public function activation(Request $request)
    {
        $data = Vehicle::find($request->id);

        if ($data->status == 'Y') {
            $data->status = 'N';
            $data->save();
            $id = $data->id;

            Event::dispatch(new LoggableEvent($data, 'status-change'));

            return redirect()->route('vehicle-list')->with('success', 'Record deactivate successfully.');
        } else {
            $data->status = 'Y';
            $data->save();
            $id = $data->id;

            Event::dispatch(new LoggableEvent($data, 'status-change'));

            return redirect()->route('vehicle-list')->with('success', 'Record activate successfully.');
        }
    }

    public function destroy(Request $request)
    {
        $data = Vehicle::find($request->id);
        $data->is_delete = 1;
        $data->save();
        $id = $data->id;

        Event::dispatch(new LoggableEvent($data, 'delete'));

        return redirect()->route('vehicle-list')->with('success', 'Record deleted successfully.');
    }
}