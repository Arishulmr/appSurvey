@extends('layouts.layout')

@section('content')
<h2>People</h2>
    <a href="{{ route('people.create') }}" class="btn btn-primary mb-3">Add New Person</a>
    <table class="table table-bordered table-striped mt-4">
        <div class="mb-3">
            <form action="{{ route('people.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by name or email" aria-label="Search">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($people->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">No records found.</td>
                </tr>
            @else
                @foreach($people as $person)
                    <tr>
                        <td>{{ $person->id }}</td>
                        <td>{{ $person->nama }}</td>
                        <td>{{ $person->email }}</td>
                        <td>{{ $person->nomor_telepon }}</td>
                        <td>
                            <a href="{{ route('people.edit', $person->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-success btn-sm">Share</a>
                            <form action="{{ route('people.destroy', $person->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this person?')">Delete</button>


                            </form>
                        </td>

                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection
