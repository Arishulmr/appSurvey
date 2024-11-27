@extends('layouts.layout')

@section('content')
    <h2>Add New Questionnaire</h2>

    <form action="{{ route('questionnaires.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Questionnaire Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="kategori_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="kategori_id" required>
                <option value="" disabled selected>Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Questionnaire</button>
        <a href="{{ route('questionnaires.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
