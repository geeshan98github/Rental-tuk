<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Driver;
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

class ApprovedDriverController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('approved-drivers-list', only: ['list', 'view'])];
    }

    public function list(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();
        $user_branch = $user->branch_id;

        if ($request->ajax()) {
            if ($role == 'Admin') {
                $data = DB::table('applicants_for_driver')->where('is_delete', 0)->where('approve_status', 'approved')->orderBy('created_at', 'asc');
            } elseif ($role == 'Branch Manager') {
                $data = DB::table('applicants_for_driver')->join('tbl_city', 'tbl_city.id', '=', 'applicants_for_driver.city_id')->where('tbl_city.branch_id', $user_branch)->where('applicants_for_driver.is_delete', 0)->where('applicants_for_driver.approve_status', 'approved')->select('applicants_for_driver.*')->orderBy('applicants_for_driver.created_at', 'asc');
            } else {
                //empty data for other roles
                $data = Driver::where('id', 0); // This will return an empty collection
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('view', function ($row) {
                    $view_url = url('adminpanel/view-driver-applicant/' . encrypt($row->id) . '');
                    $btn = '<a href="' . $view_url . '"><i class="fal fa-file"></i></a>';
                    return $btn;
                })

                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y H:i:s', strtotime($row->created_at));
                })
                ->rawColumns(['view'])

                ->make(true);
        }

        return view('admin.driver.approved_list');
    }
}