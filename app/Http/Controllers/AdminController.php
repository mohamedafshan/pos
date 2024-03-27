<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;

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
}
