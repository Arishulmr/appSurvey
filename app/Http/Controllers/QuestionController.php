<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Pertanyaan;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function createOptions($id)
{
    $question = Pertanyaan::with('options')->findOrFail($id); // Fetch the question and its options
    return view('options.create', compact('question'));
}
public function storeOptions(Request $request, $id)
{
    $question = Pertanyaan::findOrFail($id);

    $request->validate([
        'options.*' => 'required|string|max:255',
    ]);

    foreach ($request->options as $optionText) {
        $question->options()->create(['option_text' => $optionText]);
    }

    return redirect()->route('questionnaires.preview', $question->questionnaire_id)
                     ->with('success', 'Options added successfully!');
}

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'tipe_pertanyaan' => 'required|string',
            'options' => 'nullable|array',
            'options.*' => 'required|string|max:255'
        ]);

        $question = Pertanyaan::findOrFail($id);
        $question->update([
            'pertanyaan' => $validatedData['pertanyaan'],
            'tipe_pertanyaan' => $validatedData['tipe_pertanyaan']
        ]);

        // If the question is multiple choice, update options
        if ($validatedData['tipe_pertanyaan'] === 'pilihan ganda') {
            // Remove existing options if new options are provided
            if (!empty($validatedData['options'])) {
                $question->options()->delete();
                foreach ($validatedData['options'] as $option) {
                    $question->options()->create(['text' => $option]);
                }
            }
        }

        return response()->json($question->load('options')); // Return updated question with options
    }

    public function destroy(Pertanyaan $question)
    {
        $question->delete();

        return back();
    }

    public function create($questionnaireId)
    {
        // Optionally, you can fetch the questionnaire if needed
        $questionnaire = Questionnaire::findOrFail($questionnaireId);

        return view('questions.create', compact('questionnaire'));
    }

        public function store(Request $request, $questionnaireId)
        {
            $validatedData = $request->validate([
                'pertanyaan' => 'required|string|max:255',
                'tipe_pertanyaan' => 'required|string',
                'options' => 'nullable|array',
                'options.*' => 'required|string|max:255'
            ]);

            $question = Pertanyaan::create([
                'pertanyaan' => $validatedData['pertanyaan'],
                'tipe_pertanyaan' => $validatedData['tipe_pertanyaan'],
                'questionnaire_id' => $questionnaireId
            ]);

            // If it's a multiple-choice question, store the options
            if ($validatedData['tipe_pertanyaan'] === 'pilihan ganda' && isset($validatedData['options']) && !empty($validatedData['options'])) {
                foreach ($validatedData['options'] as $option) {
                    $question->options()->create(['text' => $option]);
                }
            }

            return response()->json($question->load('options')); // Return the question with options
        }
}
