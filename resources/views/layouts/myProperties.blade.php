@extends('layouts.app')

@section('content')
<style>
  .property-card {
      border-radius: 12px;
  }

  .property-img {
      height: 200px;
      object-fit: cover;
      border-top-left-radius: 12px;
      border-top-right-radius: 12px;
  }
</style>

<div class="container my-5">

    <h2 class="fw-bold mb-4">List of Properties</h2>

    <div class="row g-4">

        @forelse ($properties as $p)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 property-card">
                    
                    {{-- Property Image --}}
                    <img 
                        src="{{ asset('properties/' . $p->Photos) }}" 
                        class="card-img-top property-img"
                        alt="property image">

                    <div class="card-body">

                        {{-- Name + Location --}}
                        <h5 class="fw-bold mb-1">{{ $p->Title }}</h5>
                        <p class="text-muted mb-1">{{ $p->Location }}</p>

                        {{-- Price --}}
                        <p class="text-danger fw-bold mb-1">
                            Rp {{ number_format($p->Price, 0, ',', '.') }}
                        </p>

                        {{-- Category --}}
                        <p class="small text-muted mb-3">
                            Category: {{ $p->propertycategory->PropertyCategoryName ?? 'N/A' }}
                        </p>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between align-items-center">
                            
                            <a href="{{ route('property.detail', $p->id) }}" 
                               class="text-primary fw-semibold"
                               style="text-decoration: none !important; color: inherit !important;">
                                View Detail →
                            </a>

                            <div>
                                <a href="{{ route('property.edit', $p->id) }}" 
                                   class="text-secondary me-3"
                                   style="text-decoration: none !important; color: inherit !important;">Edit</a>

                                <form action="{{ route('property.edit', $p->id) }}"
                                      method="POST" 
                                      style="display:inline; text-decoration: none !important; color: inherit !important;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-danger border-0 bg-transparent p-0"
                                            onclick="return confirm('Delete this property?')">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @empty
            
            <p class="text-muted">You have no properties added yet.</p>

        @endforelse

    </div>

</div>
@endsection
