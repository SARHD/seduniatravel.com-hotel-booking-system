<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function results(Request $request)
    {
        // Extract search parameters
        $params = $request->only(['destination', 'check_in', 'check_out', 'rooms', 'adults', 'children']);

        // Mock data for hotels based on search
        $mockHotels = $this->getMockSearchResults($params['destination'] ?? 'Kuala Lumpur');

        return view('search.results', [
            'destination' => ucfirst($params['destination'] ?? 'Kuala Lumpur'),
            'check_in' => $params['check_in'],
            'check_out' => $params['check_out'],
            'rooms' => $params['rooms'],
            'adults' => $params['adults'],
            'children' => $params['children'] ?? 0,
            'hotels' => $mockHotels,
            'totalHotels' => count($mockHotels)
        ]);
    }

    private function getMockSearchResults($destination)
    {
        return [
            [
                'name' => 'Shangri-La Kuala Lumpur',
                'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'description' => 'Parking, Air-Conditioned, Restaurant, Gym, Internet',
                'rating' => 4.5,
                'reviews_count' => 1523,
                'price' => 1839.24,
                'original_price' => 2200.00,
                'cancellation' => 'Free cancellation until 48 hours before check-in',
                'location' => 'Kuala Lumpur, Kuala Lumpur, Malaysia',
                'rooms' => [
                    [
                        'type' => 'Deluxe Single City View',
                        'description' => 'for 1 adult',
                        'cancellation' => 'Free cancellation until 16/08/2025',
                        'meal' => 'Bed And Breakfast (BB)',
                        'price' => 3561.05,
                        'available' => true
                    ],
                    [
                        'type' => 'Deluxe Double City View',
                        'description' => 'for 1 adult',
                        'cancellation' => 'Free cancellation until 16/08/2025',
                        'meal' => 'Bed And Breakfast (BB)',
                        'price' => 4020.81,
                        'available' => true
                    ],
                    [
                        'type' => 'Deluxe Single Sea View',
                        'description' => 'for 1 adult',
                        'cancellation' => 'Free cancellation until 16/08/2025',
                        'meal' => 'Bed And Breakfast (BB)',
                        'price' => 4135.84,
                        'available' => true
                    ]
                ]
            ],
            [
                'name' => 'Fahrenheit Suites Kuala Lumpur',
                'image' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'description' => 'Parking, Air-Conditioned, Restaurant, Pool',
                'rating' => 4.2,
                'reviews_count' => 892,
                'price' => 1158.75,
                'original_price' => 1350.00,
                'cancellation' => 'Free cancellation until 24 hours before check-in',
                'location' => 'Bukit Damansara, Kuala Lumpur, Malaysia'
            ],
            [
                'name' => 'The Boulevard Kuala Lumpur',
                'image' => 'https://images.unsplash.com/photo-1578774204375-826dc5d996ed?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'description' => 'Air-Conditioned, Restaurant, WiFi, Pool',
                'rating' => 4.0,
                'reviews_count' => 654,
                'price' => 856.05,
                'original_price' => 950.00,
                'cancellation' => 'Free cancellation until 72 hours before check-in',
                'location' => 'Mid Valley, Kuala Lumpur, Malaysia'
            ],
            [
                'name' => 'The Maple Suite',
                'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'description' => 'Air-Conditioned, Restaurant, WiFi, Gym',
                'rating' => 3.8,
                'reviews_count' => 445,
                'price' => 579.30,
                'original_price' => 650.00,
                'cancellation' => 'Free cancellation until 24 hours before check-in',
                'location' => 'Ampang, Kuala Lumpur, Malaysia'
            ],
            [
                'name' => 'MyCiti Hotel Kuala Lumpur',
                'image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                'description' => 'Air-Conditioned, Restaurant, WiFi',
                'rating' => 3.5,
                'reviews_count' => 321,
                'price' => 180.75,
                'original_price' => 220.00,
                'cancellation' => 'Non-refundable',
                'location' => 'Cheras, Kuala Lumpur, Malaysia'
            ]
        ];
    }
}
