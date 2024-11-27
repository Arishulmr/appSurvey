@extends('layouts.layout')

@section('content')
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareModalLabel">Share with People</h5>
            </div>
            <div class="modal-body">
                <p>Select people to share with:</p>
                <form id="share-form">
                    <div id="people-list" class="mb-3">
                        @foreach($people as $person)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="person-{{ $person->id }}" name="selected_people[]" value="{{ $person->id }}">
                                <label class="form-check-label" for="person-{{ $person->id }}">{{ $person->nama }}</label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Hidden section for additional options -->
                    <div id="additional-options" class="d-none">
                        <label>Send via:</label>
                        <select id="send-method" class="form-control mb-3">
                            <option value="email">Email</option>
                            <option value="phone">Phone</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-primary" id="generate-link">Generate Link</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Questionnaire</h2>
        <a href="{{ route('questionnaires.create') }}" class="btn btn-primary">Add Questionnaire</a>
    </div>

    <table class="table table-bordered table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Questionnaire Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questionnaires as $questionnaire)
            <tr>
                <td>{{ $questionnaire->id }}</td>
                <td>{{ $questionnaire->nama }}</td>
                <td>{{ $questionnaire->kategori?->nama_kategori ?? 'No Category' }}</td>
                <td>
                    <a href="{{ route('questionnaires.add-question', $questionnaire->id) }}" class="btn btn-success btn-sm">Add Field</a>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#shareModal">Share</button>
                    <a href="{{ route('questionnaires.preview', $questionnaire->id) }}" class="btn btn-info">Show</a>
                    <!-- Other Actions -->
                    {{-- <a href="{{ route('questionnaire.edit', $questionnaire->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('questionnaires.destroy', $questionnaire->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button> --}}
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Show additional options when any checkbox is selected
        $('#people-list input[type="checkbox"]').on('change', function() {
            if ($('#people-list input:checked').length > 0) {
                $('#additional-options').removeClass('d-none'); // Show the send options
            } else {
                $('#additional-options').addClass('d-none'); // Hide the send options
            }
        });

        // Generate the link and close the modal
        $('#generate-link-only, #generate-link-send').on('click', function() {
            let selectedPeople = [];
            $('#people-list input:checked').each(function() {
                selectedPeople.push($(this).val());
            });

            // Perform an AJAX request to generate the link
            $.ajax({
                url: "{{ route('questionnaires.generateLink', $questionnaire->id) }}", // Update with route
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    people: selectedPeople,
                    method: $('#send-method').val() // Optional: for send option
                },
                success: function(response) {
                    // Display the link
                    alert('Link generated: ' + response.link);
                    $('#shareModal').modal('hide');
                },
                error: function() {
                    alert('Error generating link');
                }
            });
        });
    });
</script>
