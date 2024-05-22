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
                                <a href="{{ route('add.expense') }}"
                                    class="btn btn-primary waves-effect waves-light">Add Expense</a>

                            </ol>
                        </div>
                        <h4 class="page-title">Year Expense</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            @php
                $year = date('Y');
                $yearexpense = App\Models\Expense::where('year', $year)->sum('amount');
            @endphp

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Year Expense</h4>
                            <h4 style="color: white; font-size: 30px;" align="center"> Total : Rs {{ $yearexpense }}/=</h4>
                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>S1</th>
                                        <th>Details</th>
                                        <th>Amount</th>
                                        <th>Month</th>
                                        <th>Year</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($yearexpenses as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->details }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->month }}</td>
                                            <td>{{ $item->year }}</td>
                                            {{-- <td>
                                                <a href=" {{ route('edit.expense', $item->id) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                            </td> --}}
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
