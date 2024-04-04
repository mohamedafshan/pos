<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function AddAdvanceSalary(){
        $employee = Employee::latest()->get();
        return view('backend.salary.add_advance_salary',compact('employee'));
    }

    public function StoreAdvanceSalary(Request $request){
        $validateData = $request->validate([
            'month' => 'required|max:255',
            'year' => 'required',
            'advance_salary' => 'required|max:255',
        ]);

        $month = $request->month;
        $employee_id = $request->employee_id;
        $advance = AdvanceSalary::where('month',$month)->where('employee_id',$employee_id)->first();

        if($advance === NULL){
            AdvanceSalary::insert([
                'employee_id' => $request->employee_id,
                'month' => $request->month,
                'year' => $request->year,
                'advance_salary' => $request->advance_salary,
                'created_at' => Carbon::now(),
            ]);
                $notification = array(
                'message'=>'Advance Paid Successfully',
                'alert-type'=>'success'
            );
            return redirect()->route('all.advance.salary')->with($notification);
        }
        else{

             $notification = array(
            'message'=>'Advance Already Paid',
            'alert-type'=>'warning'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function AllAdvanceSalary(){
        $salary = AdvanceSalary::latest()->get();
        return view('backend.salary.all_advance_salary',compact('salary'));
    }

    public function EditAdvanceSalary($id){
        $employee = Employee::latest()->get(); //Need e_id for insert the data
        $salary = AdvanceSalary::findOrFail($id); //Actual table access
        return view('backend.salary.edit_advance_salary',compact('salary','employee')); //if you pass value only put as a string type like -->'salary','employee'<--;
    }

    public function AdvanceSalaryUpdate(Request $request){
        $salary_id = $request->id;

        AdvanceSalary::findOrFail($salary_id)->update([
            'employee_id' => $request->employee_id,
            'month' => $request->month,
            'year' => $request->year,
            'advance_salary' => $request->advance_salary,
            'created_at' => Carbon::now(),
        ]);
            $notification = array(
            'message'=>'Advance Updates Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.advance.salary')->with($notification);
    }

    public function DeleteAdvanceSalary($id)
    {
        AdvanceSalary::findOrFail($id)->delete(); //delete the entire data to the specific id customer details

        $notification = array(
            'message' => 'Advance Salary Deleted  Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
