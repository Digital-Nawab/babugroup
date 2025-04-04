@extends('layout.master')

@section('styles') 
 
@stop

@section('content')
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent mb-2 mt-2">
                <h4 class="mb-sm-0">{{ $title }}</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add {{ $title }}</h4>
                </div>
                <div class="card-body">
                    <form id="permissionForm">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <label for="permissionName" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="permissionName"
                                    placeholder="Permission Name" required>
                                <span id="nameError" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-success w-100" id="btnSubmit" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-7">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All {{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Permission Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="permissionTableBody">
                                <!-- Data will be loaded dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
    </div>
    <!-- end row -->
</div>
<!-- Bootstrap Toast Container -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1050">
    <div id="toastMessage" class="toast align-items-center text-white bg-success border-0" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>

<!-- Edit Permission Modal -->
<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPermissionModalLabel">Edit Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPermissionForm">
                    <input type="hidden" id="PermissionId">

                    <div class="mb-3">
                        <label for="editPermissionName" class="form-label">Permission Name</label>
                        <input type="text" class="form-control" id="editPermissionName" required>
                        <span id="editPermissionError" class="text-danger"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@stop

@section('scripts')
<script>
    $(document).ready(function () {
        fetchPermissions();
        $('#permissionForm').on('submit', function (e) {
            e.preventDefault();

            let formData = $(this).serialize();
            let submitButton = $('#btnSubmit');
            submitButton.prop('disabled', true).text('Submitting...');

            $.ajax({
                 url: "{{ url('admin/add-permission') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.status) {
                        showToast(response.message, 'success');
                        $('#permissionForm')[0].reset();
                        $('#nameError').text(''); 
                        fetchPermissions();
                    }
                },
                error: function (xhr) {
                    let response = xhr.responseJSON;
                    if (response?.errors) {
                        if (response.errors.name) {
                            $('#nameError').text(response.errors.name[0]); 
                            showToast(response.errors.name[0], 'danger'); 
                        }
                    } else {
                        showToast("Something went wrong!", 'danger');
                    }
                },
                complete: function () {
                    submitButton.prop('disabled', false).text('Submit');
                }
            });
        });

        function fetchPermissions() {
            $.ajax({
                url: "{{ url('admin/get-permissions') }}",
                type: "GET",
                success: function (permissions) {
                    let permissionTable = $('#permissionTableBody');
                    permissionTable.empty(); // Clear table body

                    if (permissions.length > 0) {
                        permissions.forEach((permission, index) => {
                            permissionTable.append(`
                                <tr id="permissionRow-${permission.id}">
                                    <td>${index + 1}</td>
                                    <td>${permission.name}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggleStatus" type="checkbox"
                                                data-id="${permission.id}" ${permission.status == 1 ? 'checked' : ''}>
                                            <label class="form-check-label status-label">
                                                ${permission.status == 1 ? 'Active' : 'Inactive'}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-warning text-white editPermission" data-id="${permission.id}" data-name="${permission.name}">Edit</button>
                                        <button class="btn btn-sm btn-danger deletePermission" data-id="${permission.id}">Delete</button>
                                    </td>
                                </tr>
                            `);
                        });
                    } else {
                        permissionTable.append('<tr><td colspan="4" class="text-center">No permissions found.</td></tr>');
                    }
                },
                error: function () {
                    showToast("Failed to load permissions", 'danger');
                }
            });
        }


        $(document).on('click', '.editPermission', function () {
            let permissionId = $(this).data('id');
            let permissionName = $(this).data('name');

            $('#editPermissionModal #PermissionId').val(permissionId);
            $('#editPermissionModal #editPermissionName').val(permissionName);
            $('#editPermissionModal').modal('show');
        });

        $('#editPermissionForm').on('submit', function (e) {
            e.preventDefault();
            let permissionId = $('#PermissionId').val();
            let permissionName = $('#editPermissionName').val();
            let status = $('#editPermissionStatus').val();
            
            $.ajax({
                url: `{{ url('admin/update-permission') }}/${permissionId}`,
                type: "POST",
                data: {
                    name: permissionName,
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.status) {
                        showToast(response.message, 'success');
                        $('#editPermissionModal').modal('hide');
                        $('#editPermissionError').text(''); // Clear validation error
                        fetchPermissions();
                    }
                },
                error: function (xhr) {
                    let response = xhr.responseJSON;
                    if (response?.errors) {
                        if (response.errors.name) {
                            $('#editPermissionError').text(response.errors.name[0]); // Show error message
                            showToast(response.errors.name[0], 'danger'); // Show error toast
                        }
                        if (response.errors.status) {
                            showToast(response.errors.status[0], 'danger');
                        }
                    } else if (response?.message) {
                        showToast(response.message, 'danger');
                    } else {
                        showToast("Something went wrong!", 'danger');
                    }
                },
                complete: function () {
                    submitButton.prop('disabled', false).text('Update');
                }
            });
        });

        $(document).on("change", ".toggleStatus", function () {
            let checkbox = $(this);
            let permissionId = checkbox.data("id");
            let newStatus = checkbox.prop("checked") ? 1 : 0;
            let statusLabel = checkbox.closest('.form-check').find('.status-label');

            $.ajax({
                url: "{{ url('admin/update-permission-status') }}",
                type: "POST",
                data: {
                    id: permissionId,
                    status: newStatus,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        statusLabel.text(newStatus == 1 ? "Active" : "Inactive");
                        showToast("permission status updated successfully", 'success');
                    } else {
                        checkbox.prop("checked", !newStatus); // Revert checkbox state if update fails
                        showToast("Failed to update status", 'danger');
                    }
                },
                error: function () {
                    checkbox.prop("checked", !newStatus); // Revert checkbox state if error occurs
                    showToast("Error updating status", 'danger');
                }
            });
        });


        // Function to Show Toast
        function showToast(message, type = 'success') {
            let toast = $('#toastMessage');
            toast.removeClass('bg-success bg-danger').addClass(`bg-${type}`);
            toast.find('.toast-body').text(message);
            let bsToast = new bootstrap.Toast(toast);
            bsToast.show();
        }

        $(document).on("click", ".deletePermission", function() {
                let permissionId = $(this).data("id");

                Swal.fire({
                    html: `
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" 
                            trigger="loop" colors="primary:#f7b84b,secondary:#f06548" 
                            style="width:100px;height:100px">
                        </lord-icon>
                        <p><b>Are you Sure ?</b></p>
                        <p style="font-size:15px;">Are you sure you want to remove</br/> this Permission?</p>
                    `,
                    showCancelButton: true,
                    confirmButtonColor: "#405189",
                    cancelButtonColor: "#f06548",
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: "Cancel",
                    customClass: {
                        confirmButton: 'btn btn-primary btn-sm',
                        cancelButton: 'btn btn-danger btn-sm'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('admin/delete-permission') }}/" + permissionId,
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    $("#permissionRow-" + permissionId)
                                        .remove(); // Remove row from table
                                    Swal.fire("Deleted!",
                                        "The permission has been removed successfully.",
                                        "success");
                                } else {
                                    Swal.fire("Error!",
                                        "Failed to delete the permission.", "error");
                                }
                            },
                            error: function() {
                                Swal.fire("Error!",
                                    "Something went wrong. Please try again.",
                                    "error");
                            }
                        });
                    }
                });
            });
    });
</script>
@stop