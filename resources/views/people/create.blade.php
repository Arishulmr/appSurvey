@extends('layouts.layout')

@section('content')
    <h2>Add New Person</h2>

    <form action="{{ route('people.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Name</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" required>
        </div>
        <button type="submit" class="btn btn-success">Add Person</button>
        <a href="{{ route('people.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
