@extends('layouts.layout')

@section('content')
    <h2>Preview: {{ $questionnaire->nama }}</h2>

    @if($questionnaire->pertanyaan->isEmpty())
        <p>No questions have been added to this questionnaire yet.</p>
    @else
        <form>
            @foreach($questionnaire->pertanyaan as $pertanyaan)
                <div class="form-group mb-4">
                    <label>{{ $pertanyaan->pertanyaan }}</label>
                    @if($pertanyaan->tipe_pertanyaan == 'teks')
                        <input type="text" class="form-control" placeholder="Enter your answer">
                    @elseif($pertanyaan->tipe_pertanyaan == 'pilihan ganda')
                        <!-- Render multiple-choice options dynamically -->
                        <div>
                            @foreach($pertanyaan->options as $option)
                                <div class="form-check">
                                    <input
                                        type="radio"
                                        class="form-check-input"
                                        name="option_{{ $pertanyaan->id }}"
                                        value="{{ $option->option_text }}"
                                    >
                                    <label class="form-check-label">{{ $option->option_text }}</label>
                                </div>
                            @endforeach
                        </div>
                    @elseif($pertanyaan->tipe_pertanyaan == 'nilai')
                        <input type="number" class="form-control" placeholder="Rate (1-5)">
                    @endif
                </div>
            @endforeach
        </form>
    @endif

    <a href="{{ route('questionnaires.index') }}" class="btn btn-secondary">Back to Questionnaires</a>
@endsection
