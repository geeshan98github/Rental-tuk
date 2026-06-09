<?php

namespace App\Http\Controllers\Userpanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use App\Models\City;
use App\Models\Driver;
use App\Models\Instructor;
use App\Models\Mechanic;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        return view('userpanel.career');
    }

    public function driver(Request $request)
    {
        $cities = City::where('is_delete', 0)->where('status', 'Y')->get();
        return view('userpanel.career_driver', compact('cities'));
    }

    public function saveDriver(Request $request)
    {
        $data = new Driver();

        $data->first_name = $request->appFirstName;
        $data->last_name = $request->appLastName;
        $data->email = $request->appEmail;
        $data->phone_number = $request->appMobile;
        $data->address = $request->appAddress;
        $data->license_number = $request->appLicenseNo;
        $data->year_of_experience = $request->appExperience;
        $language = implode(',', $request->appLanguages);
        $data->spoken_languages = $language;
        $data->city_id = $request->city;

        if (!$request->file('uploadLicense') == '') {
            $uploadLicense = $request->file('uploadLicense')->getClientOriginalName();

            $uploadLicense = $request->file('uploadLicense')->store('public/documents');
        } else {
            $uploadLicense = '';
        }

        if (!$request->file('uploadPoliceReport') == '') {
            $uploadPoliceReport = $request->file('uploadPoliceReport')->getClientOriginalName();

            $uploadPoliceReport = $request->file('uploadPoliceReport')->store('public/documents');
        } else {
            $uploadPoliceReport = '';
        }

        $data->license_image = $uploadLicense;
        $data->police_report = $uploadPoliceReport;
        $data->save();

        return redirect()->back()->with('success', 'your Application Sent Successfully.We will contact you soon.');
    }
    public function instructor(Request $request)
    {
        $cities = City::where('is_delete', 0)->where('status', 'Y')->get();
        return view('userpanel.career_instructor', compact('cities'));
    }

    public function saveInstructor(Request $request)
    {
        $data = new Instructor();

        $data->first_name = $request->appFirstName;
        $data->last_name = $request->appLastName;
        $data->email = $request->appEmail;
        $data->phone_number = $request->appMobile;
        $data->address = $request->appAddress;
        $data->license_number = $request->appInstructorLicense;
        $data->year_of_experience = $request->appExperience;
        $language = implode(',', $request->appLanguages);
        $data->spoken_languages = $language;

        if (!$request->file('uploadInstructorLicense') == '') {
            $uploadInstructorLicense = $request->file('uploadInstructorLicense')->getClientOriginalName();

            $uploadInstructorLicense = $request->file('uploadInstructorLicense')->store('public/documents');
        } else {
            $uploadInstructorLicense = '';
        }

        if (!$request->file('uploadPoliceReport') == '') {
            $uploadPoliceReport = $request->file('uploadPoliceReport')->getClientOriginalName();

            $uploadPoliceReport = $request->file('uploadPoliceReport')->store('public/documents');
        } else {
            $uploadPoliceReport = '';
        }

        $data->license_image = $uploadInstructorLicense;
        $data->police_report = $uploadPoliceReport;
        $data->save();

        return redirect()->back()->with('success', 'your Application Sent Successfully.We will contact you soon.');
    }
    public function mechanic(Request $request)
    {
        $cities = City::where('is_delete', 0)->where('status', 'Y')->get();
        return view('userpanel.carrer_mechanic', compact('cities'));
    }

    public function saveMechanic(Request $request)
    {
        $data = new Mechanic();

        $data->first_name = $request->appFirstName;
        $data->last_name = $request->appLastName;
        $data->email = $request->appEmail;
        $data->phone_number = $request->appMobile;
        $data->address = $request->appAddress;
        $data->certificates = $request->appCertification;
        $data->skills = $request->appSkills;
        $data->year_of_experience = $request->appExperience;
        $data->city_id = $request->city;

        if (!$request->file('uploadNIC') == '') {
            $uploadNIC = $request->file('uploadNIC')->getClientOriginalName();

            $uploadNIC = $request->file('uploadNIC')->store('public/documents');
        } else {
            $uploadNIC = '';
        }

        if (!$request->file('uploadPoliceReport') == '') {
            $uploadPoliceReport = $request->file('uploadPoliceReport')->getClientOriginalName();

            $uploadPoliceReport = $request->file('uploadPoliceReport')->store('public/documents');
        } else {
            $uploadPoliceReport = '';
        }

        $data->nic_image = $uploadNIC;
        $data->police_report = $uploadPoliceReport;
        $data->save();

        return redirect()->back()->with('success', 'your Application Sent Successfully.We will contact you soon.');
    }
}