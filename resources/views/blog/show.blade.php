@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ $blog->title }}</h2>
    <h6 class="text-muted">Kategori: {{ $blog->category->title }}</h6>
    <p>{{ $blog->body }}</p>
    <a href="{{ route('welcome') }}" class="btn btn-secondary">Kembali</a>
</div>

@endsection