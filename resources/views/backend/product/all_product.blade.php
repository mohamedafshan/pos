@extends('admin_dashboard')

@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('add.product') }}"
                                    class="btn btn-primary rounded-pill waves-effect waves-light">Add Product</a>

                            </ol>
                        </div>
                        <h4 class="page-title">All Product</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S1</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Catergory</th>
                                        <th>Supplier</th> 
                                        <th>Code</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($product as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($item->product_image) }}" alt=""
                                                    style="width: 50px; height: 50px" class="rounded-circle"></td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item['catergory']['catergory_name'] }}</td>
                                            <td>{{ $item['supplier']['name'] }}</td>
                                            <td>{{ $item->product_code }}</td>
                                            <td>{{ $item->selling_price }}</td>
                                            <td>
                                                <a href=" {{ route('edit.product', $item->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>

                                                <a href="{{ route('delete.product', $item->id) }}" id="delete"
                                                    class="btn btn-danger rounded-pill waves-effect waves-light"><i
                                                        class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
