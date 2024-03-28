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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Add Employee</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contacts</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile</h4>
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
                                <form method="POST" action="" enctype="multipart/form-data">
                                    @csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Add Employee</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Name</label>
                                                <input type="text" class="form-control"@error('name') is-invalid @enderror name="name">
                                                @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Email</label>
                                                <input type="email" class="form-control"@error('email') is-invalid @enderror name="email">
                                                @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Phone</label>
                                                <input type="text" class="form-control"@error('phone') is-invalid @enderror name="phone">
                                                @error('phone')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Address</label>
                                                <input type="text" class="form-control"@error('address') is-invalid @enderror name="address">
                                                @error('address')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Address</label>
                                                    <select class="form-select" id="example-select" name="experience" >
                                                        <option selected="">Select Year</option>
                                                        <option value="1 Year">1 Year</option>
                                                        <option value="2 Year">2 Year</option>
                                                        <option value="3 Year">3 Year</option>
                                                        <option value="4 Year">4 Year</option>
                                                        <option value="5 Year">5 Year</option>
                                                    </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Salary</label>
                                                <input type="text" class="form-control"@error('salary') is-invalid @enderror name="salary">
                                                @error('salary')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee Vacation</label>
                                                <input type="text" class="form-control"@error('vacation') is-invalid @enderror name="vacation">
                                                @error('vacation')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Employee City</label>
                                                <input type="text" class="form-control"@error('city') is-invalid @enderror name="city">
                                                @error('city')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-2">
                                                <label for="inputGroupFile04" class="form-label"></label>
                                                <input class="form-control" type="file" id="photo" name="image" >
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
