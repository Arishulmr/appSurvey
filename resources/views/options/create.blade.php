@extends('layouts.layout')

@section('content')
    <h2>Manage Options for Question: "{{ $question->pertanyaan }}"</h2>
    <a href="{{ route('questionnaires.add-question', $question->questionnaire_id) }}" class="btn btn-secondary mb-3">Back to Questionnaire</a>

    <!-- Display Existing Options -->
    <h4>Existing Options</h4>
    <ul class="list-group mb-4">
        @foreach($question->options as $option)
            <li class="list-group-item d-flex align-items-center justify-content-between" id="option-{{ $option->id }}">
                <div class="flex-grow-1">
                    <input
                        type="text"
                        class="form-control option-text me-3"
                        value="{{ $option->option_text }}"
                        data-option-id="{{ $option->id }}"
                        disabled>
                </div>
                <div>
                    <button type="button" class="btn btn-warning btn-sm me-1 edit-option">Edit</button>
                    <button type="button" class="btn btn-success btn-sm me-1 save-option" style="display:none;">Save</button>
                    <form action="{{ route('options.destroy', $option->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <!-- Add New Options -->
    <h4>Add New Options</h4>
    <form method="POST" action="{{ route('options.store', $question->id) }}">
        @csrf
        <div id="options-container">
            <div class="form-group mb-3">
                <label for="options[0]">Option</label>
                <input type="text" class="form-control" id="options[0]" name="options[0]" required>
            </div>
        </div>
        <button type="button" id="add-option" class="btn btn-secondary mb-3">Add Another Option</button>
        <button type="submit" class="btn btn-primary">Save Options</button>
    </form>

    <!-- JavaScript -->
    <script>
        let optionIndex = 1;

        // Add new option dynamically
        document.getElementById('add-option').addEventListener('click', function () {
            const container = document.getElementById('options-container');
            const newOption = `
                <div class="form-group mb-3">
                    <label for="options[${optionIndex}]">Option</label>
                    <input type="text" class="form-control" id="options[${optionIndex}]" name="options[${optionIndex}]" required>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newOption);
            optionIndex++;
        });

        // Edit option functionality
        document.querySelectorAll('.edit-option').forEach(button => {
            button.addEventListener('click', function () {
                const parentLi = this.closest('li');
                const inputField = parentLi.querySelector('.option-text');
                inputField.disabled = false;

                this.style.display = 'none'; // Hide Edit button
                parentLi.querySelector('.save-option').style.display = 'inline-block'; // Show Save button
            });
        });

        // Save updated option functionality
        document.querySelectorAll('.save-option').forEach(button => {
            button.addEventListener('click', function () {
                const parentLi = this.closest('li');
                const inputField = parentLi.querySelector('.option-text');
                const optionId = inputField.dataset.optionId;
                const updatedText = inputField.value;

                // AJAX request to update the option
                fetch(`/options/${optionId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ option_text: updatedText }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to save changes');
                    }
                    return response.json();
                })
                .then(data => {
                    inputField.disabled = true;

                    this.style.display = 'none'; // Hide Save button
                    parentLi.querySelector('.edit-option').style.display = 'inline-block'; // Show Edit button
                })
                .catch(error => {
                    alert('Error updating option: ' + error.message);
                });
            });
        });
    </script>
@endsection
