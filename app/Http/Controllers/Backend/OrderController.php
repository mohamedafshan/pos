<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Orderdetails;
use App\Models\Products;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function FinalInvoice(Request $request){

        $rtotal = $request->total;
        $rpay = $request->pay;
        $mtotal = $rtotal - $rpay;

        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_product'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['invoice_no'] = 'Inv'.mt_rand(10000000,90000000); //random number
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $mtotal;
        $data['created_at'] = Carbon::now();

        $order_id = Order::insertGetId($data);
        $contents = Cart::content();
        foreach($contents as $content)
            $product_data['order_id'] = $order_id;
            $product_data['product_id'] = $content->id;
            $product_data['quantity'] = $content->qty;
            $product_data['unitcost'] = $content->price;
            $product_data['total'] = $content->total;

            $insert = Orderdetails::insert($product_data);
            $notification = array(
                'message'=>'Order Complete Successfully',
                'alert-type'=>'success'
            );
            Cart::destroy();
             return redirect()->route('dashboard')->with($notification);
    }

    public function PendingOrder(){
        $order = Order::where('order_status','pending')->get();
        return view('backend.order.pending_order',compact('order'));
    }

    public function OrderDetails($oreder_id){
        $order = Order::where('id',$oreder_id)->first();
        $orderItem = Orderdetails::with('product')->where('order_id',$oreder_id)->orderBy('id','DESC')->get();
        return view('backend.order.order_details',compact('order','orderItem'));
    }

    public function OrderStatusUpdate(Request $request){
        $order_id = $request->id;

        $product = Orderdetails::where('order_id',$order_id)->get();
        foreach($product as $item){
            Products::where('id',$item->product_id)
            ->update(['product_store' => DB::raw('product_store-'.$item->quantity)
            ]);
        }

        Order::findOrFail($order_id)->update(['order_status' => 'complete']);

        $notification = array(
            'message'=>'Order Done Successfully',
            'alert-type'=>'success'
        );

        Cart::destroy();
         return redirect()->route('pending.order')->with($notification);
    }

    public function CompleteOrder(){
        $order = Order::where('order_status','complete')->get();
        return view('backend.order.complete_order',compact('order'));
    }

    public function StockManage(){
        $product = Products::latest()->get();
        return view('backend.stock.all_stock',compact('product'));
    }

    public function OrderInvoice($order_id){
        $order = Order::where('id',$order_id)->first();
        $orderItem = Orderdetails::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('backend.order.order_invoice',compact('order',
        'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

    ///////////////////////     Due Control      //////////////////////////////
    public function PendingDue(){
        $alldue = Order::where('due','>','0')->orderBy('id','DESC')->get();
        return view('backend.order.pending_due',compact('alldue'));
    }

    public function OrderDueAjax($id){
        $order = Order::findOrFail($id);
        return response()->json($order);
    }

    public function UpdateDue(Request $request){
        $order_id = $request->id;
        $due_amount = $request->due;
        $pay_amount = $request->pay;

        $allorder = Order::findOrFail($order_id);
        $maindue = $allorder->due;
        $mainpay = $allorder->pay;

        $paid_due = $maindue - $due_amount;
        $paid_pay = $mainpay + $due_amount;
        
        Order::findOrFail($order_id)->Update([
            'due' => $paid_due,
            'pay' => $paid_pay,
        ]);

        $notification = array(
            'message'=>'Due Amount Updated Successfully',
            'alert-type'=>'success'
        );
         return redirect()->route('pending.due')->with($notification);
    }
}
