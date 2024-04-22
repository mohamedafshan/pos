@extends('admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">POS</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">POS</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-6 col-xl-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered border-primary mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    @php
                                        $allcart = Cart::content();
                                    @endphp
                                    <tbody>
                                        @foreach ($allcart as $cart)
                                        <tr>
                                            <td>{{ $cart->name }}</td>
                                            <td>
                                                <form action="{{ url('/cart-update/'.$cart->rowId) }}" method="post">
                                                    @csrf
                                                    <input type="number" name="qty" value="{{ $cart->qty }}" style="width: 40px" min="1"/>
                                                    <button type="submit" class="btn btn-sm btn-success" style="margin-top: -2px">
                                                        <i class="fas fa-check"></i> 
                                                    </button>
                                                </form>
                                            </td>
                                            <td>{{ $cart->price }}</td>
                                            <td>{{ $cart->price*$cart->qty }}</td>
                                            <td> <a href="{{ url('/cart-remove/'.$cart->rowId) }}"><i class="fas fa-trash-alt" style="color: white"></i></a> </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="bg-primary">
                                <br>
                                    <p style="font-size: 18px; color:#fff"> Quantity : {{ Cart::count() }}</p>
                                    <p style="font-size: 18px; color:#fff"> Sub Total : {{ Cart::subtotal() }}</p>
                                    <p style="font-size: 18px; color:#fff"> Vat : {{ Cart::tax() }}</p>
                                    <p><h2 class="text-white">Total </h2> <h1 class="text-white">{{ Cart::total() }}</h1></p>
                                <br>
                            </div>

                            <form action="{{ url('/create-invoice') }}" method="POST" id="myForm">
                                @csrf
                                    <div class="form-group mb-3">
                                        <label for="firstname" class="form-label">All Customer</label>

                                        <a href="{{ route('add.customer') }}"
                                        class="btn btn-blue rounded-pill waves-effect waves-light mb-2 mt-2">
                                         Add Product</a>

                                        <select class="form-select" id="example-select" name="customer_id" >
                                            <option selected disabled>Select Customer</option>
                                            @foreach ($customer as $cus)
                                                <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <button class="btn btn-blue waves-effect wave-light">Create Invoice</button>
                            </form>

                        </div>
                    </div> <!-- end card -->

                </div> <!-- end col-->

                <div class="col-lg-6 col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <!-- end timeline content-->
                            <div class="tab-pane" id="settings">
                                <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>S1</th>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th> </th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($product as $key => $item)
                                            <tr>
                                                <form action="{{ url('/add-cart') }}" method="POST">
                                                 @csrf   
                                                 <input type="hidden" name="id" value="{{ $item->id }}"/>
                                                 <input type="hidden" name="name" value="{{ $item->product_name }}"/>
                                                 <input type="hidden" name="qty" value="1"/>
                                                 <input type="hidden" name="price" value="{{ $item->selling_price }}"/>
                                                <td>{{ $key + 1 }}</td>
                                                <td><img src="{{ asset($item->product_image) }}" alt=""
                                                        style="width: 50px; height: 50px" class="rounded-circle"></td>
                                                <td>{{ $item->product_name }}</td>
                                                <td>
                                                    <button type="submit" style="font-size: 20px; color: #000;"><i
                                                            class="fas fa-plus-square"></i></button>
                                                </td>
                                                </form>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- end settings content-->


                        </div>
                    </div> <!-- end card-->

                </div> <!-- end col -->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    customer_id: {
                        required : true,
                    }, 
                },
                messages :{
                    customer_id: {
                        required : 'Please Select Customer',
                    }, 
                },
                errorElement : 'span', 
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });
        
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
