@extends('layouts.app')

@section('content')

<style>
    .property-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 30px;
        padding: 30px 60px;
    }

    .property-card {
        border-radius: 18px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 14px rgba(0,0,0,0.08);
        transition: 0.2s;
        text-decoration: none !important;
        color: inherit !important;
    }

    .property-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    .property-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .property-info {
        padding: 15px;
    }

    .property-info h3 {
        font-size: 18px;
        margin: 0;
        font-weight: 600;
    }

    .property-info p {
        margin: 4px 0;
        color: #555;
    }

    .property-price {
        color: #ff4d8d;
        font-weight: 600;
        font-size: 16px;
    }

    .per-night {
        color: #555;
        font-weight: 400;
    }
</style>

<div class="property-grid">
    @foreach ($properties as $p)
        <div class="property-card">
            <a href="{{ route('property.detail', $p->id) }}" class="property-card">

                <img src="{{ asset('properties/' . $p->Photos) }}" 
                    alt="{{ $p->Title }}" 
                    class="property-image">

                <div class="property-info">
                    <h3>{{ $p->Title }}</h3>
                    <p>{{ $p->Location }}</p>
                    <div class="property-price">Rp {{ number_format($p->Price, 0, ',', '.') }}
                        <span class="per-night"> / night</span></div>
                </div>
            </a>
        </div>
        @endforeach
</div>

@endsection