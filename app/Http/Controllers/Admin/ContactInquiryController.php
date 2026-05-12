<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
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

class ContactInquiryController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('contact-list', only: ['list', 'view'])];
    }

    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = ContactInquiry::where('is_delete', 0)->orderBy('created_at', 'asc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('view', function ($row) {
                    $view_url = url('adminpanel/inquiry/view-contact-inquiry/' . encrypt($row->id) . '');
                    $btn = '<a href="' . $view_url . '"><i class="fal fa-file"></i></a>';
                    return $btn;
                })

                ->editColumn('created_at', function ($row) {
                    return date('d-m-Y H:i:s', strtotime($row->created_at));
                })
                ->rawColumns(['view'])

                ->make(true);
        }

        return view('admin.inquiries.contact.list');
    }

    public function view(Request $request)
    {
        $id = decrypt($request->id);
        $data = ContactInquiry::find($id);
        return view('admin.inquiries.contact.index', compact('data'));
    }
}
