<?php

namespace App\Http\Controllers;

use App\Models\Orang; // Ensure you are importing the model
use Illuminate\Http\Request;

class OrangController extends Controller
{
    public function index(Request $request)
{
    // Get the search query from the request
    $search = $request->get('search');

    // Fetch data from the orang table, optionally applying a search filter
    $people = Orang::when($search, function ($query) use ($search) {
        return $query->where('nama', 'like', '%' . $search . '%')
                     ->orWhere('email', 'like', '%' . $search . '%');
    })->get(); // Use paginate(10) if you want pagination

    // Pass the data to the view
    return view('people.index', compact('people'));
}

    public function create()
{
    return view('people.create'); // Create a new view file 'create.blade.php'
}

public function store(Request $request)
{
    // Validate the input
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:orang,email',
        'nomor_telepon' => 'required|string|max:15',
    ]);

    // Create a new person in the database
    Orang::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'nomor_telepon' => $request->nomor_telepon,
    ]);

    // Redirect back to the people list with a success message
    return redirect()->route('people.index')->with('success', 'Person added successfully!');
}
public function edit($id)
{
    $person = Orang::findOrFail($id); // Find the person by ID or return 404
    return view('people.edit', compact('person'));
}

public function update(Request $request, $id)
{
    // Validate input
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|unique:orang,email,'.$id, // Unique except for this ID
        'nomor_telepon' => 'required|string|max:15',
    ]);

    // Update the person in the database
    $person = Orang::findOrFail($id);
    $person->update([
        'nama' => $request->nama,
        'email' => $request->email,
        'nomor_telepon' => $request->nomor_telepon,
    ]);

    return redirect()->route('people.index')->with('success', 'Person updated successfully!');
}

public function destroy($id)
{
    $person = Orang::findOrFail($id);
    $person->delete();

    return redirect()->route('people.index')->with('success', 'Person deleted successfully!');
}
}