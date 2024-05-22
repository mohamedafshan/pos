@extends('admin_dashboard')

@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- Signup modal content -->
            <div id="signup-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form class="px-3" action="{{ route('catergory.store') }}" method="POST">
                            @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Catergory Name</label>
                                    <input class="form-control" type="text" placeholder="Add Catergory" name="catergory_name" >
                                </div>

                                <div class="mb-3 text-center">
                                    <button class="btn btn-primary" type="submit">Save Changes</button>
                                </div>

                            </form>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <a href="{{ route('add.customer') }}"
                                    class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                                    data-bs-target="#signup-modal">Add Catergory</a>
                            </ol>
                        </div>
                        <h4 class="page-title">All Catergory</h4>
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
                                        <th>Catergory Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($catergory as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->catergory_name }}</td>
                                            <td>
                                                <a href=" {{ route('edit.catergory', $item->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>

                                                <a href="{{ route('delete.catergory', $item->id) }}" id="delete"
                                                    class="btn btn-danger  rounded-pill waves-effect waves-light"><i
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
