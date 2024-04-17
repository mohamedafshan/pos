<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Catergory;
use App\Models\Products;
use App\Models\Supplier;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;

class ProductController extends Controller
{
    //
    public function AllProduct(){
        $product = Products::latest()->get();
        return view('backend.product.all_product',compact('product'));
    }

    public function AddProduct(){
        $catergory = Catergory::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('backend.product.add_product',compact('catergory','supplier'));
    }

    public function ProductStore(Request $request){
        $product_code = IdGenerator::generate(['table' => 'products','field' =>'product_code','length' => 4,'prefix' => 'PC']);
        if($request->file('product_image')){
            $image = $request->file('product_image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $img = $manager->read($image);
            $img = $img->resize(300,300);
            $img = $img->toJpeg(80);
            $img->save('upload/product/'.$name_gen); // you can use $img->save($save_url); in after the $save_url variable
            $save_url = 'upload/product/'.$name_gen;
        }

        Products::insert([
            'product_name' => $request->product_name,
            'catergory_id' => $request->catergory_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $product_code,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message'=>'Product Inserted Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct($id){
        $product = Products::findOrFail($id);
        $catergory = Catergory::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('backend.product.edit_product',compact('product','catergory','supplier'));
    }

    public function ProductUpdate(Request $request){
        $product_id = $request->id;

        if($request->file('product_image')){
            $image = $request->file('product_image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $img = $manager->read($image);
            $img = $img->resize(300,300);
            $img = $img->toJpeg(80);
            $img->save('upload/product/'.$name_gen); // you can use $img->save($save_url); in after the $save_url variable
            $save_url = 'upload/product/'.$name_gen;

            Products::findOrFail($product_id)->update([
                'product_name' => $request->product_name,
                'catergory_id' => $request->catergory_id,
                'supplier_id' => $request->supplier_id,
                'product_code' => $request->product_code,
                'product_garage' => $request->product_garage,
                'product_store' => $request->product_store,
                'buying_date' => $request->buying_date,
                'expire_date' => $request->expire_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'product_image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }
        else{
            Products::findOrFail($product_id)->update([
                'product_name' => $request->product_name,
                'catergory_id' => $request->catergory_id,
                'supplier_id' => $request->supplier_id,
                'product_code' => $request->product_code,
                'product_garage' => $request->product_garage,
                'product_store' => $request->product_store,
                'buying_date' => $request->buying_date,
                'expire_date' => $request->expire_date,
                'buying_price' => $request->buying_price,
                'selling_price' => $request->selling_price,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message'=>'Product Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.product')->with($notification);
    }

    public function DeleteProduct($id){
        $product_img = Products::findOrFail($id);
        $img = $product_img->product_image; //Store the image variable 
        unlink($img); //unlink the image automatically it will delete the image data
    
        Products::findOrFail($id)->delete(); //delete the entire data to the specific id customer details   same code -->  $product_img->delete(); <--
    
        $notification = array(
            'message'=>'Product Deleted  Successfully',
            'alert-type'=>'success'
        );
         return redirect()->back()->with($notification);
    }

    public function BarcodeProduct($id){
        $product = Products::findOrFail($id);
        return view('backend.product.barcode_product',compact('product'));
    }

    public function ImportProduct(){
        return view('backend.product.import_product');
    }

    public function Export(){
        return Excel::download(new ProductExport,'Products.xlsx');
    }

    public function Import(Request $request){
        Excel::import(new ProductImport, $request->file('import_file'));
        $notification = array(
            'message'=>'Product Imported  Successfully',
            'alert-type'=>'success'
        );
         return redirect()->back()->with($notification);
    }
}
