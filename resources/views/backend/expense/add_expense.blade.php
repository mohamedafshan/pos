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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Add Expense</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add Expense</h4>
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
                                <form method="POST" action="{{ route('expense.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i>
                                        Add Customer</h5>
                                    <div class="row">
                                       <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="example-textarea" class="form-label">Expanse Details</label>
                                                <textarea class="form-control" id="example-textarea" rows="3" name="details" ></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="firstname" class="form-label">Amount</label>
                                                <input type="text" class="form-control" name="amount">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3"> 
                                                <input type="hidden" class="form-control" name="date" value="{{ date('d-m-Y') }}" >
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">    
                                                <input type="hidden" class="form-control" name="month" value="{{ date('F') }}" >
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <input type="hidden" class="form-control" name="year" value="{{ date('Y') }}">
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
@endsection
