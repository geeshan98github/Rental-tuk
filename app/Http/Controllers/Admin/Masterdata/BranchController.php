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
use App\Models\Branch;

class BranchController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('branches-list|branches-create|branches-edit|branches-delete', only: ['list', 'view']), new Middleware('branches-create', only: ['index', 'store']), new Middleware('branches-edit', only: ['edit', 'update']), new Middleware('branches-delete', only: ['destroy'])];
    }

    public function list(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();

        if ($request->ajax()) {
            $data = Branch::where('is_delete', 0)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {
                    $edit_url = url('adminpanel/branches-edit', encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fal fa-edit"></i></a>';
                    return $btn;
                })
                ->addColumn('activation', function ($row) {
                    if ($row->status == 'Y') {
                        $status = 'fal fa-check';
                    } else {
                        $status = 'fal fa-backspace';
                    }

                    $url = url('adminpanel/changestatus-branches', $row->id);
                    $btn = '<a href="' . $url . '"><i class="' . $status . '"></i></a>';

                    return $btn;
                })

                ->addColumn('branches-delete', 'admin.masterdata.branch.actionsBlock')

                ->rawColumns(['edit', 'activation', 'branches-delete'])
                ->make(true);
        }

        return view('admin.masterdata.branch.list');
    }

    public function index(Request $request)
    {
        return view('admin.masterdata.branch.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = [
            'name' => $request->name,

            'status' => $request->status,
        ];

        $record = Branch::create($data);

        Event::dispatch(new LoggableEvent($record, 'created'));

        return redirect()->route('branches-list')->with('success', 'Successfully saved the record.');
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $data = Branch::find($id);

        return view('admin.masterdata.branch.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $record = Branch::find($id);

        $request->validate([
            'name' => 'required',
        ]);

        $data = [
            'name' => $request->name,

            'status' => $request->status,
        ];
        $record->update($data);
       
        DB::commit();

        // Dispatch Activity Event to log this creation
        Event::dispatch(new LoggableEvent($record, 'update'));

        return redirect()->route('branches-list')->with('success', 'Record updated successfully');
    }

    public function activation(Request $request)
    {
        $data = Branch::find($request->id);

        if ($data->status == 'Y') {
            $data->status = 'N';
            $data->save();
            $id = $data->id;

            Event::dispatch(new LoggableEvent($data, 'status-change'));

            return redirect()->route('branches-list')->with('success', 'Record deactivate successfully.');
        } else {
            $data->status = 'Y';
            $data->save();
            $id = $data->id;

            Event::dispatch(new LoggableEvent($data, 'status-change'));

            return redirect()->route('branches-list')->with('success', 'Record activate successfully.');
        }
    }

    public function destroy(Request $request)
    {
        $data = Branch::find($request->id);
        $data->is_delete = 1;
        $data->save();
        $id = $data->id;

        Event::dispatch(new LoggableEvent($data, 'delete'));

        return redirect()->route('branches-list')->with('success', 'Record deleted successfully.');
    }
}