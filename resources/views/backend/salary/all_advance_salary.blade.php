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
                            <a href="{{ route('add.advance.salary') }}" class="btn btn-primary rounded-pill waves-effect waves-light">Add Advance Salary</a>
                        </ol>
                    </div>
                    <h4 class="page-title">All Salary</h4>
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
                                    <th>Month</th>
                                    <th>Salary</th>
                                    <th>Advance Salary</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        
                        
                            <tbody>
                                @foreach ($salary as $key=> $item)                                
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td><img src="{{ asset($item->employee->image) }}" alt="" style="width: 50px; height: 50px" class="rounded-circle"></td>
                                        <td>{{ $item->employee->name }}</td>
                                        <td>{{ $item->month }}</td>
                                        <td>{{ $item->employee->salaray }}</td>
                                        <td>{{ $item->advance_salary }}</td>
                                        <td>
                                            <a href="{{ route('edit.advance.salary',$item->id) }}" class="btn btn-blue rounded-pill waves-effect waves-light"><i class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="{{ route('delete.advance.salary',$item->id) }}" id="delete" class="btn btn-danger rounded-pill waves-effect waves-light"><i class="fa-solid fa-trash"></i></a>
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