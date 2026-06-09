<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\Instructor;

class ApprovedInstructorController extends Controller
{
       public static function middleware(): array
    {
        return [new Middleware('approved-instructors-list', only: ['list', 'view'])];
    }

    public function list(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();
        $user_branch = $user->branch_id;

        if ($request->ajax()) {
            if ($role == 'Admin') {
                $data = DB::table('applicants_for_instructor')->where('is_delete', 0)->where('approve_status', 'approved')->orderBy('created_at', 'asc');
            }

            elseif ($role == 'Branch Manager') {
                $data = DB::table('applicants_for_instructor')->join('tbl_city', 'tbl_city.id', '=', 'applicants_for_instructor.city_id')->where('tbl_city.branch_id', $user_branch)->where('applicants_for_instructor.is_delete', 0)->where('applicants_for_instructor.approve_status', 'approved')->select('applicants_for_instructor.*')->orderBy('applicants_for_instructor.created_at', 'asc');
            }else{
                //empty data for other roles
                $data = Instructor::where('id', 0); // This will return an empty collection
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('view', function ($row) {
                    $view_url = url('adminpanel/view-instructor-applicant/' . encrypt($row->id) . '');
                    $btn = '<a href="' . $view_url . '"><i class="fal fa-file"></i></a>';
                    return $btn;
                })

                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y H:i:s', strtotime($row->created_at));
                })
                ->rawColumns(['view'])

                ->make(true);
        }

        return view('admin.instructor.approved_list');
    }
}