<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Middleware;
use App\Models\Booking;
use App\Models\City;
use App\Models\Driver;
use App\Models\Instructor;
use App\Models\PassengerUser;
use App\Models\Vehicle;
use Auth;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BookingController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('new-booking-list', only: ['list'])];
    }

    public function list(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();
        $user_branch = $user->branch_id;

        if ($request->ajax()) {
            if ($role == 'Admin') {
                $data = DB::table('bookings')->join('passenger_users', 'passenger_users.id', '=', 'bookings.passenger_id')->join('tbl_city', 'tbl_city.id', '=', 'bookings.pickup_location')->where('bookings.booking_status', 'pending')->select('bookings.*', 'passenger_users.first_name', 'passenger_users.phone_number', 'tbl_city.name as pickup')->orderBy('bookings.created_at', 'asc');
            } elseif ($role == 'Branch Manager') {
                $data = DB::table('bookings')->join('passenger_users', 'passenger_users.id', '=', 'bookings.passenger_id')->join('tbl_city', 'tbl_city.id', '=', 'bookings.pickup_location')->where('tbl_city.branch_id', $user_branch)->where('bookings.booking_status', 'pending')->select('bookings.*', 'passenger_users.first_name', 'passenger_users.phone_number', 'tbl_city.name as pickup')->orderBy('bookings.created_at', 'asc');
            }

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

        return view('admin.booking.new.list');
    }

    public function view($id)
    {
        $id = decrypt($id);
        $booking = Booking::find($id);

        $check_in = date('l', strtotime($booking->check_in)); // e.g., "Monday"

        // Convert to lowercase to match your stored data
        $check_in_day = strtolower($check_in); // "monday"

        $cities = City::where('is_delete', 0)->where('status', 'Y')->get();

        $pickupLocation = City::where('id', $booking->pickup_location)->first()->name ?? '';
        $returnLocation = City::where('id', $booking->return_location)->first()->name ?? '';

        $vehicle = Vehicle::where('id', $booking->vehicle_id)->first();
        $passenger = PassengerUser::where('id', $booking->passenger_id)->first();

        // ✅ Correct way to filter drivers
        $drivers = Driver::where('is_delete', 0)
            ->where('city_id', $booking->pickup_location)
            ->whereJsonContains('available_days', $check_in_day) // Important
            ->where('approve_status', 'approved')
            ->where('availability', 'Y')
            ->get();
        $instructors = Instructor::where('is_delete', 0)
            ->where('city_id', $booking->pickup_location)
            ->whereJsonContains('available_days', $check_in_day) // Important
            ->where('approve_status', 'approved')
            ->where('availability', 'Y')
            ->get();

        return view('admin.booking.new.view_detail', compact('booking', 'cities', 'pickupLocation', 'returnLocation', 'vehicle', 'passenger', 'drivers', 'instructors'));
    }

    public function saveAction(Request $request)
    {
        $bookingId = $request->bookingId;
        $booking = Booking::find($bookingId);

        if ($request->action == 'Approve') {
            $booking->booking_status = 'Approve';

            if ($request->driver_id != null) {
                $driver = Driver::find($request->driver_id);
                $driver->availability = 'N';
                $driver->save();

                $booking->driver_id = $request->driver_id;

                $to_email = $driver->email;
                $bcc_email = 'geeshanmadarasinghe@gmail.com';
                $baseUrl = config('app.url');

                \Mail::send('email.trip_request_driver_mail', ['data' => $booking, 'baseUrl' => $baseUrl], function ($message) use ($to_email, $bcc_email) {
                    $message->from('rent.tuk123@gmail.com', 'Tuk Tuk');
                    $message->to($to_email)->bcc($bcc_email)->subject('New Trip Request');
                });
            }
            if ($request->instructor_id != null) {
                $instructor = Instructor::find($request->instructor_id);
                $instructor->availability = 'N';
                $instructor->save();

                $booking->instructor_id = $request->instructor_id;

                $to_email = $instructor->email;
                $bcc_email = 'geeshanmadarasinghe@gmail.com';
                $baseUrl = config('app.url');

                \Mail::send('email.session_request_instructor_mail', ['data' => $booking, 'baseUrl' => $baseUrl], function ($message) use ($to_email, $bcc_email) {
                    $message->from('rent.tuk123@gmail.com', 'Tuk Tuk');
                    $message->to($to_email)->bcc($bcc_email)->subject('New Instructer Session Request');
                });
            }

            $booking->save();
            return redirect()->route('new-booking-list')->with('success', 'Booking approved successfully');
        }

        if ($request->action == 'Reject') {
            $booking->booking_status = 'Reject';
            $booking->save();
            return redirect()->route('new-booking-list')->with('success', 'Booking rejected successfully');
        }
    }

      public function acceptedList(Request $request)
    {
        $user = Auth::guard('web')->user();
        $role = $user->role();
        $user_branch = $user->branch_id;

        if ($request->ajax()) {
            if ($role == 'Admin') {
                $data = DB::table('bookings')->join('passenger_users', 'passenger_users.id', '=', 'bookings.passenger_id')->join('tbl_city', 'tbl_city.id', '=', 'bookings.pickup_location')->where('bookings.booking_status', 'Approve')->select('bookings.*', 'passenger_users.first_name', 'passenger_users.phone_number', 'tbl_city.name as pickup')->orderBy('bookings.created_at', 'asc');
            } elseif ($role == 'Branch Manager') {
                $data = DB::table('bookings')->join('passenger_users', 'passenger_users.id', '=', 'bookings.passenger_id')->join('tbl_city', 'tbl_city.id', '=', 'bookings.pickup_location')->where('tbl_city.branch_id', $user_branch)->where('bookings.booking_status', 'Approve')->select('bookings.*', 'passenger_users.first_name', 'passenger_users.phone_number', 'tbl_city.name as pickup')->orderBy('bookings.created_at', 'asc');
            }

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

        return view('admin.booking.accepted.list');
    }
}