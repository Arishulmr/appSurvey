<?php

namespace App\Http\Controllers;

use App\Mail\QuestionnaireLinkMail;
use App\Models\KategoriSurvey;
use App\Models\Orang;
use App\Models\Pertanyaan;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuestionnaireController extends Controller
{

    public function create()
    {
        $categories = KategoriSurvey::all();
        $questionnaire = Questionnaire::all();
        return view('questionnaires.create',compact('categories'));
    }


    public function preview($id)
{
    $questionnaire = Questionnaire::with('pertanyaan')->findOrFail($id); // Load questionnaire with questions (pertanyaan)

    return view('questionnaires.preview', compact('questionnaire'));
}


    public function show($id)
    {
        // Ensure the 'pertanyaan' relationship is loaded
        $questionnaire = Questionnaire::with('pertanyaan')->findOrFail($id);
        $people = Orang::all(); // Assuming Orang is the model for people

        return view('questionnaires.preview', compact('questionnaire', 'people'));
    }

public function generateLink(Request $request, $id)
{
    $questionnaire = Questionnaire::findOrFail($id);
    $link = route('questionnaires.show', $questionnaire->id); // Generate a link to view the questionnaire

    if ($request->has('method')) {
        $selectedPeople = Orang::whereIn('id', $request->people)->get();

        foreach ($selectedPeople as $person) {
            if ($request->method == 'email') {
                // Send link via email
                Mail::to($person->email)->send(new QuestionnaireLinkMail($link));
            } else if ($request->method == 'phone') {
                // Send link via SMS (mocked)
                // SMS::send($person->phone, "Questionnaire link: " . $link);
            }
        }
    }

    return response()->json(['link' => $link]);
}



    public function edit($id)
    {
        $questionnaire = Questionnaire::findOrFail($id);
        $categories = KategoriSurvey::all(); // Fetch categories if needed
        return view('questionnaires.edit', compact('questionnaire', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'kategori_id' => 'required|exists:kategori_survey,id',
        ]);

        $questionnaire = Questionnaire::findOrFail($id);
        $questionnaire->update($request->all());

        return redirect()->route('questionnaire.index')->with('success', 'Questionnaire updated successfully');
    }

public function showAddFieldPage($id)
{
    $questionnaire = Questionnaire::with('pertanyaan')->findOrFail($id);
    return view('questions.create', compact('questionnaire'));
}

public function index()
{
    $questionnaires = Questionnaire::with('kategori')->get();
    $people = Orang::all(); // Fetch all people

    return view('questionnaires.index', compact('questionnaires', 'people'));
}





    public function store(Request $request)
    {
        Questionnaire::create([
            'nama' => $request->name,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('questionnaires.index')->with('success', 'Questionnaire added successfully.');
    }


    public function storePertanyaan(Request $request, $questionnaireId)
{
    $request->validate([
        'pertanyaan' => 'required|string|max:255',
        'tipe_pertanyaan' => 'required|in:pilihan ganda,teks,nilai'
    ]);

    Pertanyaan::create([
        'questionnaire_id' => $questionnaireId,
        'pertanyaan' => $request->pertanyaan,
        'tipe_pertanyaan' => $request->tipe_pertanyaan,
    ]);

    return redirect()->route('questionnaires.index')->with('success', 'Question added successfully.');
}

}
