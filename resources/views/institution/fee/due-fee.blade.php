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
                    <h3 class="page-title">Due Student Fee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{!! url('auth/dashboard') !!}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Due Student Fee</li>
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
                                        <td>Student Details</td>
                                        <td>Student Contact Number</td>
                                        <td>Academy Year</td>
                                        <td>Academy Course</td>
                                        <td>Course Type</td>
                                        <td>Remain Amount</td>
                                        <td>Due Date</td>
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
                                                <td>{!! $row->installment_amount != 0 ? number_format($row->installment_amount) : '-' !!}</td>
                                                <td>{!! $row->installment_date != '' ? date('F, d Y', strtotime($row->installment_date)) : '-' !!}</td>

                                                <td>
                                                    @if ($row->fee_status == 'pay')
                                                        <span
                                                            class="badge fw-semibold py-1 w-85 bg-primary text-white text-center">Payed</span>
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
                                                            <i class="fa fa-wallet"></i>
                                                        </a>
                                                    @endif
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
