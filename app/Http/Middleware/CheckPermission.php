<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\DynamicMenu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use App\Models\homepage_content;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {   
        // dd(Auth::guard());
        if (Auth::guard()) {
            View::composer('*', function ($view) {
                // $menuItems = DynamicMenu::join('privilage','privilage.iFormID','=','dynamic_menu.id')->where('privilage.iUserTypeID',1)->where('dynamic_menu.show_menu',1)->where('dynamic_menu.parent_id','0')->get();
                $menuItems = DynamicMenu::where('dynamic_menu.show_menu', 1)->orderBy('parent_order', 'ASC')->get();
                view()->share('menuItems', $menuItems);

                $parentMenuItems = DynamicMenu::where('dynamic_menu.show_menu', 1)->where('dynamic_menu.parent_id', '!=', 0)->where('dynamic_menu.is_parent', 1)->orderBy('parent_order', 'ASC')->get();
                view()->share('parentMenuItems', $parentMenuItems);

                // $subMenuItems = DynamicMenu::join('privilage','privilage.iFormID','=','dynamic_menu.id')->where('privilage.iUserTypeID',1)->where('dynamic_menu.show_menu',1)->where('dynamic_menu.parent_id','!=','0')->get();
                $subMenuItems = DynamicMenu::where('dynamic_menu.show_menu', 1)->where('dynamic_menu.parent_id', '!=', '0')->where('dynamic_menu.is_parent', 0)->orderBy('child_order', 'ASC')->get();
                view()->share('subMenuItems', $subMenuItems);

                $userID = Auth::id();
                $user = User::find($userID);
                //  $roles = Role::pluck('name', 'name')->all();
                //  $userRole = $user->roles->pluck('id', 'id')->all();

                $roleID = $user->roles->first()->id;
                //var_dump($userRole);

            //    print_r($roleID);exit();

                $permissionHave =  DB::table('role_has_permissions')
                    ->select('permissions.dynamic_menu_id', 'dynamic_menu.parent_id')
                    ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                    ->join('dynamic_menu', 'permissions.dynamic_menu_id', '=', 'dynamic_menu.id')
                    ->where('role_has_permissions.role_id', $roleID)
                    ->groupBy('permissions.dynamic_menu_id')
                    ->groupBy('dynamic_menu.parent_id')
                    //->orderBy('permissions.dynamic_menu_id','ASC')
                    ->get()->toArray();

                $arrPermission = array();
                $arrParentID = array();
                foreach ($permissionHave as $per) {
                    $arrPermission[] = $per->dynamic_menu_id;
                    $arrParentID[] = $per->parent_id;
                }
                view()->share('permissionHave', $arrPermission);
                view()->share('arrParentID', $arrParentID);
            });
        }
        return $next($request);
    }
}
