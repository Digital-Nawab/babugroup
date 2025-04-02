@extends('layout.master')
@section('styles')
    <style>
        .page-title {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 0;
        }
        .card .about-info {
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .card .about-info img {
            width: 150px;
        }
        .card-body .about-info p {
            margin-bottom: 10px;
            font-size: 16px;
        }
        .card .about-info i {
            color: #18aefa;
            margin-right: 10px;
        }

        .table>thead {
            background: #18aefa;
            color: #fff;
            text-align: center;
        }

        .table td, .table th {
            font-size: 14px;
            text-align: center;
        }

        .table td a {
            color: #fff;
            text-decoration: none;
        }

        .card-table .table td {
            font-size: 14px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .btn {
            border-radius: 4px;
            padding: 6px 12px;
        }

        .btn-success-light {
            background-color: #28a745;
            color: #fff;
        }

        .btn-danger-light {
            background-color: #dc3545;
            color: #fff;
        }

        .actions .btn {
            margin-right: 10px;
        }

        .pagination .page-item.active .page-link {
            background-color: #18aefa;
            border-color: #18aefa;
        }

        .pagination .page-item .page-link {
            border: none;
            color: #333;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .table td, .table th {
                padding: 8px;
            }
        }
    </style>
@stop

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">College Details</h3>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body about-info">
                <div class="row">
                    <div class="col-md-2">
                        <div class="about-img">
{{--                           <img src="{{asset($college_detail->logo)}}" alt="college-logo"/>--}}
                            <img src="{{asset('assets')}}/img/logo.png" width="100" alt="college-logo"/>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="">
                            <p><i class="icon fas fa-university"></i><strong> College Name:</strong> {{$college_detail->institution_name}}</p>
                            <p><i class="icon fas fa-envelope"></i><strong> College Email:</strong> {{$college_detail->institution_email}}</p>
                            <p><i class="icon fas fa-phone-alt"></i><strong> College Contact:</strong> {{$college_detail->institution_contact}}</p>
                            <p><i class="icon fas fa-map-marker-alt"></i><strong> College Address:</strong> {{$college_detail->institution_address}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>DOB</th>
                                    <th>Mobile Number</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($college_student) > 0)
                                    @foreach ($college_student as $key => $row)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{!! ucfirst($row->student_name) . ' S/o Mr. ' . ucfirst($row->father_name) !!}</td>
                                            <td>{!! $row->email !!}</td>
                                            <td>{!! date('F d, Y', strtotime($row->dob)) !!}</td>
                                            <td>{!! $row->mobile_num !!}</td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="edit-student.html" class="btn btn-sm btn-success-light">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-sm btn-danger-light">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>

                            @if (count($college_student) != 0)
                                <div class="p-2">
                                    {!! $college_student->links('pagination::bootstrap-5') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
