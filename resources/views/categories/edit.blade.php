@extends('layouts.layout')

@section('content')

    <h2>Edit Category</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama_kategori" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $category->nama_kategori }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $category->deskripsi }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

@endsection
