<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\DynamicMenu;
use App\Events\LoggableEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller
{
    

     public static function middleware(): array
    {
        return [
        new Middleware('role-list|role-create|role-edit|role-delete', only: ['list']), 
        new Middleware('role-create', only: ['index', 'store']), 
        new Middleware('role-edit', only: ['edit', 'update']), 
        new Middleware('role-delete', only: ['destroy'])];
    }

   
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                 ->addColumn('edit', function ($row) {

                   $edit_url = url('adminpanel/role-edit',encrypt($row->id));
                    $btn = '<a href="' . $edit_url . '"><i class="fal fa-edit"></i></a>';
                    return $btn;
                })
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.roles.list');
    }

       public function create()
    {
        
        $permission = Permission::get();
        $dynamicMenu =  DynamicMenu::where('show_menu', 1)->orderBy('fOrder', 'ASC')->get();

        return view('admin.roles.index', compact('permission', 'dynamicMenu'));
    }

    
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
            'user_manual' => 'mimes:pdf|max:2048'
        ]);

        if (!$request->file('user_manual') == "") {

            $user_manual = $request->file('user_manual')->getClientOriginalName();

            $path = $request->file('user_manual')->store('public/usermanual');
        } else {
            $path = null;
        }

       

        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->user_manual = $path;
        $role->save();

        $role->syncPermissions($request->input('permission'));

       
        Event::dispatch(new LoggableEvent($role, 'New role record inserted'));

        return redirect()->route('role-list')->with('success', 'Role created successfully');
    }
 

    public function edit($id)
    {
        $id = decrypt($id);
        $role = Role::find($id);
        $permission = Permission::get();
        $dynamicMenu =  DynamicMenu::where('show_menu', 1)->orderBy('fOrder', 'ASC')->get();

     
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
      
        return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions', 'dynamicMenu'));
    }

   
    public function update(Request $request)
    {
        // dd($request->all());
        $id = $request->id;

        $request->validate([
            'name' => 'required',
            'permission' => 'required',
            'user_manual' => 'mimes:pdf|max:2048'
        ]);


        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->guard_name = 'web';
        if ($request->hasFile('user_manual')) {

            $user_manual = $request->file('user_manual')->getClientOriginalName();

            $path = $request->file('user_manual')->store('public/usermanual');

            $role->user_manual = $path;
        }
        $role->save();

        // \LogActivity::addToLog('Role record ID '.$role->id.' updated.');

        // Dispatch Activity Event to log this creation
        Event::dispatch(new LoggableEvent($role, 'Role record ID'));

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('role-list')
            ->with('success', 'Role updated successfully');
    }
   
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('role-list')
            ->with('success', 'Role deleted successfully');
    }
}
