@extends('layout.master')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Welcome Admin!</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-one w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-icon">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="db-info">
                                <h3>{{$data['students']}}</h3>
                                <h6>Total Students</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-two w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-icon">
                                <i class="fas fa-crown"></i>
                            </div>
                            <div class="db-info">
                                <h3>{{$data['remain_fee']}}</h3>
                                <h6>Remain Fee</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-three w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="db-info">
                                <h3>{{$data['institutions']}}</h3>
                                <h6>Total Institutions</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 d-flex">
                <div class="card bg-four w-100">
                    <div class="card-body">
                        <div class="db-widgets d-flex justify-content-between align-items-center">
                            <div class="db-icon">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <div class="db-info">
                                <h3>{{$data['collected_fee']}}</h3>
                                <h6>Collected fees</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
