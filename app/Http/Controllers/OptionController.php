<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function destroy($id)
    {
        $option = Option::findOrFail($id);
        $option->delete();

        return redirect()->back()->with('success', 'Option deleted successfully.');
    }


    public function update(Request $request, $id)
{
    $option = Option::findOrFail($id);
    $option->update(['option_text' => $request->option_text]);

    return response()->json(['message' => 'Option updated successfully.']);
}

    public function store(Request $request, $questionId)
{
    foreach ($request->options as $optionText) {
        Option::create([
            'pertanyaan_id' => $questionId,
            'option_text' => $optionText,
        ]);
    }

    return redirect()->route('options.create', $questionId)->with('success', 'Options added successfully.');
}



}