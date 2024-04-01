<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Can;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SupplierController extends Controller
{
    public function AllSupplier()
    {
        $supplier = Supplier::latest()->get(); //Retrive the entuire supplier data
        return view('backend.supplier.all_supplier', compact('supplier'));
    }

    public function AddSupplier()
    {
        return view('backend.supplier.add_supplier');
    }

    public function StoreSupplier(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:customers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required',
            // 'bank_name'=>'required|max:200',
            // 'bank_branch'=>'required|max:200',
            'type' => 'required',
            'city' => 'required',
            'image' => 'required',
        ]);

        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            $img = $manager->read($image);
            $img = $img->resize(300, 300);
            $img = $img->toJpeg(80);
            $img->save('upload/supplier/' . $name_gen); // you can use $img->save($save_url); in after the $save_url variable
            $save_url = 'upload/supplier/' . $name_gen; //for saving to the database field
        }

        Supplier::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'type' => $request->type,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Supplier Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.supplier')->with($notification);
    }

    public function EditSupplier($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit_supplier', compact('supplier'));
    }

    public function UpdateSupplier(Request $request)
    {

        // $validate = $request->validate([
        //     'name'=>'required|max:200',
        //     'email'=>'required|unique:customers|max:200',
        //     'phone'=>'required|max:200',
        //     'address'=>'required|max:400',
        //     'shopname'=>'required|max:200',
        //     // 'account_holder'=>'required|max:200',
        //     // 'account_number'=>'required',
        //     // 'bank_name'=>'required|max:200',
        //     'bank_branch'=>'required|max:200',
        //     'type'=>'required',
        //     'city'=>'required',
        //     'image'=>'required',
        // ]);

        $supplier_id = $request->id;
        if ($request->file('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            $img = $manager->read($image);
            $img = $img->resize(300, 300);
            $img = $img->toJpeg(80);
            $img->save('upload/supplier/' . $name_gen);
            $save_url = 'upload/supplier/' . $name_gen;


            Supplier::findOrFail($supplier_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'type' => $request->type,
                'city' => $request->city,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Supplier Updated  Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.supplier')->with($notification);
        } else {
            Supplier::findOrFail($supplier_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'shopname' => $request->shopname,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'type' => $request->type,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Supplier Updated  Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.supplier')->with($notification);
        }
    }

    public function DeleteSupplier($id)
    {
        $customer_img = Supplier::findOrFail($id);
        $img = $customer_img->image; //Store the image variable 
        unlink($img); //unlink the image automatically it will delete the image data

        Supplier::findOrFail($id)->delete(); //delete the entire data to the specific id customer details

        $notification = array(
            'message' => 'Supplier Deleted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function DetailsSupplier($id){
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.details_supplier',compact('supplier'));
    }

}
