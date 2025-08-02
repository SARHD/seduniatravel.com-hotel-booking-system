@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Hotels in {{ $destination }}</li>
                </ol>
            </nav>
            
            <h1 class="mb-4">Hotels in {{ $destination }}</h1>
            <p class="text-muted mb-5">{{ count($hotels) }} hotels found</p>
        </div>
    </div>
    
    @if(count($hotels) > 0)
        <div class="row g-4">
            @foreach($hotels as $hotel)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $hotel['image'] }}" class="card-img-top" alt="{{ $hotel['name'] }}" 
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hotel['name'] }}</h5>
                            
                            <!-- Star Rating -->
                            <div class="mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $hotel['rating'])
                                        <i class="fas fa-star text-warning"></i>
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                @endfor
                                <span class="ms-1 text-muted">({{ $hotel['rating'] }} stars)</span>
                            </div>
                            
                            <!-- Amenities -->
                            <div class="mb-3">
                                @foreach($hotel['amenities'] as $amenity)
                                    <span class="badge bg-light text-dark me-1 mb-1"><i class="fas fa-check-circle text-success me-1"></i>{{ $amenity }}</span>
                                @endforeach
                            </div>
                            
                            <!-- Price -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="text-primary mb-0">${{ $hotel['price'] }}</h4>
                                    <small class="text-muted">per night</small>
                                </div>
                                <button class="btn btn-primary">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="row">
            <div class="col-12 text-center py-5">
                <i class="fas fa-hotel fa-4x text-muted mb-3"></i>
                <h3 class="text-muted">No hotels found</h3>
                <p class="text-muted">Sorry, we couldn't find any hotels in {{ $destination }}.</p>
                <a href="/" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    @endif
</div>
@endsection
