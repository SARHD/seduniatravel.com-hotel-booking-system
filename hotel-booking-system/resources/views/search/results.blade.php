@extends('layouts.app')

@section('content')
<!-- Search Header -->
<div class=" text-black mt-5 pt-5 py-3">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h4 class="mb-0">{{ $destination }} - Malaysia</h4>
                <small>{{ \Carbon\Carbon::parse($check_in)->format('M j') }} - {{ \Carbon\Carbon::parse($check_out)->format('M j') }} | {{ $rooms }} Room, {{ $adults }} Adult @if($children > 0), {{ $children }} Child @endif</small>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-outline-primary btn-sm">Modify Search</button>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container-fluid py-4">
    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3">
            <div class="sticky-top" style="top: 20px;">
                <h5 class="mb-3">Filters</h5>
                
                <!-- Hotel Name Filter -->
                <div class="card mb-3">
                    <div class="card-header py-2">
                        <h6 class="mb-0">Hotel Name</h6>
                    </div>
                    <div class="card-body py-2">
                        <input type="text" class="form-control form-control-sm" placeholder="Search Hotel">
                    </div>
                </div>
                
                <!-- Board Filter -->
                <div class="card mb-3">
                    <div class="card-header py-2">
                        <h6 class="mb-0">Board</h6>
                    </div>
                    <div class="card-body py-2">
                        <div class="form-check form-check-sm">
                            <input class="form-check-input" type="checkbox" id="roomOnly">
                            <label class="form-check-label small" for="roomOnly">Room Only (12)</label>
                        </div>
                        <div class="form-check form-check-sm">
                            <input class="form-check-input" type="checkbox" id="bedBreakfast">
                            <label class="form-check-label small" for="bedBreakfast">Bed and Breakfast (8)</label>
                        </div>
                    </div>
                </div>
                
                <!-- Category Filter -->
                <div class="card mb-3">
                    <div class="card-header py-2">
                        <h6 class="mb-0">Category</h6>
                    </div>
                    <div class="card-body py-2">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-warning"></i>
                            @endfor
                            <span class="small">(3)</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            @for($i = 1; $i <= 4; $i++)
                                <i class="fas fa-star text-warning"></i>
                            @endfor
                            <i class="far fa-star text-muted"></i>
                            <span class="small">(7)</span>
                        </div>
                    </div>
                </div>
                
                <!-- Price Range -->
                <div class="card mb-3">
                    <div class="card-header py-2">
                        <h6 class="mb-0">Price (MYR)</h6>
                    </div>
                    <div class="card-body py-2">
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control form-control-sm" placeholder="Min" value="100">
                            </div>
                            <div class="col-6">
                                <input type="number" class="form-control form-control-sm" placeholder="Max" value="2500">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Hotels List -->
        <div class="col-lg-9">
            <!-- Sort Options -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <p class="mb-0 text-muted">{{ $totalHotels }} hotels found</p>
                <div class="d-flex align-items-center">
                    <label class="form-label me-2 mb-0">Sort by:</label>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>Best Match</option>
                        <option>Price (Low to High)</option>
                        <option>Price (High to Low)</option>
                        <option>Star Rating</option>
                        <option>Guest Rating</option>
                    </select>
                </div>
            </div>
            
            <!-- Hotels Grid -->
            @foreach($hotels as $hotel)
            <div class="card mb-4 shadow-sm">
                <!-- Hotel Header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ $hotel['image'] }}" class="img-fluid rounded" 
                                 alt="{{ $hotel['name'] }}" style="object-fit: cover; height: 200px; width: 100%;">
                        </div>
                        <div class="col-md-5">
                            <h5 class="card-title">{{ $hotel['name'] }}</h5>
                            <p class="text-muted small mb-2">{{ $hotel['location'] }} | <a href="#" class="text-primary">View on map</a></p>
                            
                            <!-- Amenities Icons -->
                            <div class="mb-2">
                                <i class="fas fa-parking text-muted me-2" title="Parking"></i>
                                <i class="fas fa-snowflake text-muted me-2" title="Air Conditioned"></i>
                                <i class="fas fa-utensils text-muted me-2" title="Restaurant"></i>
                                <i class="fas fa-dumbbell text-muted me-2" title="Gym"></i>
                                <i class="fas fa-wifi text-muted me-2" title="Internet"></i>
                            </div>
                            
                            <!-- Star Rating -->
                            <div class="mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($hotel['rating']))
                                        <i class="fas fa-star text-warning"></i>
                                    @elseif($i - 0.5 <= $hotel['rating'])
                                        <i class="fas fa-star-half-alt text-warning"></i>
                                    @else
                                        <i class="far fa-star text-muted"></i>
                                    @endif
                                @endfor
                                <span class="ms-2 small text-muted">({{ $hotel['reviews_count'] }} Reviews)</span>
                            </div>
                            
                            <p class="card-text small text-muted">{{ $hotel['description'] }}</p>
                        </div>
                        <div class="col-md-3 text-end">
                            <div class="mb-2">
                                <h6 class="text-muted">Deluxe Single City View</h6>
                                <h4 class="text-primary mb-0">MYR {{ number_format($hotel['price'], 2) }}</h4>
                                <small class="text-success">
                                    <i class="fas fa-check-circle"></i> Free cancellation until 11/08/2025
                                </small>
                            </div>
                            <button class="btn btn-success" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#hotel-{{ $loop->index }}" 
                                    aria-expanded="false" 
                                    aria-controls="hotel-{{ $loop->index }}"
                                    onclick="toggleHotelRooms({{ $loop->index }});">
                                Show Rooms
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Expandable Room Options -->
                <div class="collapse" id="hotel-{{ $loop->index }}">
                    <div class="border-top">
                        <!-- Room Type 1: Deluxe Single City View -->
                        <div class="p-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Deluxe Single City View for 1 adult</h6>
                                <i class="fas fa-chevron-up text-muted"></i>
                            </div>
                            
                            <!-- Booking Options for Room Type 1 -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <div>
                                            <p class="mb-1"><strong>Bed And Breakfast (BB)</strong></p>
                                            <small class="text-success">
                                                <i class="fas fa-check-circle"></i> Free cancellation until 11/08/2025
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="text-danger mb-1">MYR {{ number_format($hotel['price'], 2) }}</h5>
                                            <small class="text-muted">Price details</small>
                                            <br>
                                            <button class="btn btn-primary btn-sm mt-1">
                                                <i class="fas fa-shopping-cart"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <div>
                                            <p class="mb-1"><strong>Room Only (RO)</strong></p>
                                            <small class="text-success">
                                                <i class="fas fa-check-circle"></i> Free cancellation until 11/08/2025
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="text-danger mb-1">MYR {{ number_format($hotel['price'] * 0.9, 2) }}</h5>
                                            <small class="text-muted">Price details</small>
                                            <br>
                                            <button class="btn btn-primary btn-sm mt-1">
                                                <i class="fas fa-shopping-cart"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Room Type 2: Deluxe Double City View -->
                        <div class="p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0">Deluxe Double City View for 1 adult</h6>
                                <i class="fas fa-chevron-up text-muted"></i>
                            </div>
                            
                            <!-- Booking Options for Room Type 2 -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <div>
                                            <p class="mb-1"><strong>Bed And Breakfast (BB)</strong></p>
                                            <small class="text-success">
                                                <i class="fas fa-check-circle"></i> Free cancellation until 11/08/2025
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="text-danger mb-1">MYR {{ number_format($hotel['price'] * 1.1, 2) }}</h5>
                                            <small class="text-muted">Price details</small>
                                            <br>
                                            <button class="btn btn-primary btn-sm mt-1">
                                                <i class="fas fa-shopping-cart"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <div>
                                            <p class="mb-1"><strong>Room Only (RO)</strong></p>
                                            <small class="text-success">
                                                <i class="fas fa-check-circle"></i> Free cancellation until 11/08/2025
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="text-danger mb-1">MYR {{ number_format($hotel['price'] * 1.0, 2) }}</h5>
                                            <small class="text-muted">Price details</small>
                                            <br>
                                            <button class="btn btn-primary btn-sm mt-1">
                                                <i class="fas fa-shopping-cart"></i> Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
function toggleHotelRooms(index) {
    const button = event.target;
    const isExpanded = button.getAttribute('aria-expanded') === 'true';
    
    if (isExpanded) {
        button.textContent = 'Show Rooms';
    } else {
        button.textContent = 'Hide Rooms';
    }
}
</script>
@endsection
