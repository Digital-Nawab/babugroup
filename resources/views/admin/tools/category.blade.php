@extends('layout.master')
@section('styles')

@stop
@section('content')
<div class="content">
    <!-- Page Header -->
    <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
        <div class="my-auto mb-2">
            <h3 class="page-title mb-1">{{ $title }}</h3>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
            <div class="mb-2">
                {{ $title }}
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ $title }}</h5>
                </div>
                <div class="card-body">
                    <form id="categoryForm">
                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Category Name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" id="description" placeholder="Description" required></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between flex-wrap pb-0">
                    <h4 class="mb-3">College Category List</h4>
                </div>
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-sm-12 table-responsive">
                            <table class="table table-striped table-nowrap align-middle mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="categoryTableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm">
                    <input type="hidden" id="editCategoryId">
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="editCategoryName" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoryDesc" class="form-label">Description</label>
                        <input type="text" class="form-control" id="editCategoryDesc" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

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

@stop

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {

        fetchCategories();

        $('#categoryForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ url('admin/tools/add-category') }}",
                type: "POST",
                data: $(this).serialize(),
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                },
                success: function(response){
                    if(response.status === true) {
                        showToast(response.message, 'success');
                        $('#categoryForm')[0].reset();
                        fetchCategories();
                        $("#categoryModal").modal("hide");
                    }else {
                        showToast("Failed to add Provider!", 'danger');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = errors.join("<br>");
                        showToast(errorMessages, 'danger');
                    } else {
                        console.log(xhr.responseText);
                        showToast("Something went wrong!", 'danger');
                    }
                }
            })
        });

        function fetchCategories() {
            $.ajax({
                url: "{{ url('admin/tools/get-category') }}",
                type: "GET",
                success: function (response) {
                    let rows = '';
                    $.each(response, function (index, category) {
                        rows += `<tr>
                            <td>${index + 1}</td>
                            <td>${category.name}</td>
                            <td>${category.description}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input toggleStatus" type="checkbox"
                                        data-id="${category.id}" ${category.status == 1 ? 'checked' : ''}>
                                    <label class="form-check-label status-label">
                                        ${category.status == 1 ? 'Active' : 'Inactive'}
                                    </label>
                                </div>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning editcategory" 
                                data-id="${category.id}" data-name="${category.name}" 
                                data-description="${category.description}">Edit</button>
                                <button class="btn btn-sm btn-danger deleteCategory" data-id="${category.id}">Delete</button>
                            </td>
                        </tr>`;
                    });
                    $("#categoryTableBody").html(rows);
                }
            });
        }

        $(document).on('click', '.editcategory', function () {
            let catId = $(this).data('id');
            let catName = $(this).data('name');
            let catedesc = $(this).data('description');

            $('#editCategoryModal #editCategoryId').val(catId);
            $('#editCategoryModal #editCategoryName').val(catName);
            $('#editCategoryModal #editCategoryDesc').val(catedesc);
            $('#editCategoryModal').modal('show');
        });

        $('#editCategoryForm').on('submit', function (e) {
            e.preventDefault();
            let catId = $('#editCategoryId').val();
            let catName = $('#editCategoryName').val();
            let catedesc = $('#editCategoryDesc').val();

            $.ajax({
                url: "{{ url('admin/tools/update-category') }}/" + catId,
                type: "POST",
                data: {
                    name: catName,
                    description : catedesc,
                    _token: "{{ csrf_token() }}"
                },

                success: function (response){
                    if(response.status){
                        showToast(response.message, 'success');
                        $('#editCategoryModal').modal('hide');
                        fetchCategories();
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) { 
                        // Validation error (Laravel returns 422 for validation failures)
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        $.each(errors, function (key, value) {
                            errorMessage += value[0] + '<br>'; // Collect errors
                        });
                        showToast(errorMessage, 'danger'); // Show error messages
                    } else if (xhr.status === 404) {
                        showToast('Category not found!', 'danger');
                    } else {
                        showToast('Something went wrong!', 'danger');
                    }
                }
            })
        })


        $(document).on("change", ".toggleStatus", function() {
            let univerId = $(this).data("id");
            let newStatus = $(this).is(":checked") ? 1 : 0; // Get new status
            let statusLabel = $(this).closest("td").find(".status-label");

            $.ajax({
                url: "{{ url('admin/tools/category-status') }}/" + univerId,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: newStatus
                },
                success: function(response) {
                    // Update status text dynamically without refresh
                    if (newStatus == 1) {
                        statusLabel.text("Active");
                    } else {
                        statusLabel.text("Inactive");
                    }
                    showToast(response.message, "success");
                },
                error: function() {
                    showToast("Failed to update status", "danger");
                }
            });
        });

        function showToast(message, type = 'success') {
            let toast = $('#toastMessage');
            toast.removeClass('bg-success bg-danger').addClass(`bg-${type}`);
            toast.find('.toast-body').text(message);
            let bsToast = new bootstrap.Toast(toast);
            bsToast.show();
        }
    });
</script>
@stop