@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">Welcome to Our Blog</h2>

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
                        <!-- Tombol untuk melihat detail blog -->
                        <a href="{{ route('blog.show', $blog) }}" class="btn btn-info">Read More</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
