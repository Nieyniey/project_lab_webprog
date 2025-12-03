@extends('layouts.app')

@section('content')
<div class="container mt-5 p-4 shadow rounded bg-white" style="max-width: 700px; margin-bottom: 80px;">

    <h3 class="mb-4">Add New Property</h3>

    {{-- Global error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error:</strong> {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Title --}}
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control shadow-sm" value="{{ old('title') }}">
        @error('title') <small class="text-danger d-block">{{ $message }}</small> @enderror

        {{-- Location --}}
        <label class="form-label mt-3">Location</label>
        <input type="text" name="location" class="form-control shadow-sm" value="{{ old('location') }}">
        @error('location') <small class="text-danger d-block">{{ $message }}</small> @enderror

        {{-- Category --}}
        <label class="form-label mt-3">Category</label>
        <select name="category_id" class="form-control shadow-sm">
            <option value="">-- Choose Category --</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->PropertyCategoryName }}</option>
            @endforeach
        </select>
        @error('category_id') <small class="text-danger d-block">{{ $message }}</small> @enderror

        {{-- Price --}}
        <label class="form-label mt-3">Price (per night)</label>
        <input type="number" name="price" class="form-control shadow-sm" value="{{ old('price') }}">
        @error('price') <small class="text-danger d-block">{{ $message }}</small> @enderror

        {{-- Description --}}
        <label class="form-label mt-3">Description</label>
        <textarea name="description" rows="3" class="form-control shadow-sm">{{ old('description') }}</textarea>
        @error('description') <small class="text-danger d-block">{{ $message }}</small> @enderror

        {{-- Photo --}}
        <label class="form-label mt-3">Photo</label>
        <input type="file" name="photos" class="form-control shadow-sm">
        @error('photos') <small class="text-danger d-block">{{ $message }}</small> @enderror

        <button type="submit" class="btn btn-danger w-100 mt-4 shadow-sm">Add Property</button>
    </form>
</div>
@endsection
