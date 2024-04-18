<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function Pos(){
        $product = Products::latest()->get();
        $customer = Customer::latest()->get();
        return view('backend.pos.pos_page',compact('product','customer'));
    }

    public function AddCart(Request $request){
        Cart::add([
            'id' => $request->id,
            'name' => $request->name, 
            'qty' => $request->qty, 
            'price' => $request->price, 
            'weight' => 20, 
            'options' => ['size' => 'large']]);

            $notification = array(
                'message'=>'Product Added  Successfully',
                'alert-type'=>'success'
            );
             return redirect()->back()->with($notification);
    }

    public function AllItem(){
        $product = Cart::content();
        return view('backend.pos.text_item',compact('product'));
    }

    public function CartUpdate(Request $request,$rowId){
        $qty = $request->qty;
        $update = Cart::update($rowId,$qty);
        
        $notification = array(
            'message'=>'Cart Updated  Successfully',
            'alert-type'=>'success'
        );
         return redirect()->back()->with($notification);
    }

    public function CartRemove($rowId){
        $remove = Cart::remove($rowId);

        $notification = array(
            'message'=>'Cart Removed  Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }
}
