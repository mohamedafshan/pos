<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CustomerController extends Controller
{
    public function AllCustomer(){
        $customer = Customer::latest()->get();
        return view('backend.customer.all_customer',compact('customer'));
    }

    public function AddCustomer(){
        return view('backend.customer.add_customer');
    }

    public function StoreCustomer(Request $request){
        
        $validate = $request->validate([
            'name'=>'required|max:200',
            'email'=>'required|unique:customers|max:200',
            'phone'=>'required|max:200',
            'address'=>'required|max:400',
            'shopname'=>'required|max:200',
            'account_holder'=>'required|max:200',
            'account_number'=>'required',
            // 'bank_name'=>'required|max:200',
            // 'bank_branch'=>'required|max:200',
            'city'=>'required',
            'image'=>'required',
        ]);

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $img = $manager->read($image);
            $img = $img->resize(300,300);
            $img = $img->toJpeg(80);
            $img->save('upload/customer/'.$name_gen); // you can use $img->save($save_url); in after the $save_url variable
            $save_url = 'upload/customer/'.$name_gen;
        }

        Customer::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'shopname'=>$request->shopname,
            'account_holder'=>$request->account_holder,
            'account_number'=>$request->account_number,
            'bank_name'=>$request->bank_name,
            'bank_branch'=>$request->bank_branch,
            'city'=>$request->city,
            'image'=>$save_url,
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Customer Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.customer')->with($notification);
    }

    public function EditCustomer($id){
        $customer = Customer::findOrFail($id);
        return view('backend.customer.edit_customer',compact('customer'));
    }

    public function UpdateCustomer(Request $request){
        $customer_id = $request->id;
        if($request->file('image')){
           $image = $request->file('image');
           $manager = new ImageManager(new Driver());
           $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

           $img = $manager->read($image);
           $img = $img->resize(300,300);
           $img = $img->toJpeg(80);
           $img->save('upload/customer/'.$name_gen);
           $save_url = 'upload/customer/'.$name_gen;
       

           Customer::findOrFail($customer_id)->update([
               'name'=>$request->name,
               'email'=>$request->email,
               'phone'=>$request->phone,
               'address'=>$request->address,
               'shopname'=>$request->shopname,
               'account_holder'=>$request->account_holder,
               'account_number'=>$request->account_number,
               'bank_name'=>$request->bank_name,
               'bank_branch'=>$request->bank_branch,
               'city'=>$request->city,
               'image'=>$save_url,
               'created_at'=>Carbon::now(),
           ]);

           $notification = array(
               'message'=>'Customer Updated  Successfully',
               'alert-type'=>'success'
           );
            return redirect()->route('all.customer')->with($notification);
           }
        else
        {
           Customer::findOrFail($customer_id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'shopname'=>$request->shopname,
            'account_holder'=>$request->account_holder,
            'account_number'=>$request->account_number,
            'bank_name'=>$request->bank_name,
            'bank_branch'=>$request->bank_branch,
            'city'=>$request->city,
            'created_at'=>Carbon::now(),
           ]);

           $notification = array(
               'message'=>'Customer Updated  Successfully',
               'alert-type'=>'success'
           );
            return redirect()->route('all.customer')->with($notification);
        }        
   }

   public function DeleteCustomer($id){
    $customer_img = Customer::findOrFail($id);
    $img = $customer_img->image; //Store the image variable 
    unlink($img); //unlink the image automatically it will delete the image data

    Customer::findOrFail($id)->delete(); //delete the entire data to the specific id customer details

    $notification = array(
        'message'=>'Customer Deleted  Successfully',
        'alert-type'=>'success'
    );
     return redirect()->back()->with($notification);
}

}
