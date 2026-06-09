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
use App\Models\ServiceFee;

class ServiceFeeController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('service-fee-list|service-fee-create|service-fee-edit|service-fee-delete', only: ['list', 'view']), new Middleware('service-fee-create', only: ['index', 'store']), new Middleware('service-fee-edit', only: ['edit', 'update']), new Middleware('service-fee-delete', only: ['destroy'])];
    }

    public function list(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();

        if ($request->ajax()) {
            $data = ServiceFee::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {
                    $edit_url = url('adminpanel/service-fee-edit', encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fal fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.masterdata.service_fee.list');
    }

    public function index(Request $request)
    {
        return view('admin.masterdata.service_fee.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'price' => 'required',
            'service' => 'required',
        ]);

        $data = [
            'service' => $request->service,
            'price' => $request->price,
        ];

        $record = ServiceFee::create($data);

        Event::dispatch(new LoggableEvent($record, 'created'));

        return redirect()->route('service-fee-list')->with('success', 'Successfully saved the record.');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = ServiceFee::find($id);

        return view('admin.masterdata.service_fee.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $record = ServiceFee::find($id);

        $request->validate([
            'price' => 'required',
            'service' => 'required',

        ]);

        $data = [
            'service' => $request->service,
            'price' => $request->price,
        ];
        $record->update($data);

        DB::commit();

        // Dispatch Activity Event to log this creation
        Event::dispatch(new LoggableEvent($record, 'update'));

        return redirect()->route('service-fee-list')->with('success', 'Record updated successfully');
    }
}