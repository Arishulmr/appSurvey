@extends('layouts.layout')

@section('content')
    <h2>Add Field to Questionnaire: {{ $questionnaire->nama }}</h2>
    <a href="{{ route('questionnaires.index') }}" class="btn btn-secondary mb-3">Back to Questionnaires</a>
    <div id="error-messages" class="text-danger mt-2"></div>

    <form id="add-field-form" method="POST" action="{{ route('questions.store', $questionnaire->id) }}">
        @csrf
        <div class="form-group mb-3">
            <label for="pertanyaan">Question</label>
            <input type="text" class="form-control form-control-lg" id="pertanyaan" name="pertanyaan" required>
        </div>
        <div class="form-group mb-3">
            <label for="tipe_pertanyaan">Question Type</label>
            <select class="form-control" id="tipe_pertanyaan" name="tipe_pertanyaan" required>
                <option value="pilihan ganda">Multiple Choice</option>
                <option value="teks">Text</option>
                <option value="nilai">Rating</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Field</button>
    </form>

    <h3 class="mt-5">Fields Added</h3>
    <ul id="fields-list" class="list-group mt-3">
        @foreach($questionnaire->pertanyaan as $question)
            <li class="list-group-item d-flex align-items-center justify-content-between" id="question-{{ $question->id }}">
                <div class="flex-grow-1 me-2">
                    <input type="text" class="form-control question-text" value="{{ $question->pertanyaan }}" data-question-id="{{ $question->id }}" disabled>
                </div>
                <div class="flex-grow-1 me-2">
                    <select class="form-control question-type" data-question-id="{{ $question->id }}" disabled>
                        <option value="pilihan ganda" {{ $question->tipe_pertanyaan === 'pilihan ganda' ? 'selected' : '' }}>Multiple Choice</option>
                        <option value="teks" {{ $question->tipe_pertanyaan === 'teks' ? 'selected' : '' }}>Text</option>
                        <option value="nilai" {{ $question->tipe_pertanyaan === 'nilai' ? 'selected' : '' }}>Rating</option>
                    </select>
                </div>

                @if($question->tipe_pertanyaan === 'pilihan ganda')
                    <div class="mt-2">
                        <ul class="option-list list-group">
                            <li class=" d-flex align-items-center">
                                <a href="{{ route('options.create', $question->id) }}" class="btn btn-primary btn-sm">Add Option</a>
                            </li>
                        </ul>
                    </div>
                @endif

                <div>
                    <button type="button" class="btn btn-warning btn-sm me-1 edit-question">Edit</button>
                    <button type="button" class="btn btn-success btn-sm me-1 save-question" style="display:none;">Save</button>
                    <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
    // Function to initialize event handlers
    function initializeEventHandlers() {
        // Edit button functionality
        $('.edit-question').off('click').on('click', function () {
            let $parentLi = $(this).closest('li');

            // Enable text and dropdown fields
            $parentLi.find('.question-text').prop('disabled', false);
            $parentLi.find('.question-type').prop('disabled', false);

            // Show Save button, hide Edit button
            $(this).hide();
            $parentLi.find('.save-question').show();
        });

        // Listen for changes in question type to toggle options display
        $('.question-type').off('change').on('change', function () {
            let $parentLi = $(this).closest('li');

            if ($(this).val() === 'pilihan ganda') {  // If the type is changed to "Multiple Choice"
                // Show the options section and enable option input
                $parentLi.find('.multiple-choice-options').show();
                $parentLi.find('.add-option').show();
                $parentLi.find('.option-item input').prop('disabled', false);
            } else {
                // Hide options if question type is no longer Multiple Choice
                $parentLi.find('.multiple-choice-options').hide();
                $parentLi.find('.add-option').hide();
                $parentLi.find('.option-item input').prop('disabled', true);
            }
        });

        // Save button functionality
        $('.save-question').off('click').on('click', function () {
            let $parentLi = $(this).closest('li');
            let questionId = $parentLi.find('.question-text').data('question-id');
            let updatedQuestion = $parentLi.find('.question-text').val();
            let updatedType = $parentLi.find('.question-type').val();

            // Collect options if it's a Multiple Choice question
            let options = [];
            if (updatedType === 'pilihan ganda') {
                $parentLi.find('.option-item input').each(function() {
                    options.push($(this).val());
                });
            }

            // AJAX request to save the updated question
            $.ajax({
                url: `/questions/${questionId}`,
                type: "PUT",
                data: {
                    _token: '{{ csrf_token() }}',
                    pertanyaan: updatedQuestion,
                    tipe_pertanyaan: updatedType,
                    options: options  // Pass options array for multiple choice
                },
                success: function (response) {
                    // Disable fields after saving
                    $parentLi.find('.question-text').prop('disabled', true);
                    $parentLi.find('.question-type').prop('disabled', true);
                    $parentLi.find('.option-item input').prop('disabled', true);

                    // Toggle buttons
                    $parentLi.find('.save-question').hide();
                    $parentLi.find('.edit-question').show();
                },
                error: function (xhr) {
                    alert('Failed to save changes. Please try again.');
                }
            });
        });

        // Event handler for adding new options in Multiple Choice
        $(document).on('click', '.add-option', function () {
            let $optionsContainer = $(this).closest('.options-container'); // Correct the scope to the right container
            $optionsContainer.append(`
                <div class="input-group mb-2 option-item">
                    <input type="text" class="form-control" placeholder="Option text" required>
                    <button type="button" class="btn btn-danger remove-option">Remove</button>
                </div>
            `);
        });

        // Remove option functionality
        $(document).on('click', '.remove-option', function () {
            $(this).closest('.option-item').remove();
        });
    }

    // Initialize event handlers on page load
    initializeEventHandlers();

    // Handle add field form submission via AJAX
    $('#add-field-form').on('submit', function (event) {
        event.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
            url: "{{ route('questions.store', $questionnaire->id) }}",
            type: "POST",
            data: formData,
            success: function (response) {
                $('#fields-list').append(`
                    <li class="list-group-item d-flex align-items-center justify-content-between" id="question-${response.id}">
                        <div class="flex-grow-1 me-2">
                            <input type="text" class="form-control question-text" value="${response.pertanyaan}" data-question-id="${response.id}" disabled>
                        </div>
                        <div class="flex-grow-1 me-2">
                            <select class="form-control question-type" data-question-id="${response.id}" disabled>
                                <option value="pilihan ganda" ${response.tipe_pertanyaan === 'pilihan ganda' ? 'selected' : ''}>Multiple Choice</option>
                                <option value="teks" ${response.tipe_pertanyaan === 'teks' ? 'selected' : ''}>Text</option>
                                <option value="nilai" ${response.tipe_pertanyaan === 'nilai' ? 'selected' : ''}>Rating</option>
                            </select>
                        </div>
                        <div class="multiple-choice-options" style="display: ${response.tipe_pertanyaan === 'pilihan ganda' ? 'block' : 'none'};">
                            <div class="options-container">
                                ${response.options ? response.options.map(option => `
                                    <div class="input-group mb-2 option-item">
                                        <input type="text" class="form-control" value="${option}" disabled>
                                    </div>
                                `).join('') : ''}
                            </div>
                            <button type="button" class="btn btn-secondary mt-2 add-option" style="display: ${response.tipe_pertanyaan === 'pilihan ganda' ? 'block' : 'none'};">Add Option</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-warning btn-sm me-1 edit-question">Edit</button>
                            <button type="button" class="btn btn-success btn-sm me-1 save-question" style="display:none;">Save</button>
                            <form action="/questions/${response.id}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </li>
                `);

                initializeEventHandlers();  // Reinitialize event handlers for new elements
                $('#add-field-form')[0].reset();
                $('#multiple-choice-options').hide();
                $('#error-messages').empty();
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessage = '';

                $.each(errors, function (key, value) {
                    errorMessage += value[0] + '<br>';
                });

                $('#error-messages').html(errorMessage);
            }
        });
    });
});

    </script>
@endsection
