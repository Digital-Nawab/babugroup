@extends('layout.institution-master')
@section('styles')
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            float: left;
            padding-right: .5rem;
            color: #6c757d;
            content: var(--bs-breadcrumb-divider, "/");
        }

        .card-body {
            flex: 1 1 auto;
            padding: 0rem 0rem;
        }

        .table>thead {
            vertical-align: bottom;
            background: #18aefa;
            color: #fff;
        }
    </style>
@stop
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Teachers Attendance List</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('auth/dashboard') !!}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teachers Attendance List</li>
                    </ul>
                </div>
                <div class="col-auto text-end float-end ms-auto">
                    <a href="add-department.html" class="btn btn-primary"><i class="fas fa-plus"></i></a>
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
                                        <td>#</td>
                                        <td>Full Name</td>
                                        <td>Contact</td>
                                        <td>Attendance Date</td>
                                        <td>Attendance</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) != 0)
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{!! $key + 1 !!}.</td>
                                                <td>{!! ucfirst($row->full_name) !!}</td>
                                                <td>{!! $row->contact_mobile !!}</td>
                                                <td>{!! date('F d, Y', strtotime($row->attendance_date)) !!}</td>
                                                <td>
                                                    @switch($row->attendance)
                                                        @case('present')
                                                            <span class="badge fw-semibold py-1 w-85 bg-primary ">Present</span>
                                                        @break

                                                        @case('absent')
                                                            <span class="badge fw-semibold py-1 w-85 bg-danger">Absent</span>
                                                        @break

                                                        @case('leave')
                                                            <span class="badge fw-semibold py-1 w-85 bg-warning">Leave</span>
                                                        @break
                                                    @endswitch
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @stop
