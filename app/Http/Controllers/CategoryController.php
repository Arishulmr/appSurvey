<?php

namespace App\Http\Controllers;

use App\Models\KategoriSurvey;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
{
    // Get the search query from the request
    $search = $request->get('search');

    // Fetch data from the kategori_survey table, optionally applying a search filter
    $categories = KategoriSurvey::when($search, function ($query) use ($search) {
        return $query->where('nama_kategori', 'like', '%' . $search . '%');
    })->get(); // You may also use paginate(10) if you prefer pagination

    // Pass the data to the view
    return view('categories.index', compact('categories'));
}

public function create()
{
    return view('categories.create');
}

public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ]);

    // Create a new category
    KategoriSurvey::create($request->only('nama_kategori', 'deskripsi'));

    // Redirect back to the categories index with a success message
    return redirect()->route('categories.index')->with('success', 'Category added successfully.');
}

public function edit($id)
{
    $category = KategoriSurvey::findOrFail($id);
    return view('categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'nama_kategori' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ]);

    // Find the category and update it
    $category = KategoriSurvey::findOrFail($id);
    $category->update($request->only('nama_kategori', 'deskripsi'));

    // Redirect back to the categories index with a success message
    return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
}
public function destroy($id)
{
    $category = KategoriSurvey::findOrFail($id);
    $category->delete();

    return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
}

}