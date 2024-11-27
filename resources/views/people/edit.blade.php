@extends('layouts.layout')

@section('content')
    <h2>Edit Person</h2>

    <form action="{{ route('people.update', $person->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Name</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $person->nama }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $person->email }}" required>
        </div>

        <div class="mb-3">
            <label for="nomor_telepon" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ $person->nomor_telepon }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('people.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
