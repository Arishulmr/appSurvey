@extends('layouts.layout')

@section('content')

    <div class="mb-3 d-flex justify-content-between">
        <div>
            @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

            <form action="{{ route('categories.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by category name" aria-label="Search">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div>
            <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>
        </div>
    </div>

    <table class="table table-bordered table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($categories->isEmpty())
                <tr>
                    <td colspan="4" class="text-center">No records found.</td>
                </tr>
            @else
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->nama_kategori }}</td>
                        <td>{{ $category->deskripsi }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>

@endsection
