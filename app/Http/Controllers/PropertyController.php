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
        $categories = PropertyCategories::latest()->paginate(6);;
        return view('layouts.addProperty', compact('categories'));
    }

    // Store property
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'category_id' => 'required|exists:propertycategories,id',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'photos' => 'required|image|max:10240'
        ]);

        // Store the uploaded file
        $path = $request->file('photos')->store('properties', 'public');

        Properties::create([
            'UserID' => Auth::id(),
            'Title' => $request->title,
            'Location' => $request->location,
            'CategoryID' => $request->category_id,
            'Price' => $request->price,
            'Description' => $request->description,
            'Photos' => basename($path),   
            'IsAvailable' => 1,
        ]);

        return redirect()->route('myProperties')->with('success', 'Property added successfully!');
    }

    // My properties
    public function myProperties()
    {
        if (auth()->user()->role == 'admin') {
            $properties = Properties::with('propertycategory')->latest()->get();
        } 

        else {
            $properties = Properties::with('propertycategory')
                ->where('UserID', auth()->id())
                ->latest()
                ->get();
        }

        return view('layouts.myProperties', compact('properties'));
    }

    // Favorites Page
    public function favorites()
    {
        $favorites = auth()->user()
            ->favorites()        
            ->with('propertycategory')
            ->get();

        return view('layouts.favorites', compact('favorites'));
    }

    // Favorites Toggle Page
    public function toggleFavorite($id)
    {
        $property = Properties::findOrFail($id);
        $user = auth()->user();

        // Check if already favorited
        if ($user->favorites()->where('PropertyID', $id)->exists()) {
            $user->favorites()->detach($id);
            return back()->with('message', 'Removed from favorites');
        }

        // Add to favorites
        $user->favorites()->attach($id);
        return back()->with('message', 'Added to favorites');
    }

    // Edit property (DUMMY)
    // public function edit($id)
    // {
    //     $properties = Properties::with('user', 'propertycategory')->findOrFail($id);
    //     return view('layouts.propertyDetail', compact('properties'));
    // }

    public function edit($id)
    {
        $property = Properties::findOrFail($id);
        $categories = PropertyCategories::all();

        // only admin OR property owner can edit
        if (Auth::user()->role !== 'admin' && $property->UserID !== Auth::id()) {
            return redirect('/')->with('error', 'You do not have permission to edit this property.');
        }

        return view('layouts.editproperty', compact('property', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $property = Properties::findOrFail($id);

        // only admin OR owner can update
        if (Auth::user()->role !== 'admin' && $property->UserID !== Auth::id()) {
            return redirect('/')->with('error', 'You do not have permission to update this property.');
        }

        // validation
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'category_id' => 'required|exists:propertycategories,id',
            'price' => 'required|numeric|min:1',
            'description' => 'required',
            'photos' => 'nullable|image|max:10240'
        ]);

        // update data
        $property->Title = $request->title;
        $property->Location = $request->location;
        $property->CategoryID = $request->category_id;
        $property->Price = $request->price;
        $property->Description = $request->description;

        if ($request->hasFile('photos')) {
            $path = $request->file('photos')->store('properties', 'public');
            $property->Photos = $path;
        }

        $property->save();

        return redirect()->route('myProperties')
            ->with('success', 'Property updated successfully.');
    }
    
}
