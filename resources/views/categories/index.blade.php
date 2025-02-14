<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<<<<<<< HEAD
=======
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
>>>>>>> 27baec4 (Entah commit ke berapa)
</head>
<body>
    <div class="container mt-4">
        <h2>Category List</h2>
        
        <div class="mb-3">
            <a href="/v1" class="btn btn-secondary">Dashboard</a>
            <a href="/blog" class="btn btn-success">Buat Blog</a>
        </div>
        
        <button class="btn btn-primary mb-3" id="addCategoryBtn">Add Category</button>
        
        <table class="table table-bordered" id="categoryTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal for Add/Edit -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="categoryId">
                    <div class="mb-3">
                        <label for="categoryTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="categoryTitle">
                    </div>
                    <button type="button" class="btn btn-primary" id="saveCategory">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#categoryTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('categories.list') }}",
                columns: [
                    { data: 'id' },
                    { data: 'title' },
                    { data: 'slug' },
                    { data: 'user' },
                    { data: 'action', orderable: false }
                ]
            });

            $('#addCategoryBtn').click(function() {
                $('#categoryModal').modal('show');
                $('#modalTitle').text('Add Category');
                $('#categoryId').val('');
                $('#categoryTitle').val('');
            });

            $('#saveCategory').click(function() {
                let id = $('#categoryId').val();
                let title = $('#categoryTitle').val();
                let url = id ? "{{ route('categories.update') }}" : "{{ route('categories.store') }}";

                $.post(url, { id, title, _token: "{{ csrf_token() }}" }, function(response) {
                    $('#categoryModal').modal('hide');
                    table.ajax.reload();
<<<<<<< HEAD
=======
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: id ? 'Kategori berhasil diperbarui!' : 'Kategori berhasil ditambahkan!',
                        timer: 1500,
                        showConfirmButton: false
                    });
>>>>>>> 27baec4 (Entah commit ke berapa)
                });
            });

            $(document).on('click', '.editCategory', function() {
                $('#categoryModal').modal('show');
                $('#modalTitle').text('Edit Category');
                $('#categoryId').val($(this).data('id'));
                $('#categoryTitle').val($(this).data('title'));
            });

            $(document).on('click', '.deleteCategory', function() {
                let id = $(this).data('id');
<<<<<<< HEAD
                $.ajax({
                    url: "{{ route('categories.destroy') }}",
                    type: "DELETE",
                    data: { id, _token: "{{ csrf_token() }}" },
                    success: function() {
                        table.ajax.reload();
=======
                
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data akan dihapus secara permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('categories.destroy') }}",
                            type: "DELETE",
                            data: { id, _token: "{{ csrf_token() }}" },
                            success: function() {
                                table.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Dihapus!',
                                    text: 'Kategori telah berhasil dihapus.',
                                    timer: 1500,
                                    showConfirmButton: false
                                });
                            }
                        });
>>>>>>> 27baec4 (Entah commit ke berapa)
                    }
                });
            });
        });
    </script>
</body>
</html>
