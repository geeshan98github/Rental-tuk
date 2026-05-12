<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogActivity;
use App\Models\User;
use App\Models\LabourOfficeDivision;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Middleware\Middleware;

class LogActivityController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('log-activity-list', only: ['list'])];
    }

    public function index()
    {
        return view('admin.logs.list');
    }

    public function list(Request $request)
    {

        
        $users = User::where('status', 'Y')->where('is_delete', 0)->get();

        $roles = Role::select('id', 'name')->get();

       
        if ($request->ajax()) {
            $data = LogActivity::leftJoin('users', 'users.id', '=', 'activities.user_id')
            ->select('activities.id', 'activities.description', 'activities.url', 'activities.method', 'activities.ip', 'activities.created_at', 'users.name as user_name');

            

            return DataTables::of($data)
                ->addIndexColumn()
                 ->editColumn('created_at', function ($request) {
                    return $request->created_at->format('Y-m-d'); // human readable format
                })
                ->editColumn('time', function ($request) {
                    return $request->created_at->format('H:i:s'); // human readable format
                })

                ->rawColumns(['created_at', 'time', 'blocklog'])
                ->make(true);
        }

        return view('admin.logs.list', compact('users'));
    }

    public function block(Request $request)
    {
        $request->validate([
            // 'status' => 'required'
        ]);

        $data = LogActivity::find($request->id);
        $data->is_delete = 1;
        $data->save();

        // \LogActivity::addToLog('Log activity record id '.$request->id.' deleted.');

        return redirect()->route('log-activity-list')->with('success', 'Record deleted successfully.');
    }
}
