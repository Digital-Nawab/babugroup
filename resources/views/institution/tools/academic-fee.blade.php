@extends('layout.institution-master')
@section('styles')
    <style>
        .breadcrumb-item+.breadcrumb-item::before {
            float: left;
            padding-right: .5rem;
            color: #6c757d;
            content: var(--bs-breadcrumb-divider, "/");
        }

        .page-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
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

        .card-table .table td {
            padding: 0.30rem;
            font-size: 14px;
        }

        .card-table .table th {
            padding: .75rem;
        }
    </style>
@stop
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Academic Fee</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('auth/dashboard') !!}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Academic Fee</li>
                    </ul> --}}
                </div>
                <div class="col-auto text-end float-end ms-auto">
                    <button class="btn btn-primary btn-sm addAcademiCourse"><i class="fas fa-plus"></i> New Add</button>
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
                                        <th>#</th>
                                        <th>Academic Batch</th>
                                        <th>Course Type</th>
                                        <th scope="col">Academic Year</th>
                                        <th scope="col">Fee</th>
                                        <th>Status</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($data) > 0)
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{!! $row->course_name . ' - ' . $row->subject !!}</td>
                                                <td>{!! $row->course_type !!}</td>
                                                <td>{!! $row->academic_year !!}</td>
                                                <td>{!! number_format($row->academic_fee, 2) !!}</td>
                                                <td>
                                                    @if ($row->is_active == '1')
                                                        <span
                                                            class="badge fw-semibold py-1 w-85 bg-success text-white">Active</span>
                                                    @else
                                                        <span class="badge fw-semibold py-1 w-85 bg-danger text-white">Non
                                                            Active</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    <a href="javascript:void(0)" class="btn btn-success btn-sm editAcademiFee"
                                                        data-id="{!! base64_encode($row->id) !!}" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-bs-title="Edit Academic Fee">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    @if ($row->is_active == '1')
                                                        <a href="javascript:void(0)" class="btn btn-danger btn-sm updateStatus"
                                                            data-id="{!! $row->id !!}" data-status="2"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-title="Non Active">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" class="btn btn-primary btn-sm updateStatus"
                                                            data-id="{!! $row->id !!}" data-status="1"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-title="Active">
                                                            <i class="fas fa-check"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if (count($data) != 0)
                                <div class="p-2">
                                    {!! $data->links('pagination::bootstrap-5') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @stop
