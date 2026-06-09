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
use App\Models\Driver;

class DriverController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('driver-availability-calendar', only: ['index'])];
    }

    public function index()
    {
        $userId = Auth::id();
        $data = Driver::where('user_id', $userId)->first();
        return view('admin.driver.calendar', compact('data'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();
        $data = Driver::where('user_id', $userId)->first();

        $data->available_days = $request->input('days', []); // No json_encode needed
        $data->save();

        return redirect()->route('driver-availability-calendar')->with('success', 'Successfully saved the record.');
    }

    public function list(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();

        if ($request->ajax()) {
            $data = DB::table('bookings')->join('passenger_users', 'passenger_users.id', '=', 'bookings.passenger_id')->join('tbl_city', 'tbl_city.id', '=', 'bookings.pickup_location')->where('bookings.trip_status', 'Pending')->where('bookings.driver_id', $user->id)->where('bookings.booking_status', 'Approve')->where('bookings.booking_status', 'Approve')->select('bookings.*', 'passenger_users.first_name', 'passenger_users.phone_number', 'tbl_city.name as pickup')->orderBy('bookings.created_at', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                // set view column
                ->addColumn('view', function ($row) {
                    $view_url = url('adminpanel/view-booking-details/' . encrypt($row->id) . '');
                    $btn = '<a href="' . $view_url . '"><i class="fal fa-file"></i></a>';

                    return $btn;
                })
                ->rawColumns(['view'])
                ->make(true);
        }

        return view('admin.driver.trip.list');
    }
    public function ongoingList(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();

        if ($request->ajax()) {
            $data = DB::table('bookings')->join('passenger_users', 'passenger_users.id', '=', 'bookings.passenger_id')->join('tbl_city', 'tbl_city.id', '=', 'bookings.pickup_location')->where('bookings.trip_status', 'Ongoing')->where('bookings.driver_id', $user->id)->where('bookings.booking_status', 'Approve')->where('bookings.booking_status', 'Approve')->select('bookings.*', 'passenger_users.first_name', 'passenger_users.phone_number', 'tbl_city.name as pickup')->orderBy('bookings.created_at', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                // set view column
                ->addColumn('view', function ($row) {
                    $view_url = url('adminpanel/view-booking-details/' . encrypt($row->id) . '');
                    $btn = '<a href="' . $view_url . '"><i class="fal fa-file"></i></a>';

                    return $btn;
                })
                ->rawColumns(['view'])
                ->make(true);
        }

        return view('admin.driver.trip.ongoinglist');
    }
    public function completedList(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();

        if ($request->ajax()) {
            $data = DB::table('bookings')->join('passenger_users', 'passenger_users.id', '=', 'bookings.passenger_id')->join('tbl_city', 'tbl_city.id', '=', 'bookings.pickup_location')->where('bookings.trip_status', 'Completed')->where('bookings.driver_id', $user->id)->where('bookings.booking_status', 'Approve')->where('bookings.booking_status', 'Approve')->select('bookings.*', 'passenger_users.first_name', 'passenger_users.phone_number', 'tbl_city.name as pickup')->orderBy('bookings.created_at', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                // set view column
                ->addColumn('view', function ($row) {
                    $view_url = url('adminpanel/view-booking-details/' . encrypt($row->id) . '');
                    $btn = '<a href="' . $view_url . '"><i class="fal fa-file"></i></a>';

                    return $btn;
                })
                ->rawColumns(['view'])
                ->make(true);
        }

        return view('admin.driver.trip.completedlist');
    }
}