<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catergory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CatergoryController extends Controller
{
    public function AllCatergory(){
        $catergory = Catergory::latest()->get();
        return view('backend.catergory.all_catergory',compact('catergory'));
    }

    public function CatergoryStore(Request $request){
        Catergory::insert([
            'catergory_name' => $request->catergory_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Catergory Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.catergory')->with($notification);
    }

    public function EditCatergory($id){
        $catergory = Catergory::findOrFail($id);
        return view('backend.catergory.edit_catergory',compact('catergory'));
    }

    public function CatergoryUpdate(Request $request){
        $catergory_id = $request->id;
        Catergory::findOrFail($catergory_id)->update([
            'catergory_name' => $request->catergory_name,
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message'=>'Catergory Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.catergory')->with($notification);
    }

    public function DeleteCatergory($id){
        Catergory::findOrFail($id)->delete();
         $notification = array(
            'message'=>'Catergory Deleted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
