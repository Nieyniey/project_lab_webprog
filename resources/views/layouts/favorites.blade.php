@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <h3 class="mb-4">My Favorite Properties</h3>

    <div class="row">
        @forelse ($favorites as $property)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm rounded">
                    <div class="position-relative">
                        <img src="{{ asset('/properties/' . $property->Photos) }}" class="card-img-top rounded" alt="{{ $property->Title }}">
                        <form action="{{ route('favorite.toggle', $property->id) }}" 
                            method="POST"
                            class="position-absolute top-0 end-0 m-2">
                            @csrf
                            <button type="submit" class="btn btn-light p-1 rounded-circle" 
                                    style="width: 30px; height: 30px;">
                                <i class="fa fa-heart text-danger"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <h6 class="fw-bold mb-1">{{ $property->Title }}</h6>
                        <p class="text-muted mb-1">{{ $property->Location }}</p>
                        <p class="text-danger fw-bold mb-1">Rp {{ number_format($property->Price, 0, ',', '.') }}</p>
                        <a href="{{ route('property.detail', $property->id) }}" 
                           class="fw-semibold"
                           style="color: #ff4d8d; text-decoration: none;">
                            View Detail →
                        </a>
                    </div>
                </div>
            </div>
         @empty
            <p class="text-muted">You haven't favorited any properties yet.</p>
        @endforelse
    </div>

</div>
@endsection
