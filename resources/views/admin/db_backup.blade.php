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
                                <a href="{{ url('backup.now') }}"
                                    class="btn btn-primary waves-effect waves-light">Backup Now</a>
                            </ol>
                        </div>
                        <h4 class="page-title">All Backup</h4>
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
                                        <th>File Name</th>
                                        <th>Size</th>
                                        <th>Path</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($files as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->getFilename() }}</td>
                                            <td>{{ $item->getSize().' KB' }}</td>
                                            <td>{{ $item->getPath() }}</td>
                                            <td>

                                                <a href="{{ route('backup',$item->getFilename()) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">Download</a>
                                                
                                                    <a href="{{ url('delete/database/'.$item->getFilename()) }}" id="delete"
                                                        class="btn btn-danger rounded-pill waves-effect waves-light">Delete</a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <a href="{{ route('details.supplier',$item->id) }}" class="btn btn-info rounded-pill waves-effect waves-light"><i class="fa-solid fa-eye"></i></a> --}}

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
