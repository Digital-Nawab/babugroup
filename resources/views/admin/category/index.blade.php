@extends('layout.master')
@section('styles')

@stop
@section('content')
    <div class="content">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">All {!! ucfirst($nav) !!}</h3>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-sm-7">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-center mb-0 datatable">
                                <thead class="bg-success-light">
                                <tr>
                                    <th>#</th>
                                    <th>{!! ucfirst($nav) !!} Name</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if (count($data) > 0)
                                    @foreach ($data as $key => $row)

                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{!! ucfirst($row->name) !!}</td>
                                            <td>
                                                @if ($row->status == '1')
                                                    <span class="badge fw-semibold py-1 w-85 bg-success text-white">Active</span>
                                                @else
                                                    <span class="badge fw-semibold py-1 w-85 bg-danger text-white">NonActive</span>
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="javascript:void(0)" class="btn btn-success btn-sm editYear" data-id="{!! base64_encode($row->id) !!}" data-name="{!! $row->name !!}"  data-location="{!! $row->location !!}" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Edit Subject">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="{!! url('admin/tools/update-category/'.base64_encode($row->id)) !!}" class="btn {{ $row->status ? 'btn-danger' : 'btn-success' }} btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="{{ $row->status ? 'Deactivate' : 'Activate' }}"><i class="fas {{ $row->status ? 'fa-trash' : 'fa-check' }}"></i></a>

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
            <div class="col-sm-5">
                <div class="card">
                    <div class="bg-success-light p-2 ">
                        <h5 class="card-title">Add {!! ucfirst($nav) !!}</h5>
                    </div>
                    <div class="card-body p-3">
                        <form method="post" action="{!! url('admin/tools/add-'.{!! $nav !!}) !!}" enctype="application/x-www-form-urlencoded">
                            @csrf
                            <input type="hidden" name="_id" />
                            <div class="row">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{!! ucfirst($nav) !!} Name</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 text-left">
                                    <label for="subject">&nbsp;</label><br>
                                    <button type="submit" class="btn btn-outline-primary"><i class="ti-save"></i> Create {!! ucfirst($nav) !!}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!------------Modal Popup --------------------->




            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                 aria-labelledby="offcanvasExampleLabel" data-simplebar="" style="width: 30%">
                <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                    <h4 class="offcanvas-title fw-semibold" id="offcanvasExampleLabel">Update  {!! ucfirst($nav) !!}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <form method="post" action="{!! url('admin/tools/add-category') !!}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="_id" />
                        <div class="row">

                            <div class="mb-3">
                                <label for="name" class="form-label">{!! ucfirst($nav) !!} Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 text-center mt-4">
                                <button type="submit" class="btn btn-outline-primary"><i class="ti-save"></i> Update {!! ucfirst($nav) !!}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @stop

            @section('scripts')
                <script type="text/javascript">

                    /* update Academic Year */
                    $(document).on("click", ".editYear", function() {
                        let id = $(this).data('id'), name = $(this).data('name'), location = $(this).data('location');
                        $("#offcanvasExample input[name='_id']").val(id);
                        $("#offcanvasExample input[name='name']").val(name);
                        $("#offcanvasExample").offcanvas("show");
                    });
                </script>
@stop
