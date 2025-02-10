@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Blog Posts</h2>

    <!-- Form untuk membuat blog -->
    <form action="{{ route('blog.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="summary">Summary</label>
            <input type="text" name="summary" id="summary" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea name="body" id="summernote" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="publish">Publish</option>
                <option value="draft">Draft</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Blog</button>
    </form>

    <hr>

    <!-- Daftar Blog -->
    @foreach($blogs as $blog)
    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">{{ $blog->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $blog->category->title }}</h6>
            <p class="card-text">{{ $blog->summary }}</p>
            <a href="{{ route('blog.edit', $blog) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('blog.destroy', $blog) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
    @endforeach
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
