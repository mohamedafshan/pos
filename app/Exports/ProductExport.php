<?php

namespace App\Exports;

use App\Models\Products;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Products::select('product_name','catergory_id','supplier_id','product_code','product_garage','product_image','product_store','buying_date','expire_date','buying_price','selling_price')->get();
    }
}
