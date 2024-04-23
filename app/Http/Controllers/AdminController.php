<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    
    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message'=>'Admin Logout Successfully',
            'alert-type'=>'info'
        );

        return redirect('/logout')->with($notification);
    }
    public function AdminLogoutPage(){
        return view('admin.admin_logout');
    }

    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view',compact('adminData'));
    }

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if($request->file('photo')){
            $file = $request->file('photo'); // it save the Original file name exaple (abc.jpg)
            @unlink(public_path('upload/admin_image'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();  //Modify the file name structure --> (20240327abc) .jpg temperory auto saving 
            $file->move(public_path('upload/admin_image'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();

        $notification = array(
            'message'=>'Admin Profile Updated Successfully',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ChangePassword(){
        return view('admin.change_password');
    }

    public function UpdatePassword(Request $request){
        //validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        //match the The old password
        if(!Hash::check($request->old_password,auth::user()->password)){

            $notification = array(
                'message'=>'Old Password Does Not Match!!',
                'alert-type'=>'error'
            );
            return back()->with($notification);
        }
        //update new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message'=>'Password Change Successfully',
            'alert-type'=>'success'
        );
        return back()->with($notification);
    }

    ////////////////////////////////////     Admin User All Method     ////////////////////////////////////////////
    public function AllAdmin(){
        $allaminuser = User::latest()->get();
        return view('backend.admin.all_admin',compact('allaminuser'));
    }

    public function AddAdmin(){
        $roles = Role::all();
        return view('backend.admin.add_admin',compact('roles'));
    }

    public function AdminStore(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        if($request->roles){
            $user->assignRole($request->roles);
        }
        $notification = array(
            'message'=>'New Admin User Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.admin')->with($notification);
    }

    public function EditAdmin($id){
        $roles = Role::all(); 
        $adminuser = User::findOrFail($id);
        return view('backend.admin.edit_admin',compact('roles','adminuser'));
    }

    public function UpdateAdmin(Request $request){
        $admin_id = $request->id;
        $user = User::findOrFail($admin_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $user->roles()->detach(); //recalling previous
        if($request->roles){
            $user->assignRole($request->roles);
        }
        $notification = array(
            'message'=>'Admin User Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.admin')->with($notification);
    }

    public function DeleteAdmin($id){
        $user = User::findOrFail($id);
        if(!is_null($user)){
            $user->delete();
        }
        $notification = array(
            'message'=>'Admin User Deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
