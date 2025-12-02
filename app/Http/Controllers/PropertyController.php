<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    // home page
    public function home()
    {
      // guest
      $properties = Property::latest()->paginate(8);
      if (!auth()->check()) {
          return view('home_guest', compact('properties'));
      }

      // member/admin
      return view('home_user', compact('properties'));
    }


    // serach property page
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $properties = Property::where('name', 'like', "%$keyword%")
            ->orWhere('location', 'like', "%$keyword%")
            ->paginate(8);

        // guest
        if (!auth()->check()) {
            return view('search_guest', compact('properties', 'keyword'));
        }

        // members/admin
        return view('search_user', compact('properties', 'keyword'));
    }

    // property detail page
    public function detail($id)
    {
        $property = Property::with(['category', 'reviews.user'])->findOrFail($id);
        return view('layouts.propertyDetail', compact('property'));
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
