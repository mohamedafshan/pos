<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Nette\Schema\Expect;

class ExpenseController extends Controller
{
    public function AddExpense(){
        return view('backend.expense.add_expense');
    }

    public function ExpenseStore(Request $request){
        Expense::insert([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message'=>'Expense Inserted Successfully',
            'alert-type'=>'success'
        );
         return redirect()->back()->with($notification);
    }

    public function TodayExpense(){
        $date = date("d-m-Y");
        $today = Expense::where('date',$date)->get();
        return view('backend.expense.today_expense',compact('today'));
    }

    public function EditExpense($id){
        $expense = Expense::findOrFail($id);
        return view('backend.expense.edit_expense',compact('expense'));
    }

    public function ExpenseUpdate(Request $request){
        $expense_id = $request->id;
        Expense::findOrFail($expense_id)->update([
            'details' => $request->details,
            'amount' => $request->amount,
            'month' => $request->month,
            'year' => $request->year,
            'date' => $request->date,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message'=>'Expense Updated Successfully',
            'alert-type'=>'success'
        );
         return redirect()->route('today.expense')->with($notification);
    }

    public function MonthExpense(){
        $month = date("F");
        $monthexpenses = Expense::where('month',$month)->get();
        return view('backend.expense.month_expense',compact('monthexpenses'));
    }

    public function YearExpense(){
        $year = date("Y");
        $yearexpenses = Expense::where('year',$year)->get();
        return view('backend.expense.year_expense',compact('yearexpenses'));
    }
}
