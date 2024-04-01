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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Add Supplier</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Supplier</h4>
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
                                <form method="POST" action="{{ route('supplier.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Add Supplier</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Name</label>
                                                <input type="text" class="form-control"@error('name') is-invalid @enderror name="name">
                                                @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Email</label>
                                                <input type="email" class="form-control"@error('email') is-invalid @enderror name="email">
                                                @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Phone</label>
                                                <input type="text" class="form-control"@error('phone') is-invalid @enderror name="phone">
                                                @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Address</label>
                                                <input type="text" class="form-control" @error('address') is-invalid @enderror name="address">
                                                @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Shop Name</label>
                                                <input type="text" class="form-control" @error('shopname') is-invalid @enderror name="shopname">
                                                @error('shopname')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Type </label>
                                                    <select class="form-select @error('type') is-invalid @enderror" id="example-select" name="type" >
                                                        <option selected disabled>Select Year</option>
                                                        <option value="Distributer">Distributer</option>
                                                        <option value="Whole Seller">Whole Seller</option>
                                                    </select>
                                                    @error('type')
                                                    <div class="text-danger">{{ $message }}</div>
                                                   @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Account Holder</label>
                                                <input type="text" class="form-control"@error('account_holder') is-invalid @enderror name="account_holder">
                                                @error('account_holder')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier Account Number</label>
                                                <input type="text" class="form-control"@error('account_number') is-invalid @enderror name="account_number">
                                                @error('account_number')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Bank Name</label>
                                                <input type="text" class="form-control"@error('bank_name') is-invalid @enderror name="bank_name">
                                                @error('bank_name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Bank Branch</label>
                                                <input type="text" class="form-control"@error('bank_branch') is-invalid @enderror name="bank_branch">
                                                @error('bank_branch')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Supplier City</label>
                                                <input type="text" class="form-control" @error('city') is-invalid @enderror name="city">
                                                @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <label for="inputGroupFile04" class="form-label">Supplier Image</label>
                                                <input class="form-control @error('image') is-invalid @enderror" type="file" id="photo" name="image" >
                                                    @error('image')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <label for="inputGroupFile04" class="form-label"></label>
                                                <img id="showImage" src="{{ url('upload/no_image.jpg') }}" class="rounded-circle avatar-lg img-thumbnail"
                                                 alt="profile-image">
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
      $(document).ready(function(){
            $('#photo').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            });
      });
    </script>

@endsection
