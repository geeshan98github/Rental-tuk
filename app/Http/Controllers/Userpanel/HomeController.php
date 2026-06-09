<?php

namespace App\Http\Controllers\Userpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use App\Models\City;
use App\Models\Vehicle;
use App\Models\Country;
use App\Models\PassengerUser;
use App\Models\Booking;
use App\Models\ServiceFee;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::take(10)->get();

        return view('userpanel.home', compact('cities'));
    }

    public function bookingSearch(Request $request)
    {
        $data = $request->all();

        $pickupCityId = $data['picakup_location'];
        $branchId = City::where('id', $pickupCityId)->first()->branch_id;
        $cities = City::where('is_delete', 0)->where('status', 'Y')->get();
        $vehicles = Vehicle::where('is_delete', 0)->where('status', 'Y')->where('branch_id', $branchId)->get();
        $fees = ServiceFee::orderBy('id', 'desc')->get();

        return view('userpanel.rent_step_1', compact('data', 'cities', 'vehicles', 'fees'));
    }

    public function bookingDetails(Request $request)
    {
       
        $data = $request->all();

        $checkboxes = [
            'driver_requesting', 'instructor_requesting', 'guide_requesting',
            'local_license', 'instructor_additional_session', 'baby_seat',
            'bluetooth_speakers', 'tuktuk_with_seatbelts', 'cooler'
        ];
        
        foreach($checkboxes as $chk) {
            $data[$chk] = $data[$chk] ?? 'No';
        }

        session()->put('booking_data', $data);

        $contries = Country::take(10)->get();
        $cities = City::where('is_delete', 0)->where('status', 'Y')->get();
        $vehicle = Vehicle::where('id', $data['vehicle'])->first();
        $pickupLocation = City::where('id', $data['picakup_location'])->first();
        $returnLocation = City::where('id', $data['return_location'])->first();

        return view('userpanel.rent_step_2', compact('data', 'cities', 'vehicle', 'contries', 'pickupLocation', 'returnLocation'));
    }

    public function payment(Request $request)
    {
        $bookingData = session()->get('booking_data');
        $data = $request->all();

        $totle = $data['grand_total'];
        try {
            $user = PassengerUser::where('email', $request->emailAddress)->first();

            if (!$request->file('uploadId') == '') {
                $uploadId = $request->file('uploadId')->getClientOriginalName();

                $uploadId = $request->file('uploadId')->store('public/documents');
            } else {
                $uploadId = '';
            }

            if (!$request->file('uploadLicense') == '') {
                $uploadLicense = $request->file('uploadLicense')->getClientOriginalName();

                $uploadLicense = $request->file('uploadLicense')->store('public/documents');
            } else {
                $uploadLicense = '';
            }

            if ($user) {
                $user->update([
                    'phone_number' => $request->mobileNumber,
                    'date_of_birth' => $request->birthDay ? Carbon::createFromFormat('d/m/Y', $request->birthDay)->format('Y-m-d') : null,
                    'passport_image' => $uploadId,
                    'license_image' => $uploadLicense,
                ]);
                
                $tripId = rand(100000, 999999);

                $insertData = [
                    'trip_id' => $tripId,
                    'check_in' => Carbon::createFromFormat('d/m/Y', $bookingData['check_in'])->format('Y-m-d') ?? null,
                    'pickup_time' => $bookingData['pickup_time'] ?? null,
                    'pickup_location' => $bookingData['picakup_location'] ?? null,
                    'check_out' => Carbon::createFromFormat('d/m/Y', $bookingData['check_out'])->format('Y-m-d') ?? null,
                    'return_time' => $bookingData['return_time'] ?? null,
                    'return_location' => $bookingData['return_location'] ?? null,
                    'trip_duration' => $bookingData['trip_duration'] ?? null,
                    'vehicle_id' => $bookingData['vehicle'] ?? null,
                    'extras_total' => $data['extras_total'] ?? null,
                    'sub_total' => $data['sub_total'] ?? null,
                    'grand_total' => $data['grand_total'] ?? null,
                    'driver_requesting' => $bookingData['driver_requesting'] ?? 'No',
                    'driver_first_lang' => $bookingData['driver_first_lang'] ?? null,
                    'driver_second_lang' => $bookingData['driver_second_lang'] ?? null,
                    'instructor_requesting' => $bookingData['instructor_requesting'] ?? 'No',
                    'instructor_first_lang' => $bookingData['instructor_first_lang'] ?? null,
                    'instructor_second_lang' => $bookingData['instructor_second_lang'] ?? null,
                    'guide_requesting' => $bookingData['guide_requesting'] ?? 'No',
                    'guide_first_lang' => $bookingData['guide_first_lang'] ?? null,
                    'guide_second_lang' => $bookingData['guide_second_lang'] ?? null,
                    'local_license' => $bookingData['local_license'] ?? 'No',
                    'local_license_qty' => $bookingData['local_license_qty'] ?? null,
                    'instructor_additional_session' => $bookingData['instructor_additional_session'] ?? 'No',
                    'instructor_additional_session_qty' => $bookingData['instructor_additional_session_qty'] ?? null,
                    'baby_seat' => $bookingData['baby_seat'] ?? 'No',
                    'baby_seat_qty' => $bookingData['baby_seat_qty'] ?? null,
                    'bluetooth_speakers' => $bookingData['bluetooth_speakers'] ?? 'No',
                    'bluetooth_speakers_qty' => $bookingData['bluetooth_speakers_qty'] ?? null,
                    'tuktuk_with_seatbelts' => $bookingData['tuktuk_with_seatbelts'] ?? 'No',
                    'tuktuk_with_seatbelts_qty' => $bookingData['tuktuk_with_seatbelts_qty'] ?? null,
                    'cooler' => $bookingData['cooler'] ?? 'No',
                    'cooler_qty' => $bookingData['cooler_qty'] ?? null,
                    'passenger_id' => $user->id,
                ];

                $res = Booking::create($insertData);
                session()->forget('booking_data');
                $tripData = [
                    'id' => $res->id,
                    'totle' => $totle,
                ];
                session()->put('trip_data', $tripData);

                return view('userpanel.payment');
            } else {
               
                $varification_code = rand(100000, 999999); // Generate a random verification code
                $length = 8; // adjust the length to your needs
                $password = Str::random($length);

                $data = [
                    'first_name' => $request->firstName,
                    'last_name' => $request->lastName,
                    'phone_number' => $request->mobileNumber,
                    'email' => $request->emailAddress,
                    'contry_of_residence' => $request->country,
                    'date_of_birth' => Carbon::createFromFormat('d/m/Y', $request->birthDay)->format('Y-m-d') ?? null,
                    'password' => Hash::make($password),
                    'verification_code' => $varification_code,
                    'passport_image' => $uploadId,
                    'license_image' => $uploadLicense,
                ];
                $user = PassengerUser::create($data);

                $to_email = $user->email;
                $bcc_email = 'geeshanmadarasinghe@gmail.com';
                $baseUrl = config('app.url');

                \Mail::send('userpanel.email.account_detail_mail', ['data' => $user, 'baseUrl' => $baseUrl, 'password' => $password], function ($message) use ($to_email, $bcc_email) {
                    $message->from('rent.tuk123@gmail.com', 'Tuk Tuk');
                    $message->to($to_email)->bcc($bcc_email)->subject('Account Details');
                });

                $tripId = rand(100000, 999999);

                $insertData = [
                    'trip_id' => $tripId,
                    'check_in' => Carbon::createFromFormat('d/m/Y', $bookingData['check_in'])->format('Y-m-d') ?? null,
                    'pickup_time' => $bookingData['pickup_time'] ?? null,
                    'pickup_location' => $bookingData['picakup_location'] ?? null,
                    'check_out' => Carbon::createFromFormat('d/m/Y', $bookingData['check_out'])->format('Y-m-d') ?? null,
                    'return_time' => $bookingData['return_time'] ?? null,
                    'return_location' => $bookingData['return_location'] ?? null,
                    'trip_duration' => $bookingData['trip_duration'] ?? null,
                    'vehicle_id' => $bookingData['vehicle'] ?? null,
                    'extras_total' => $data['extras_total'] ?? null,
                    'sub_total' => $data['sub_total'] ?? null,
                    'grand_total' => $data['grand_total'] ?? null,
                    'driver_requesting' => $bookingData['driver_requesting'] ?? 'No',
                    'driver_first_lang' => $bookingData['driver_first_lang'] ?? null,
                    'driver_second_lang' => $bookingData['driver_second_lang'] ?? null,
                    'instructor_requesting' => $bookingData['instructor_requesting'] ?? 'No',
                    'instructor_first_lang' => $bookingData['instructor_first_lang'] ?? null,
                    'instructor_second_lang' => $bookingData['instructor_second_lang'] ?? null,
                    'guide_requesting' => $bookingData['guide_requesting'] ?? 'No',
                    'guide_first_lang' => $bookingData['guide_first_lang'] ?? null,
                    'guide_second_lang' => $bookingData['guide_second_lang'] ?? null,
                    'local_license' => $bookingData['local_license'] ?? 'No',
                    'local_license_qty' => $bookingData['local_license_qty'] ?? null,
                    'instructor_additional_session' => $bookingData['instructor_additional_session'] ?? 'No',
                    'instructor_additional_session_qty' => $bookingData['instructor_additional_session_qty'] ?? null,
                    'baby_seat' => $bookingData['baby_seat'] ?? 'No',
                    'baby_seat_qty' => $bookingData['baby_seat_qty'] ?? null,
                    'bluetooth_speakers' => $bookingData['bluetooth_speakers'] ?? 'No',
                    'bluetooth_speakers_qty' => $bookingData['bluetooth_speakers_qty'] ?? null,
                    'tuktuk_with_seatbelts' => $bookingData['tuktuk_with_seatbelts'] ?? 'No',
                    'tuktuk_with_seatbelts_qty' => $bookingData['tuktuk_with_seatbelts_qty'] ?? null,
                    'cooler' => $bookingData['cooler'] ?? 'No',
                    'cooler_qty' => $bookingData['cooler_qty'] ?? null,
                    'passenger_id' => $user->id,
                ];

                $res = Booking::create($insertData);
                session()->forget('booking_data');
                $tripData = [
                    'id' => $res->id,
                    'totle' => $totle,
                ];
                session()->put('trip_data', $tripData);

                if ($user) {
                    // Dispatch Activity Event to log this creation

                    \Mail::send('userpanel.email.email_verification_mail', ['data' => $user, 'baseUrl' => $baseUrl], function ($message) use ($to_email, $bcc_email) {
                        $message->from('rent.tuk123@gmail.com', 'Tuk Tuk');
                        $message->to($to_email)->bcc($bcc_email)->subject('Email Verification');
                    });
                }

                return view('userpanel.verify_email', compact('user'));
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function confirmPayment(Request $request)
    {
       
        $booking = Booking::where('id', $request->id)->first();

        if ($booking) {
            $booking->update([
                'payment_status' => 'completed',
            ]);
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'success',
                        'message' => 'Payment confirmed successfully.',
                    ],
                    200,
                );
            }
        }
    }

    public function checkEmail(Request $request)
    {
        $email = $request->query('email');
        $user = PassengerUser::where('email', $email)->first();

        if ($user) {
            // Email exists, return associated data
            return response()->json(['exists' => true, 'data' => $user]);
        } else {
            // Email doesn't exist, return error response
            return response()->json(['exists' => false]);
        }
    }

    public function bookingEmailVerfy(Request $request)
    {
        $user = PassengerUser::find($request->userId);

        if ($user->verification_code == $request->verificationCode && $user->is_email_verified == 'Y') {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Your email is already verified.',
                    ],
                    500,
                );
            }
        } elseif ($user->verification_code == null) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Your verification code is not set. Please contact support.',
                    ],
                    500,
                );
            }
        } elseif ($user->verification_code == $request->verificationCode) {
            $user->email_verified_at = now();
            $user->is_email_verified = 'Y';
            $user->save();

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Your email has been verified successfully.',
                ]);
            }
        } else {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Your verification code is incorrect. Please try again.',
                    ],
                    500,
                );
            }
        }
    }

    public function showPayment(Request $request)
    {
        return view('userpanel.payment');
    }
}