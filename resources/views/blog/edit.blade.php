@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Edit Blog</h2>

    <div class="card shadow-sm p-4 mb-5">
        <h4 class="mb-3">Edit Blog</h4>
        <form action="{{ route('blog.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select name="category_id" id="category_id" class="form-select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}" required>
            </div>
            <div class="mb-3">
                <label for="summary" class="form-label">Summary</label>
                <input type="text" name="summary" id="summary" class="form-control" value="{{ $blog->summary }}" required>
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea name="body" id="summernote" class="form-control" rows="5" required>{{ $blog->body }}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="publish" {{ $blog->status == 'publish' ? 'selected' : '' }}>Publish</option>
                    <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Blog</button>
        </form>
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
