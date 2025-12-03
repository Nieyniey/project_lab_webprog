<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\PropertyCategories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    // home page
    public function home()
    {
        $properties = Properties::latest()->paginate(8);
        return view('layouts.home', compact('properties'));
    }

    // search property page
    public function search(Request $request)
    {
        $query = $request->input('q');  

        // Search by title or location
        $properties = Properties::where('title', 'like', "%$query%")
            ->orWhere('location', 'like', "%$query%")
            ->paginate(8);

        return view('layouts.searchProperty', compact('properties', 'query'));
    }

    // property detail page
    public function show($id)
    {
        $properties = Properties::with('user', 'propertycategory')->findOrFail($id);

        return view('layouts.propertyDetail', compact('properties'));
    }

    // add property page
    public function showAdd()
    {
        $categories = Category::all();
        return view('layouts.addProperty', compact('categories'));
    }

    // add property to database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'photos' => 'required|image|max:10240' 
        ]);

        $path = $request->file('photo')->store('properties', 'public');

        Property::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'location' => $request->location,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'description' => $request->description,
            'photos' => $path,
            'isAvailable' => true,
        ]);

        return redirect()->route('layouts.myProperties')
            ->with('success', 'Property added successfully!');
    }

    // my property page
    public function myProperties()
    {
      $user = Auth::user();

      if ($user->role === 'admin') {
          // Admin sees ALL properties
          $properties = Property::paginate(8);
      } else {
          // Member sees only their own
          $properties = Property::where('user_id', $user->id)->paginate(8);
      }

      return view('layouts.myProperties', compact('properties'));
    }
}
