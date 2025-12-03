@extends('layouts.app')

@section('content')
<div class="container mt-5 p-4 shadow rounded bg-white" style="max-width: 700px; margin-bottom: 80px;">

    <h3 class="mb-4">Edit Property</h3>

    {{-- Show validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error:</strong> {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Title --}}
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control shadow-sm"
               value="{{ old('title', $property->title) }}">
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Location --}}
        <label class="form-label mt-3">Location</label>
        <input type="text" name="location" class="form-control shadow-sm"
               value="{{ old('location', $property->location) }}">
        @error('location') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Category --}}
        <label class="form-label mt-3">Category</label>
        <select name="category_id" class="form-control shadow-sm">
            <option value="">-- Choose Category --</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ $property->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->PropertyCategoryName }}
                </option>
            @endforeach
        </select>
        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Price --}}
        <label class="form-label mt-3">Price (per night)</label>
        <input type="number" name="price" class="form-control shadow-sm"
               value="{{ old('price', $property->price) }}">
        @error('price') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Description --}}
        <label class="form-label mt-3">Description</label>
        <textarea name="description" rows="4" class="form-control shadow-sm">{{ old('description', $property->description) }}</textarea>
        @error('description') <small class="text-danger">{{ $message }}</small> @enderror

        {{-- Upload Photo --}}
        <label class="form-label mt-3">Add New Photos (JPG/PNG, max 10MB)</label>
        <input type="file" name="photos" class="form-control shadow-sm">
        @error('photos') <small class="text-danger">{{ $message }}</small> @enderror

        <button type="submit" class="btn btn-danger w-100 mt-4 shadow-sm" style="background:#ff4d8d;">
            Update Property
        </button>
    </form>

</div>
@endsection
