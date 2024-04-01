<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EmployeeController extends Controller
{
    public function AllEmployee(){
        $employee = Employee::latest()->get();
        return view('backend.employee.all_employee',compact('employee'));
    }

    public function AddEmployee(){
        return view('backend.employee.add_employee');
    }

    public function StoreEmployee(Request $request){
        
        $validate = $request->validate([
            'name'=>'required|max:200',
            'email'=>'required|unique:employees|max:200',
            'phone'=>'required|max:200',
            'address'=>'required|max:400',
            'salary'=>'required|max:200',
            'vacation'=>'required|max:200',
            'city'=>'required',
            'image'=>'required',
            'experience'=>'required',
        ],

        [
            'name.required' => 'This Empoyee Name Fieled Is Required!',
            'email.required' =>'This Empoyee Email Fieled Is Required!'
        ]
    );

        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $img = $manager->read($image);
            $img = $img->resize(300,300);
            $img = $img->toJpeg(80);
            $img->save('upload/employee/'.$name_gen); // you can use $img->save($save_url); in after the $save_url variable
            $save_url = 'upload/employee/'.$name_gen;
        }

        Employee::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'experience'=>$request->experience,
            'salaray'=>$request->salary,
            'vacation'=>$request->vacation,
            'city'=>$request->city,
            'image'=>$save_url,
            'created_at'=>Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Employee Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.employee')->with($notification);
    }

    public function EditEmployee($id){
        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee',compact('employee'));
    }
    
    public function UpdateEmployee(Request $request){
         $employee_id = $request->id;
         if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $img = $manager->read($image);
            $img = $img->resize(300,300);
            $img = $img->toJpeg(80);
            $img->save('upload/employee/'.$name_gen);
            $save_url = 'upload/employee/'.$name_gen;
        

            Employee::findOrFail($employee_id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'experience'=>$request->experience,
                'salaray'=>$request->salary,
                'vacation'=>$request->vacation,
                'city'=>$request->city,
                'image'=>$save_url,
                'created_at'=>Carbon::now(),
            ]);

            $notification = array(
                'message'=>'Employee Updated  Successfully',
                'alert-type'=>'success'
            );
             return redirect()->route('all.employee')->with($notification);
            }
         else
         {
            Employee::findOrFail($employee_id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'experience'=>$request->experience,
                'salaray'=>$request->salary,
                'vacation'=>$request->vacation,
                'city'=>$request->city,
                'created_at'=>Carbon::now(),
            ]);

            $notification = array(
                'message'=>'Employee Updated  Successfully',
                'alert-type'=>'success'
            );
             return redirect()->route('all.employee')->with($notification);
         }
    }

    public function DeleteEmployee($id){
        $employee_img = Employee::findOrFail($id);
        $img = $employee_img->image;
        unlink($img);

        Employee::findOrFail($id)->delete();

        $notification = array(
            'message'=>'Employee Deleted  Successfully',
            'alert-type'=>'success'
        );
         return redirect()->back()->with($notification);
    }
}
