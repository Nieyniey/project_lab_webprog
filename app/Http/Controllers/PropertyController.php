<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\PropertyCategories;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    // Home page
    public function home()
    {
        $properties = Properties::latest()->paginate(8);
        return view('layouts.home', compact('properties'));
    }

    // Search property
    public function search(Request $request)
    {
        $query = $request->input('q');

        $properties = Properties::where('title', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->paginate(8);

        return view('layouts.searchProperty', compact('properties', 'query'));
    }

    // Property detail
    public function show($id)
    {
        $properties = Properties::with('user', 'propertycategory')->findOrFail($id);
        return view('layouts.propertyDetail', compact('properties'));
    }

    // Add property page
    public function showAdd()
    {
        $categories = PropertyCategories::all();
        return view('layouts.addProperty', compact('categories'));
    }

    // Store property
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'category_id' => 'required|exists:property_categories,id',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'photo' => 'required|image|max:10240'
        ]);

        $path = $request->file('photo')->store('properties', 'public');

        Properties::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'location' => $request->location,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'photos' => $path,
            'isAvailable' => true,
        ]);

        return redirect()->route('myProperties')->with('success', 'Property added successfully!');
    }

    // My properties
    public function myProperties()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $properties = Properties::paginate(8);
        } else {
            $properties = Properties::where('user_id', $user->id)->paginate(8);
        }

        return view('layouts.myProperties', compact('properties'));
    }
}
