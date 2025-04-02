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
                    <h3 class="page-title">Students List</h3>
                    {{-- <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ul> --}}
                </div>
                <div class="col-auto text-end float-end ms-auto">
                    <a href="{{url('admin/students/add-student')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Add New</a>
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
                                    @if (count($studentList) > 0)
                                        @foreach ($studentList as $key => $row)
                                            <tr>
{{--                                                <td>{{ $key + 1 }}</td>--}}
                                                <td>{{ ($studentList->currentPage() - 1) * $studentList->perPage() + $key + 1 }}</td>
                                                <td><a href="{{url('admin/students/student-basic-info/'.base64_encode($row->id))}}">{!! ucfirst($row->student_name) . ' S/o Mr. ' . ucfirst($row->father_name) !!}</a></td>
                                                <td>{!! $row->email !!}</td>
                                                <td>{!! date('F d, Y', strtotime($row->dob)) !!}</td>
                                                <td>{!! $row->mobile_num !!}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="edit-student.html"
                                                            class="btn btn-sm bg-success-light me-2">
                                                            <i class="fas fa-pen"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm bg-danger-light">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                        <a href="javascript:void(0)" class="btn btn-sm bg-success text-white me-2" data-bs-toggle="modal" data-bs-target="#approvalModal">
                                                            Approved
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if (count($studentList) != 0)
                                <div class="p-2">
                                    {!! $studentList->links('pagination::bootstrap-5') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="approvalModal" tabindex="-1" aria-labelledby="approvalModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="approvalModalLabel">Document Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Select an action for each document:</p>

                    <!-- Approval Table -->
                    <table class="table table-bordered text-center">
                        <thead class="table-dark">
                        <tr>
                            <th>Document Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Certificate</td>
                            <td>
                                <button class="btn btn-success btn-sm">Approve</button>
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </td>
                        </tr>
                        <tr>
                            <td>Aadhaar Document</td>
                            <td>
                                <button class="btn btn-success btn-sm">Approve</button>
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </td>
                        </tr>
                        <tr>
                            <td>12th Marksheet</td>
                            <td>
                                <button class="btn btn-success btn-sm">Approve</button>
                                <button class="btn btn-danger btn-sm">Reject</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@stop
