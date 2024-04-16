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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Edit Product</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Product</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-8 col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- end timeline content-->
                            <div class="tab-pane" id="settings">
                                <form method="POST" action="{{ route('product.update') }}" enctype="multipart/form-data" id="myForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}"/>
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Add Product</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}" >   
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Catergory</label>
                                                <select class="form-select" id="example-select" name="catergory_id" >
                                                    <option selected disabled>Select Catergory</option>
                                                    @foreach ($catergory as $cater)
                                                        <option value="{{ $cater->id }}" {{ $cater->id == $product->catergory_id ? 'selected' : '' }} >{{ $cater->catergory_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Supplier</label>
                                                <select class="form-select" id="example-select" name="supplier_id" >
                                                    <option selected disabled>Select Catergory</option>
                                                    @foreach ($supplier as $suppl)
                                                        <option value="{{ $suppl->id }}" {{ $suppl->id == $product->supplier_id ? 'selected' : '' }}>{{ $suppl->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Product Code</label>
                                                <input type="text"
                                                    class="form-control" name="product_code" value="{{ $product->product_code }}" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Product Garage</label>
                                                <input type="text"
                                                    class="form-control" name="product_garage" value="{{ $product->product_garage }}" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Product Store</label>
                                                <input type="text"
                                                    class="form-control" name="product_store" value="{{ $product->product_store }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Buying Date</label>
                                                <input type="date"
                                                    class="form-control" name="buying_date" value="{{ $product->buying_date }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Expire Date</label>
                                                <input type="date"
                                                    class="form-control" name="expire_date" value="{{ $product->expire_date }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Buying Price</label>
                                                <input type="text"
                                                    class="form-control" name="buying_price" value="{{ $product->buying_price }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label for="firstname" class="form-label">Selling Price</label>
                                                <input type="text"
                                                    class="form-control" name="selling_price" value="{{ $product->selling_price }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group mb-2">
                                                <label for="inputGroupFile04" class="form-label">Customer Image</label>
                                                <input class="form-control"
                                                    type="file" id="photo" name="product_image">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <label for="inputGroupFile04" class="form-label"></label>
                                                <img id="showImage" src="{{ asset($product->product_image) }}"
                                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                                            </div>
                                        </div>


                                    </div> <!-- end row -->


                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i
                                                class="mdi mdi-content-save"></i> Save</button>
                                    </div>
                                </form>
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
                    product_name: {
                        required : true,
                    }, 
                    catergory_id: {
                        required : true,
                    }, 
                    supplier_id: {
                        required : true,
                    }, 
                    product_code: {
                        required : true,
                    }, 
                    product_garage: {
                        required : true,
                    },
                    product_store: {
                        required : true,
                    },
                    buying_date: {
                        required : true,
                    },
                    expire_date: {
                        required : true,
                    },
                    buying_price: {
                        required : true,
                    },
                    selling_price: {
                        required : true,
                    },
                },
                messages :{
                    product_name: {
                        required : 'Please Enter Product Name',
                    }, 
                    catergory_id: {
                        required : 'Please Select Catergory',
                    }, 
                    supplier_id: {
                        required : 'Please Select Supplier',
                    }, 
                    product_code: {
                        required : 'Please Enter Product Code',
                    }, 
                    product_garage: {
                        required : 'Please Enter Garage',
                    }, 
                    product_store: {
                        required : 'Please Enter Product store',
                    }, 
                    buying_date: {
                        required : 'Please Enter Buying Date',
                    }, 
                    expire_date: {
                        required : 'Please Enter Expire Date',
                    }, 
                    buying_price: {
                        required : 'Please Enter Buying Price',
                    }, 
                    selling_price: {
                        required : 'Please Enter Selling Price',
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
            $('#photo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
        });
    </script>
@endsection
