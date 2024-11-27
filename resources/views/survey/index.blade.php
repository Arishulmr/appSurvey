@extends('layouts.layout')

@section('content')
    <h2>Survey</h2>
    <p>List of survey will be shown here.</p>

    <table class="table table-bordered table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Kategori</th>
                <th>User</th>
                <th>Pertanyaan</th>
            </tr>
        </thead>
        <tbody>
            @if($surveys->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">No records found.</td>
                </tr>
            @else
                @foreach($surveys as $survey)
                    <tr>
                        <td>{{ $survey->id }}</td>
                        <td>{{ $survey->title }}</td>
                        <td>{{ $survey->status }}</td>
                        <td>{{ $survey->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $survey->kategori_id }}</td>
                        <td>{{ $survey->user_id }}</td>
                        <td>{{ $survey->pertanyaan_id }}</td>

                        <td>
                            <a href="{{ route('survey.edit', $survey->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('survey.destroy', $survey->id) }}" method="POST" style="display:inline;">
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
