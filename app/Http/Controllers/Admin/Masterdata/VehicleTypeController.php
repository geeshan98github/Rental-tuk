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
use App\Models\User;
use App\Models\VehicleType;

class VehicleTypeController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('vehicle-type-list|vehicle-type-create|vehicle-type-edit|vehicle-type-delete', only: ['list', 'view']), new Middleware('vehicle-type-create', only: ['index', 'store']), new Middleware('vehicle-type-edit', only: ['edit', 'update']), new Middleware('vehicle-type-delete', only: ['destroy'])];
    }

    public function list(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();

        if ($request->ajax()) {
            $data = VehicleType::where('is_delete', 0)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {
                    $edit_url = url('adminpanel/vehicle-type-edit', encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fal fa-edit"></i></a>';
                    return $btn;
                })
                ->addColumn('activation', function ($row) {
                    if ($row->status == 'Y') {
                        $status = 'fal fa-check';
                    } else {
                        $status = 'fal fa-backspace';
                    }

                    $url = url('adminpanel/changestatus-vehicle-type', $row->id);
                    $btn = '<a href="' . $url . '"><i class="' . $status . '"></i></a>';

                    return $btn;
                })

                ->addColumn('vehicle-type-delete', 'admin.masterdata.vehicle_type.actionsBlock')

                ->rawColumns(['edit', 'activation', 'vehicle-type-delete'])
                ->make(true);
        }

        return view('admin.masterdata.vehicle_type.list');
    }

    public function index(Request $request)
    {
        return view('admin.masterdata.vehicle_type.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required',
            'rate_per_day' => 'required',
            'deposit_price' => 'required',
        ]);

        $data = [
            'name' => $request->type_name,
            'rate_per_day' => $request->rate_per_day,
            'deposit_price' => $request->deposit_price,
            'status' => $request->status,
        ];

        $record = VehicleType::create($data);

        Event::dispatch(new LoggableEvent($record, 'created'));

        return redirect()->route('vehicle-type-list')->with('success', 'Successfully saved the record.');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = VehicleType::find($id);

        return view('admin.masterdata.vehicle_type.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $record = VehicleType::find($id);

        $request->validate([
            'type_name' => 'required',
            'rate_per_day' => 'required',
            'deposit_price' => 'required',
        ]);

        $data = [
            'name' => $request->type_name,
            'rate_per_day' => $request->rate_per_day,
            'deposit_price' => $request->deposit_price,
            'status' => $request->status,
        ];
        $record->update($data);

        DB::commit();

        // Dispatch Activity Event to log this creation
        Event::dispatch(new LoggableEvent($record, 'update'));

        return redirect()->route('vehicle-type-list')->with('success', 'Record updated successfully');
    }

    public function activation(Request $request)
    {
        $data = VehicleType::find($request->id);

        if ($data->status == 'Y') {
            $data->status = 'N';
            $data->save();
            $id = $data->id;

            Event::dispatch(new LoggableEvent($data, 'status-change'));

            return redirect()->route('vehicle-type-list')->with('success', 'Record deactivate successfully.');
        } else {
            $data->status = 'Y';
            $data->save();
            $id = $data->id;

            Event::dispatch(new LoggableEvent($data, 'status-change'));

            return redirect()->route('vehicle-type-list')->with('success', 'Record activate successfully.');
        }
    }

    public function destroy(Request $request)
    {
        $data = VehicleType::find($request->id);
        $data->is_delete = 1;
        $data->save();
        $id = $data->id;

        Event::dispatch(new LoggableEvent($data, 'delete'));

        return redirect()->route('vehicle-type-list')->with('success', 'Record deleted successfully.');
    }
}