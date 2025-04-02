@extends('layout.master')
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

        .offcanvas h4 {
            font-size: 20px;
        }
    </style>
@stop
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Collected Student Fee</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('auth/dashboard') !!}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Collected Student Fee</li>
                    </ul> --}}
                </div>
                <div class="col-auto text-end float-end ms-auto">
                    <a href="add-department.html" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></a>
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
                                        <td>Student Details</td>
                                        <td>Student Contact Number</td>
                                        <td>Academy Year</td>
                                        <td>Academy Course</td>
                                        <td>Course Type</td>
                                        <td>Payed Amount</td>
                                        <td>Payed Date</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($academicFee) != 0)
                                        @foreach ($academicFee as $key => $row)
                                            <tr>
                                                <td>{!! $key + 1 !!}</td>
                                                <td>{!! ucfirst($row->student_name) . ' S/O Mr.' . ucfirst($row->father_name) !!}</td>
                                                <td>{!! $row->mobile_num !!}</td>
                                                <td>{!! $row->academic_year !!}</td>
                                                <td>{!! $row->course_name . ' - ' . $row->subject !!}</td>
                                                <td>{!! $row->course_type !!}</td>
                                                <td>
                                                    {!! $row->payed_amount != 0 ? number_format($row->payed_amount) . '( ' . $row->payment_mode . ' )' : '-' !!}
                                                    @if ($row->any_note != '' || $row->any_note != null)
                                                        <br /><span>{!! $row->any_note !!}</span>
                                                    @endif
                                                </td>
                                                <td>{!! $row->payment_date != '' ? date('F, d Y', strtotime($row->payment_date)) : '-' !!}</td>

                                                <td>
                                                    @if ($row->fee_status == 'pay')
                                                        <span
                                                            class="badge fw-semibold py-1 w-85 bg-success text-white text-center">Payed</span>
                                                    @else
                                                        <span
                                                            class="badge fw-semibold py-1 w-85 bg-danger text-white">Remain</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- <a href="javascript:void(0)" class="btn btn-primary editAddress" data-id="{!! base64_encode($row->id) !!}"   data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit Address">
                                                        <i class="ti ti-edit-circle fs-2"></i>
                                                    </a> --}}
                                                    @if ($row->fee_status == 'pay')
                                                        <a href="javascript:void(0)" class="btn btn-danger printReceipt"
                                                            data-id="{!! $row->id !!}" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" data-bs-title="Print Receipt">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                    @elseif($row->fee_status == 'remain')
                                                        <a href="javascript:void(0)" class="btn btn-primary payNow"
                                                            data-id="{!! base64_encode($row->student_id) !!}" data-bs-toggle="tooltip"
                                                            data-bs-placement="bottom" data-bs-title="Pay Now">
                                                            <i class="fa fa-currency"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                {{-- <tbody>
                                    @if (count($data) > 0)
                                        @foreach ($data as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{!! $row->course_name !!}</td>
                                                <td>{!! $row->subject !!}</td>
                                                <td>{!! $row->institution_name . ' - ' . $row->institution_id !!}</td>
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
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-success bg-success-light editAcademiCourse"
                                                        data-id="{!! base64_encode($row->id) !!}" data-bs-toggle="tooltip"
                                                        data-bs-placement="bottom" data-bs-title="Edit Academic Course">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    @if ($row->is_active == '1')
                                                        <a href="javascript:void(0)" class="btn btn-danger updateStatus"
                                                            data-id="{!! $row->id !!}" data-status="2"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-title="Non Active">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" class="btn btn-primary updateStatus"
                                                            data-id="{!! $row->id !!}" data-status="1"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            data-bs-title="Active">
                                                            <i class="ti ti-check"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @stop
