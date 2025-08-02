@extends('layouts.app')

@section('content')
<style>
    body {
        font-family: 'Inter', sans-serif;
    }
    .hero-section {
        background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
        background-size: cover;
        background-position: center;
        min-height: 50vh;
        color: white;
    }
    .search-form-container {
        background-color: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-top: -80px;
        position: relative;
        z-index: 10;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #ced4da;
    }
    .destination-card {
        transition: all 0.3s ease-in-out;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        position: relative;
    }
    .destination-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    .destination-card .card-body {
        background: linear-gradient(rgba(0,0,0,0.1), rgba(0,0,0,0.7));
        color: white;
    }
    .destination-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        color: white;
        padding: 20px;
    }
    .destinations-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(3, 250px);
        gap: 15px;
        max-width: 900px;
        margin: 0 auto;
    }
    .dest-large {
        grid-column: span 2;
        grid-row: span 1;
    }
    .dest-medium {
        grid-column: span 1;
        grid-row: span 1;
    }
    
    /* Custom Date Picker Styling */
    .flatpickr-calendar {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        font-family: 'Inter', sans-serif;
    }
    
    .flatpickr-month {
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        border-radius: 12px 12px 0 0;
        padding: 15px 0;
    }
    
    .flatpickr-current-month .flatpickr-monthDropdown-months {
        background: transparent;
        border: none;
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
    }
    
    .numInputWrapper {
        font-size: 16px;
        font-weight: 600;
        color: #1f2937;
    }
    
    .flatpickr-weekdays {
        background: #f8fafc;
        border-bottom: 1px solid #e5e7eb;
        padding: 10px 0;
    }
    
    .flatpickr-weekday {
        font-size: 13px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
    }
    
    .flatpickr-days {
        padding: 10px;
    }
    
    .flatpickr-day {
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #374151;
        margin: 2px;
        transition: all 0.2s ease;
    }
    
    .flatpickr-day:hover {
        background: #f3f4f6;
        color: #1f2937;
    }
    
    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
        background: #3b82f6 !important;
        border-color: #3b82f6 !important;
        color: white !important;
        font-weight: 600;
    }
    
    .flatpickr-day.inRange {
        background: #dbeafe !important;
        border-color: #dbeafe !important;
        color: #1d4ed8 !important;
    }
    
    .flatpickr-day.today {
        background: #f59e0b;
        border-color: #f59e0b;
        color: white;
        font-weight: 600;
    }
    
    .flatpickr-day.prevMonthDay,
    .flatpickr-day.nextMonthDay {
        color: #d1d5db;
    }
    
    .flatpickr-prev-month,
    .flatpickr-next-month {
        color: #6b7280;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.2s ease;
    }
    
    .flatpickr-prev-month:hover,
    .flatpickr-next-month:hover {
        background: #f3f4f6;
        color: #1f2937;
    }
    
    .date-input-container {
        position: relative;
    }
    
    .date-input-container .fas {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        pointer-events: none;
    }
    
    /* Travelers Selector Styling */
    .travelers-dropdown {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    
    .travelers-input {
        cursor: pointer;
        position: relative;
    }
    
    .travelers-input .fas {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6b7280;
        pointer-events: none;
    }
    
    .travelers-menu {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        padding: 20px;
        margin-top: 5px;
        display: none;
        font-family: 'Inter', sans-serif;
    }
    
    .travelers-menu.show {
        display: block;
    }
    
    .traveler-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .traveler-row:last-of-type {
        margin-bottom: 25px;
    }
    
    .traveler-label {
        font-size: 16px;
        font-weight: 500;
        color: #374151;
    }
    
    .traveler-counter {
        display: flex;
        align-items: center;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .counter-btn {
        background: #f8f9fa;
        border: none;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #6b7280;
        font-size: 16px;
        transition: all 0.2s ease;
    }
    
    .counter-btn:hover {
        background: #e9ecef;
        color: #374151;
    }
    
    .counter-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .counter-value {
        width: 60px;
        height: 40px;
        border: none;
        text-align: center;
        font-size: 16px;
        font-weight: 500;
        color: #374151;
        background: white;
    }
    
    .travelers-done-btn {
        width: 100%;
        background: #3b82f6;
        color: white;
        border: none;
        padding: 12px 0;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    
    .travelers-done-btn:hover {
        background: #2563eb;
    }
</style>

<!-- Hero Section -->
<div class="hero-section d-flex align-items-center justify-content-center text-center">
    <h1 class="display-4 fw-bold">Gateway To Exceptional Stays</h1>
</div>

<!-- Search Form -->
<div class="container pt-5">
    <div class="search-form-container py-3  px-5 rounded-5">
        <form action="/search" method="post" id="searchForm">
            @csrf
            <!-- Hidden inputs for processed data -->
            <input type="hidden" name="check_in" id="checkInDate">
            <input type="hidden" name="check_out" id="checkOutDate">
            <input type="hidden" name="rooms" id="roomsValue" value="1">
            <input type="hidden" name="adults" id="adultsValue" value="1">
            <input type="hidden" name="children" id="childrenValue" value="0">
            
            <div class="row g-3 align-items-center">
                <div class="col-md-4">
                    <label class="form-label fw-bold text-dark">Destination</label>
                    <input type="text" name="destination" class="form-control border-0 p-0" placeholder="E.g., Barcelona" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold text-dark">From - to</label>
                    <div class="date-input-container">
                        <input type="text" id="dateRangePicker" name="date_range" class="form-control border-0 p-0 pe-4" placeholder="Select Dates" readonly required>
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold text-dark">Travellers</label>
                    <div class="travelers-dropdown">
                        <div class="travelers-input form-control border-0 p-0" id="travelersInput">
                            1 Room, 1 Adult, 0 Child <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="travelers-menu" id="travelersMenu">
                            <div class="traveler-row">
                                <div class="traveler-label">Rooms</div>
                                <div class="traveler-counter">
                                    <button type="button" class="counter-btn" data-type="rooms" data-action="decrease">-</button>
                                    <input type="text" class="counter-value" id="roomsCount" value="1" readonly>
                                    <button type="button" class="counter-btn" data-type="rooms" data-action="increase">+</button>
                                </div>
                            </div>
                            <div class="traveler-row">
                                <div class="traveler-label">Adults</div>
                                <div class="traveler-counter">
                                    <button type="button" class="counter-btn" data-type="adults" data-action="decrease">-</button>
                                    <input type="text" class="counter-value" id="adultsCount" value="1" readonly>
                                    <button type="button" class="counter-btn" data-type="adults" data-action="increase">+</button>
                                </div>
                            </div>
                            <div class="traveler-row">
                                <div class="traveler-label">Children</div>
                                <div class="traveler-counter">
                                    <button type="button" class="counter-btn" data-type="children" data-action="decrease">-</button>
                                    <input type="text" class="counter-value" id="childrenCount" value="0" readonly>
                                    <button type="button" class="counter-btn" data-type="children" data-action="increase">+</button>
                                </div>
                            </div>
                            <button type="button" class="travelers-done-btn" id="travelersDone">Done</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary rounded-circle justify-content-center" style="background-color: #007bff; border-color: #007bff;"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Trending Destinations -->
<div class="container my-5">
    <h2 class="text-center mb-4">Trending Destinations</h2>
    <div class="row g-4">
        @php
        $destinations = [
            ['name' => 'Kuala Lumpur', 'country' => 'Malaysia', 'img' => 'https://images.unsplash.com/photo-1596422846543-75c6fc197f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'],
            ['name' => 'Bangkok', 'country' => 'Thailand', 'img' => 'https://images.unsplash.com/photo-1552465011-b4e21bf6e79a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'],
            ['name' => 'Bali', 'country' => 'Indonesia', 'img' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'],
            ['name' => 'London', 'country' => 'United Kingdom', 'img' => 'https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'],
            ['name' => 'Istanbul', 'country' => 'Turkey', 'img' => 'https://images.unsplash.com/photo-1541432901042-2d8bd64b4a9b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'],
            ['name' => 'Rome', 'country' => 'Italy', 'img' => 'https://images.unsplash.com/photo-1515542622106-78bda8ba0e5b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'],
            ['name' => 'Goa', 'country' => 'India', 'img' => 'https://images.unsplash.com/photo-1593693411514-2a62a6e3441d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'],
            ['name' => 'Dubai', 'country' => 'United Arab Emirates', 'img' => 'https://images.unsplash.com/photo-1512453979791-3c2b8b9b4f2c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'],
            ['name' => 'Barcelona', 'country' => 'Spain', 'img' => 'https://images.unsplash.com/photo-1547499039-2a9a7a1f5a54?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80'],
            ['name' => 'Paris', 'country' => 'France', 'img' => 'https://images.unsplash.com/photo-1499856871958-5b9627545d1a?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80']
        ];
        @endphp

        <!-- @foreach($destinations as $dest)
        <div class="col-md-6 col-lg-3 mb-4">
            <a href="/hotels/{{ str_replace(' ', '-', strtolower($dest['name'])) }}" class="text-decoration-none">
                <div class="card destination-card text-white h-100">
                    <img src="{{ $dest['img'] }}" class="card-img h-100" alt="{{ $dest['name'] }}" style="object-fit: cover;">
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                        <h5 class="card-title fw-bold">{{ $dest['name'] }}</h5>
                        <p class="card-text">{{ $dest['country'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach -->

<!-- 
        <div class="row"> -->
    <!-- First row: 8-4 -->
    <div class="col-md-8 mb-4">
        <a href="/hotels/kuala-lumpur" class="text-decoration-none">
            <div class="card destination-card text-white h-100">
                <img src="{{ asset('images/destinations/kuala-lumpur.jpg') }}" class="card-img h-100" alt="Kuala Lumpur" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                    <h5 class="card-title fw-bold">Kuala Lumpur</h5>
                    <p class="card-text">Malaysia</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="/hotels/bangkok" class="text-decoration-none">
            <div class="card destination-card text-white h-100">
                <img src="{{ asset('images/destinations/bangkok.jpg') }}" class="card-img h-100" alt="Bangkok" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                    <h5 class="card-title fw-bold">Bangkok</h5>
                    <p class="card-text">Thailand</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Second row: 4-4 -->
    <div class="col-md-4 mb-4">
        <a href="/hotels/bali" class="text-decoration-none">
            <div class="card destination-card text-white h-100">
                <img src="{{ asset('images/destinations/bali.jpg') }}" class="card-img h-100" alt="Bali" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                    <h5 class="card-title fw-bold">Bali</h5>
                    <p class="card-text">Indonesia</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="/hotels/london" class="text-decoration-none">
            <div class="card destination-card text-white h-100">
                <img src="{{ asset('images/destinations/london.jpg') }}" class="card-img h-100" alt="London" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                    <h5 class="card-title fw-bold">London</h5>
                    <p class="card-text">United Kingdom</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="/hotels/london" class="text-decoration-none">
            <div class="card destination-card text-white h-100">
                <img src="{{ asset('images/destinations/london.jpg') }}" class="card-img h-100" alt="London" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                    <h5 class="card-title fw-bold">London</h5>
                    <p class="card-text">United Kingdom</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Third row: 8-4 -->
    <div class="col-md-8 mb-4">
        <a href="/hotels/istanbul" class="text-decoration-none">
            <div class="card destination-card text-white h-100">
                <img src="{{ asset('images/destinations/istanbul.jpg') }}" class="card-img h-100" alt="Istanbul" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                    <h5 class="card-title fw-bold">Istanbul</h5>
                    <p class="card-text">Turkey</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="/hotels/rome" class="text-decoration-none">
            <div class="card destination-card text-white h-100">
                <img src="{{ asset('images/destinations/rome.jpg') }}" class="card-img h-100" alt="Rome" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                    <h5 class="card-title fw-bold">Rome</h5>
                    <p class="card-text">Italy</p>
                </div>
            </div>
        </a>
    </div>

    <!-- Fourth row: 4-4 -->
    <div class="col-md-4 mb-4">
        <a href="/hotels/goa" class="text-decoration-none">
            <div class="card destination-card text-white h-100">
                <img src="{{ asset('images/destinations/goa.jpg') }}" class="card-img h-100" alt="Goa" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                    <h5 class="card-title fw-bold">Goa</h5>
                    <p class="card-text">India</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="/hotels/dubai" class="text-decoration-none">
            <div class="card destination-card text-white h-100">
                <img src="{{ asset('images/destinations/dubai.jpg') }}" class="card-img h-100" alt="Dubai" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                    <h5 class="card-title fw-bold">Dubai</h5>
                    <p class="card-text">United Arab Emirates</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-4 mb-4">
        <a href="/hotels/london" class="text-decoration-none">
            <div class="card destination-card text-white h-100">
                <img src="{{ asset('images/destinations/london.jpg') }}" class="card-img h-100" alt="London" style="object-fit: cover;">
                <div class="card-img-overlay d-flex flex-column justify-content-end p-3">
                    <h5 class="card-title fw-bold">London</h5>
                    <p class="card-text">United Kingdom</p>
                </div>
            </div>
        </a>
    </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#dateRangePicker", {
            mode: "range",
            dateFormat: "M j, Y",
            minDate: "today",
            showMonths: 1,
            static: false,
            monthSelectorType: "dropdown",
            prevArrow: "<i class='fas fa-chevron-left'></i>",
            nextArrow: "<i class='fas fa-chevron-right'></i>",
            locale: {
                firstDayOfWeek: 1
            },
            onReady: function(selectedDates, dateStr, instance) {
                // Set default month to August 2025 to match your image
                instance.jumpToDate("2025-08-01");
            },
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    const startDate = selectedDates[0];
                    const endDate = selectedDates[1];
                    const options = { month: 'short', day: 'numeric', year: 'numeric' };
                    const formattedStart = startDate.toLocaleDateString('en-US', options);
                    const formattedEnd = endDate.toLocaleDateString('en-US', options);
                    instance.input.value = `${formattedStart} - ${formattedEnd}`;
                }
            },
            onOpen: function(selectedDates, dateStr, instance) {
                // Ensure calendar shows August 2025 when opening
                if (selectedDates.length === 0) {
                    instance.jumpToDate("2025-08-01");
                }
            }
        });
        
        // Travelers dropdown functionality
        const travelersInput = document.getElementById('travelersInput');
        const travelersMenu = document.getElementById('travelersMenu');
        const travelersDone = document.getElementById('travelersDone');
        const roomsCount = document.getElementById('roomsCount');
        const adultsCount = document.getElementById('adultsCount');
        const childrenCount = document.getElementById('childrenCount');
        
        // Toggle dropdown on click
        travelersInput.addEventListener('click', function() {
            travelersMenu.classList.toggle('show');
        });
        
        // Close dropdown when done is clicked
        travelersDone.addEventListener('click', function() {
            travelersMenu.classList.remove('show');
            updateTravelersSummary();
        });
        
        // Handle counter button clicks
        travelersMenu.addEventListener('click', function(e) {
            if (e.target.classList.contains('counter-btn')) {
                const type = e.target.getAttribute('data-type');
                const action = e.target.getAttribute('data-action');
                const input = document.getElementById(type + 'Count');
                let value = parseInt(input.value);
                
                if (action === 'increase') {
                    if (type === 'rooms' && value < 10) value++;
                    else if (type === 'adults' && value < 20) value++;
                    else if (type === 'children' && value < 10) value++;
                } else if (action === 'decrease' && value > 0) {
                    if (type === 'adults' && value > 1) value--;
                    else if (type !== 'adults') value--;
                }
                
                input.value = value;
                updateCounterButtons();
            }
        });
        
        // Update the display text
        function updateTravelersSummary() {
            const rooms = parseInt(roomsCount.value);
            const adults = parseInt(adultsCount.value);
            const children = parseInt(childrenCount.value);
            
            let text = `${rooms} Room${rooms > 1 ? 's' : ''}, ${adults} Adult${adults > 1 ? 's' : ''}, ${children} Child${children !== 1 ? 'ren' : ''}`;
            travelersInput.innerHTML = text + ' <i class="fas fa-chevron-down"></i>';
        }
        
        // Update button states
        function updateCounterButtons() {
            // Update rooms buttons
            const roomsDecrease = document.querySelector('[data-type="rooms"][data-action="decrease"]');
            const roomsIncrease = document.querySelector('[data-type="rooms"][data-action="increase"]');
            roomsDecrease.disabled = parseInt(roomsCount.value) <= 1;
            roomsIncrease.disabled = parseInt(roomsCount.value) >= 10;
            
            // Update adults buttons
            const adultsDecrease = document.querySelector('[data-type="adults"][data-action="decrease"]');
            const adultsIncrease = document.querySelector('[data-type="adults"][data-action="increase"]');
            adultsDecrease.disabled = parseInt(adultsCount.value) <= 1;
            adultsIncrease.disabled = parseInt(adultsCount.value) >= 20;
            
            // Update children buttons
            const childrenDecrease = document.querySelector('[data-type="children"][data-action="decrease"]');
            const childrenIncrease = document.querySelector('[data-type="children"][data-action="increase"]');
            childrenDecrease.disabled = parseInt(childrenCount.value) <= 0;
            childrenIncrease.disabled = parseInt(childrenCount.value) >= 10;
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!travelersInput.contains(e.target) && !travelersMenu.contains(e.target)) {
                travelersMenu.classList.remove('show');
            }
        });
        
        // Initialize button states
        updateCounterButtons();
        
        // Form submission handling
        const searchForm = document.getElementById('searchForm');
        const dateRangePicker = document.getElementById('dateRangePicker');
        
        // Update hidden inputs when travelers change
        function updateHiddenInputs() {
            document.getElementById('roomsValue').value = roomsCount.value;
            document.getElementById('adultsValue').value = adultsCount.value;
            document.getElementById('childrenValue').value = childrenCount.value;
        }
        
        // Update travelers summary and hidden inputs
        function updateTravelersSummary() {
            const rooms = parseInt(roomsCount.value);
            const adults = parseInt(adultsCount.value);
            const children = parseInt(childrenCount.value);
            
            let text = `${rooms} Room${rooms > 1 ? 's' : ''}, ${adults} Adult${adults > 1 ? 's' : ''}, ${children} Child${children !== 1 ? 'ren' : ''}`;
            travelersInput.innerHTML = text + ' <i class="fas fa-chevron-down"></i>';
            
            // Update hidden inputs
            updateHiddenInputs();
        }
        
        // Update counter buttons and hidden inputs
        function updateCounterButtons() {
            // ... existing counter button logic ...
            
            // Update hidden inputs
            updateHiddenInputs();
        }
        
        // Handle form submission
        searchForm.addEventListener('submit', function(e) {
            const dateRange = dateRangePicker.value;
            
            if (!dateRange) {
                e.preventDefault();
                alert('Please select check-in and check-out dates.');
                return;
            }
            
            // Parse the date range
            if (dateRange.includes(' - ')) {
                const dates = dateRange.split(' - ');
                const checkIn = new Date(dates[0]);
                const checkOut = new Date(dates[1]);
                
                // Format dates as YYYY-MM-DD
                document.getElementById('checkInDate').value = checkIn.toISOString().split('T')[0];
                document.getElementById('checkOutDate').value = checkOut.toISOString().split('T')[0];
            } else {
                e.preventDefault();
                alert('Please select both check-in and check-out dates.');
                return;
            }
            
            // Update hidden inputs one more time before submission
            updateHiddenInputs();
        });
        
        // Initial setup
        updateHiddenInputs();
    });
</script>

@endsection
