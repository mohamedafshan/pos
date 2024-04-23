<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role as ModelsRole;

class RoleController extends Controller
{
    public function AllPermission(){
        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission',compact('permissions'));
    }

    public function AddPermission(){
        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request){
        $role =  Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message'=>'Permission Added Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id){
        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission',compact('permission'));
    }

    public function PermissionUpdate(Request $request){
        $permission_id = $request->id;
            Permission::findOrFail($permission_id)->update([
                'name' => $request->name,
                'group_name' => $request->group_name,
            ]);

            $notification = array(
                'message'=>'Permission Updated Successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id){
            Permission::findOrFail($id)->delete();

            $notification = array(
                'message'=>'Permission Deleted Successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('all.permission')->with($notification);
    }

    ///////////////////////////////     Roles All Manage     //////////////////////////////////////////////
    public function AllRoles(){
        $roles = ModelsRole::all();
        return view('backend.pages.roles.all_roles',compact('roles'));
    }

    public function AddRoles(){
        return view('backend.pages.roles.add_roles');
    }

    public function RolesStore(Request $request){
        $role =  ModelsRole::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message'=>'Role Added Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }

    public function EditRoles($id){
        $role = ModelsRole::findOrFail($id);
        return view('backend.pages.roles.edit_roles',compact('role'));
    }
    
    public function RolesUpdate(Request $request){
        $role_id = $request->id;
        ModelsRole::findOrFail($role_id)->update([
                'name' => $request->name,
        ]);

        $notification = array(
            'message'=>'Role Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.roles')->with($notification);
    }

    public function DeleteRoles($id){
        ModelsRole::findOrFail($id)->delete();
            $notification = array(
                'message'=>'Role Deleted Successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('all.roles')->with($notification);
    }

    //////////////////////////////////        Add Roles Permission All Methode        /////////////////////////////////////

    public function AddRolesPermission(){
        $roles =ModelsRole::all();
        $permissions = Permission::all();
        $permission_group = User::getpermissionGroup();
        return view('backend.pages.roles.add_roles_permission',compact('roles','permissions','permission_group'));
    }

    public function RolePermissionStore(Request $request){
        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;
            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message'=>'Role Permission Added Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AllRolesPermission(){
        $roles = ModelsRole::all();
        return view('backend.pages.roles.all_roles_permission',compact('roles'));
    }

    public function AdminEditRoles($id){
        $role =ModelsRole::findOrFail($id);
        $permissions = Permission::all();
        $permission_group = User::getpermissionGroup();
        return view('backend.pages.roles.edit_roles_permission',compact('role','permissions','permission_group'));
    }

    public function RolePermissionUpdate(Request $request,$id){
        $role = ModelsRole::findOrFail($id);
        $permissions = $request->permission;

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }

        $notification = array(
            'message'=>'Role Permission Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AdminDeleteRoles($id){
        $role = ModelsRole::findOrFail($id);
        if(!is_null($role)){
            $role->delete();
        }

        $notification = array(
            'message'=>'Role Permission Deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
