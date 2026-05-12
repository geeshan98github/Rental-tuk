<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PassengerUser;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Booking;
use DB;

class FrontendAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('userpanel.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'password.required' => 'Password is required.',
            ],
        );
        $credentials = $request->only('email', 'password');

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first();

            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => $errorMessage,
                        'errors' => $errors,
                    ],
                    422,
                );
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::guard('frontend')->attempt($credentials)) {
            $request->session()->regenerate();
            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Login successful.',
                ]);
            }
        } else {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'The provided credentials do not match our records.',
                    ],
                    422,
                );
            }
        }
    }

    public function dashboard(Request $request)
    {
        $bookings = DB::table('bookings')->join('vehical_details', 'bookings.vehicle_id', '=', 'vehical_details.id')->where('bookings.passenger_id', Auth::user()->id)->get();
        
        return view('userpanel.auth.dashboard', compact('bookings'));
    }

    public function showRegisterForm()
    {
        $contries = Country::take(10)->get();
        return view('userpanel.auth.register', compact('contries'));
    }

    public function register(Request $request)
    {
        // Validate form input
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone_number' => 'max:15|unique:passenger_users,phone_number',
                'email' => 'required|string|email|max:255|unique:passenger_users,email',
                'contry_of_residence' => 'required',
                'password' => 'required|same:password_confirmation',
            ],
            [
                'first_name.required' => 'First name is required.',
                'last_name.required' => 'Last name is required.',
                'email.required' => 'Email is required.',
                'contry_of_residence.required' => 'Country of residence is required.',
                'password.required' => 'Password is required.',
                'password.same' => 'Passwords do not match.',
                'phone_number.unique' => 'This phone number is already registered.',
                'email.unique' => 'This email is already registered.',
            ],
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first();

            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => $errorMessage,
                        'errors' => $errors,
                    ],
                    422,
                );
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $varification_code = rand(100000, 999999); // Generate a random verification code
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'contry_of_residence' => $request->contry_of_residence,
                'password' => Hash::make($request->password),
                'verification_code' => $varification_code, // Store the verification code
            ];
            $res = PassengerUser::create($data);
            $to_email = $res->email;
            $bcc_email = 'geeshan@tekgeeks.net';
            $baseUrl = config('app.url');

            if ($res) {
                // Dispatch Activity Event to log this creation

                \Mail::send('userpanel.email.email_verification_mail', ['data' => $res, 'baseUrl' => $baseUrl], function ($message) use ($to_email, $bcc_email) {
                    $message->from('rent.tuk123@gmail.com', 'Tuk Tuk');
                    $message->to($to_email)->bcc($bcc_email)->subject('Email Verification');
                });

                if ($request->ajax()) {
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Successfully submitted your inquiry!',
                        'userId' => encrypt($res->id),
                    ]);
                }
            }

            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'Failed to save your inquiry. Please try again later.',
                    ],
                    500,
                );
            }

            return redirect()->back()->with('error', 'Failed to save your inquiry. Please try again later.');
        } catch (\Exception $e) {
            dd($e);
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'An unexpected error occurred. Please try again.',
                    ],
                    500,
                );
            }

            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('frontend')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('/');
    }

    public function showVerification($id)
    {
        $id = decrypt($id);
        $user = PassengerUser::find($id);

        return view('userpanel.auth.email_verification', compact('user'));
    }

    public function emailVerification(Request $request)
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

    public function resendVerificationCode(Request $request)
    {
        $user = PassengerUser::find($request->userId);
        $varification_code = rand(100000, 999999); // Generate a random verification code
        $user->verification_code = $varification_code;
        $user->save();

        $to_email = $user->email;
        $bcc_email = 'geeshan@tekgeeks.net';
        $baseUrl = config('app.url');

        \Mail::send('userpanel.email.email_verification_mail', ['data' => $user, 'baseUrl' => $baseUrl], function ($message) use ($to_email, $bcc_email) {
            $message->from('rent.tuk123@gmail.com', 'Tuk Tuk');
            $message->to($to_email)->bcc($bcc_email)->subject('Email Verification');
        });

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Resend verification code successfully sent to your email.',
            ]);
        }
    }

    public function showResetPassword()
    {
        return view('userpanel.auth.reset_password');
    }

    public function sendResetLink(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'resetEmail' => 'required|email',
            ],
            [
                'resetEmail.required' => 'Email is required.',
                'resetEmail.email' => 'Please enter a valid email address.',
            ],
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first();

            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => $errorMessage,
                        'errors' => $errors,
                    ],
                    422,
                );
            }
        }

        $user = PassengerUser::where('email', $request->resetEmail)->first();

        if (!$user) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'No user found with this email address.',
                    ],
                    404,
                );
            }
        } else {
            $to_email = $user->email;

            $baseUrl = config('app.url');
            $resetLink = $baseUrl . 'set-new-password/' . encrypt($user->id);

            \Mail::send('userpanel.email.reset_password_mail', ['data' => $user, 'baseUrl' => $baseUrl, 'resetLink' => $resetLink], function ($message) use ($to_email) {
                $message->from(
                    '
                rent.tuk123@gmail.com',
                    'Tuk Tuk',
                );
                $message->to($to_email)->subject('Reset Password');
            });

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Reset password link has been sent to your email.',
                ]);
            }
        }
    }

    public function showSetNewPassword($token)
    {
        $userId = decrypt($token);
        $user = PassengerUser::find($userId);

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid reset link.');
        }

        return view('userpanel.auth.new_password', compact('user'));
    }

    public function saveNewPassword(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'newPassword' => 'required|same:confirmNewPassword',
            ],
            [
                'newPassword.required' => 'New password is required.',
                'newPassword.same' => 'New password and confirmation do not match.',
            ],
        );

        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorMessage = $errors->first();

            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => $errorMessage,
                        'errors' => $errors,
                    ],
                    422,
                );
            }
        }

        $user = PassengerUser::find($request->user_id);

        if (!$user) {
            if ($request->ajax()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'message' => 'No user found.',
                    ],
                    404,
                );
            }
        }

        $user->password = Hash::make($request->newPassword);
        $user->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Password has been reset successfully.',
            ]);
        }
    }

    public function profile()
    {
        $user = Auth::guard('frontend')->user();
        $contries = Country::take(10)->get();
        return view('userpanel.auth.profile', compact('user', 'contries'));
    }

    public function updateProfile(Request $request)
    {
        $user = PassengerUser::find($request->userId);

        if ($request->birthDate) {
            $birthDate = Carbon::createFromFormat('d/m/Y', $request->birthDate);
            $age = Carbon::now()->year - $birthDate->year;
            $dateOfBirth = $birthDate->format('Y-m-d');
        }

        if (!$request->file('profilePic') == '') {
            $profilePic = $request->file('profilePic')->getClientOriginalName();

            $profilePic = $request->file('profilePic')->store('public/profile_pics');
        } else {
            $profilePic = '';
        }

        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->phone_number = $request->mobile;
        $user->date_of_birth = $dateOfBirth ?? null;
        $user->age = $age ?? null;
        $user->passport_number = $request->passportNumber;
        $user->emergency_number = $request->emergencyContact;
        $user->contry_of_residence = $request->countryResidence;
        if ($profilePic != '') {
            $user->profile_image = $profilePic;
        }

        if($request->password != '') {
            $validator = Validator::make(
                $request->all(),
                [
                    'password' => 'same:confirmPassword',
                ],
                [
                    'password.same' => 'Passwords do not match.',
                ],
            );

            if ($validator->fails()) {
                $errors = $validator->errors();
                $errorMessage = $errors->first();

                if ($request->ajax()) {
                    return response()->json(
                        [
                            'status' => 'error',
                            'message' => $errorMessage,
                            'errors' => $errors,
                        ],
                        422,
                    );
                }
            }

            $user->password = Hash::make($request->password);

        }

        $user->save();


        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Profile updated successfully.',
            ]);
        }
    }
}
