<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        #articleButton {
            background-color: #4B49AC;
            color: white;
        }
    </style>
</head>

<body>
    @extends('dashboard.admin_dashboard')
    @section('articles')
        <div class="container py-3">
            <button type="button" id="articleButton" class="btn btn-sm mt-3" data-bs-toggle="modal"
                data-bs-target="#defaultModal">
                Create Article
            </button>
            <div class="mt-3">
                <table class="table table-striped" id="articlesTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

        <!-- Create Article Modal -->
        <div class="modal fade" id="defaultModal" tabindex="-1" aria-labelledby="defaultModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="defaultModalLabel">Create Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="articleForm">
                            @csrf
                            <div class="mb-3">
                                <label for="articleTitle" class="form-label">Title</label>
                                <input type="text" placeholder="Enter Title" name="title" id="articleTitle"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="articleAuthor" class="form-label">Author</label>
                                <input type="text" placeholder="Enter Author" name="author" id="articleAuthor"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="articleText" class="form-label">Content</label>
                                <textarea placeholder="Enter Content" name="text" id="articleText" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Article Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editArticleForm">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="editArticleId">
                            <div class="mb-3">
                                <label for="editArticleTitle" class="form-label">Title</label>
                                <input type="text" placeholder="Enter Title" name="title" id="editArticleTitle"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editArticleAuthor" class="form-label">Author</label>
                                <input type="text" placeholder="Enter Author" name="author" id="editArticleAuthor"
                                    class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="editArticleText" class="form-label">Content</label>
                                <textarea placeholder="Enter Content" name="text" id="editArticleText" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#articlesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('articles.index') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'author', name: 'author' },
                    { data: 'created_at', name: 'created_at', render: function(data) {
                        var date = new Date(data);
                        return date.toLocaleDateString('en-GB');
                    }},
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });

            // Create Article
            $('#articleForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('articles.store') }}",
                    method: 'POST',
                    data: {
                        title: $('#articleTitle').val(),
                        author: $('#articleAuthor').val(),
                        text: $('#articleText').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#defaultModal').modal('hide');
                        table.ajax.reload();
                        alert(response.success);
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors && errors.title) {
                            alert(errors.title[0]);
                        } else if (errors && errors.author) {
                            alert(errors.author[0]);
                        } else if (errors && errors.text) {
                            alert(errors.text[0]);
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });


            $('#articlesTable').on('click', '.edit', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: "{{ url('articles') }}/" + id + "/edit",
        method: 'GET',
        success: function(response) {
            $('#editArticleId').val(response.id);
            $('#editArticleTitle').val(response.title);
            $('#editArticleAuthor').val(response.author);
            $('#editArticleText').val(response.text);
            $('#editModal').modal('show');
        },
        error: function(xhr) {
            console.error(xhr);
            alert('Failed to fetch data.');
        }
    });
});

            $('#editArticleForm').on('submit', function(e) {
                e.preventDefault();
                var id = $('#editArticleId').val();
                $.ajax({
                    url: "{{ url('articles') }}/" + id,
                    method: 'PUT',
                    data: {
                        title: $('#editArticleTitle').val(),
                        author: $('#editArticleAuthor').val(),
                        text: $('#editArticleText').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#editModal').modal('hide');
                        table.ajax.reload();
                        alert(response.success);
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors && errors.title) {
                            alert(errors.title[0]);
                        } else if (errors && errors.author) {
                            alert(errors.author[0]);
                        } else if (errors && errors.text) {
                            alert(errors.text[0]);
                        } else {
                            alert('Something went wrong. Please try again.');
                        }
                    }
                });
            });


            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                var url = '{{ route('articles.destroy', ':id') }}';
                url = url.replace(':id', id);

                if (confirm('Are you sure you want to delete this article?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(result) {
                            alert(result.success);
                            table.ajax.reload();
                        },
                        error: function(xhr) {
                            alert('An error occurred while deleting the article.');
                        }
                    });
                }
            });

            $('#defaultModal').on('hidden.bs.modal', function() {
                $('.modal-backdrop').remove();
                $('body').removeClass('modal-open');
            });
        });
    </script>
</body>

</html>
