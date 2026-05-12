<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MetaTag;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Events\LoggableEvent;
use Illuminate\Support\Facades\Event;
use App\Http\Middleware\Middleware;

class MetaTagsController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('meta-tags-list|meta-tags-create|meta-tags-edit|meta-tags-delete', only: ['list']), new Middleware('meta-tags-create', only: ['index', 'store']), new Middleware('meta-tags-edit', only: ['edit', 'update']), new Middleware('meta-tags-delete', only: ['destroy'])];
    }

    public function index(Request $request)
    {
        return view('admin.meta_tags.index');
    }


    public function list(Request $request)
    {

        if ($request->ajax()) {

            $data = MetaTag::where('is_delete', 0)->orderBy('id', 'DESC');
            //var_dump($data); exit();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('edit', function ($row) {

                   $edit_url = url('adminpanel/meta-tags-edit',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fal fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['edit'])
                ->make(true);
            }

       return view('admin.meta_tags.list');
    }


   
    public function create()
    {
        return view('admin.meta_tags.create');
    }

   
    public function store(Request $request)
    {
        $data = new MetaTag();
        $data->page_name = $request->page_name;
        $data->page_title = $request->page_title;
        $data->description = $request->description;
        $data->keywords = $request->keywords;
        $data->og_title = $request->og_title;
        $data->og_type = $request->og_type;
        $data->og_url = $request->og_url;
        $data->og_sitename = $request->og_sitename;
        $data->og_description = $request->og_description;
        $data->og_email = $request->og_email;

        // ensure the request has a file before we attempt anything else.
        if ($request->hasFile('og_image')) {
            $image = $request->file('og_image')->hashName();
            $request->file('og_image')->storeAs('public/meta_tags', $image);
            $data->og_image = $image;
        }

        $data->save();

        Event::dispatch(new LoggableEvent($data, 'created'));

        return redirect()->route('meta-tags-list')->with('success', 'Successfully saved the record.');
    }

   
  
    public function edit($id)
    {
        $id = decrypt($id);

        $meta_tags = MetaTag::find($id);

        return view('admin.meta_tags.edit', compact('meta_tags'));
    }

 
    public function update(Request $request)
    {
        $request->validate([
            'page_title' => 'required'
        ]);

        if (!$request->hasFile('og_image') == "") {

            $data =  MetaTag::find($request->id);

            Storage::delete($data->og_image);

            $data->page_title = $request->page_title;
            $data->description = $request->description;
            $data->keywords = $request->keywords;
            $data->og_title = $request->og_title;
            $data->og_type = $request->og_type;
            $data->og_url = $request->og_url;
            $data->og_sitename = $request->og_sitename;
            $data->og_description = $request->og_description;
            $data->og_email = $request->og_email;
            // ensure the request has a file before we attempt anything else.
            if ($request->hasFile('og_image')) {
                $image = $request->file('og_image')->hashName();
                $request->file('og_image')->storeAs('public/meta_tags', $image);
                $data->og_image = $image;
            }

            $data->save();
            $id = $data->id;
        } else {
            $data =  MetaTag::find($request->id);

            $data->page_title = $request->page_title;
            $data->description = $request->description;
            $data->keywords = $request->keywords;
            $data->og_title = $request->og_title;
            $data->og_type = $request->og_type;
            $data->og_url = $request->og_url;
            //$data->og_image = $path;
            $data->og_sitename = $request->og_sitename;
            $data->og_description = $request->og_description;
            $data->og_email = $request->og_email;
            $data->save();
            $id = $data->id;
        }

        Event::dispatch(new LoggableEvent($data, 'updated'));

        return redirect()->route('meta-tags-list')->with('success', 'User updated successfully');
    }

  

}
