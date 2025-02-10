@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Blog Posts</h2>

    <div class="mb-3 d-flex justify-content-center">
        <a href="/v1" class="btn btn-secondary mx-2">Dashboard</a>
        <a href="/categories" class="btn btn-success mx-2">Buat Categories</a>
    </div>


    <!-- Form untuk membuat blog -->
    <div class="card shadow-sm p-4 mb-5">
        <h4 class="mb-3">Create a New Blog</h4>
        <form action="{{ route('blog.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Summary</label>
                <input type="text" name="summary" id="summary" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea name="body" id="summernote" class="form-control" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Create Blog</button>
        </form>
    </div>

    <!-- Daftar Blog -->
    <div class="row">
        @foreach($blogs as $blog)
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title">{{ $blog->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $blog->category->title }}</h6>
                    <p class="card-text">{{ $blog->summary }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('blog.edit', $blog) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('blog.destroy', $blog) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write your content here...',
            tabsize: 2,
            height: 200
        });
    });
</script>
@endsection