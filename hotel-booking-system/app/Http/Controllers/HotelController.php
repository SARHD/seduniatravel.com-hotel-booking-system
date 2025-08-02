<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function showByDestination($destination)
    {
        // For now, we'll use mock data. Later this will integrate with HotelBeds API
        $mockHotels = $this->getMockHotels($destination);
        
        return view('hotels.index', [
            'destination' => ucfirst(str_replace('-', ' ', $destination)),
            'hotels' => $mockHotels
        ]);
    }
    
    private function getMockHotels($destination)
    {
        $hotels = [
            'kuala-lumpur' => [
                [
                    'name' => 'Petronas Twin Towers Hotel',
                    'rating' => 5,
                    'price' => 250,
                    'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'amenities' => ['WiFi', 'Pool', 'Gym', 'Spa']
                ],
                [
                    'name' => 'Grand Hyatt Kuala Lumpur',
                    'rating' => 5,
                    'price' => 180,
                    'image' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'amenities' => ['WiFi', 'Pool', 'Restaurant', 'Business Center']
                ],
                [
                    'name' => 'Mandarin Oriental KL',
                    'rating' => 4,
                    'price' => 150,
                    'image' => 'https://images.unsplash.com/photo-1578774204375-826dc5d996ed?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'amenities' => ['WiFi', 'Pool', 'Gym']
                ]
            ],
            'bangkok' => [
                [
                    'name' => 'Shangri-La Bangkok',
                    'rating' => 5,
                    'price' => 200,
                    'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'amenities' => ['WiFi', 'Pool', 'Spa', 'Restaurant']
                ],
                [
                    'name' => 'The Oriental Bangkok',
                    'rating' => 5,
                    'price' => 280,
                    'image' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'amenities' => ['WiFi', 'Pool', 'Gym', 'Spa', 'Restaurant']
                ],
                [
                    'name' => 'Anantara Riverside Bangkok',
                    'rating' => 4,
                    'price' => 120,
                    'image' => 'https://images.unsplash.com/photo-1586611292717-f828b167408c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'amenities' => ['WiFi', 'Pool', 'Restaurant']
                ]
            ],
            'bali' => [
                [
                    'name' => 'The Mulia Bali',
                    'rating' => 5,
                    'price' => 300,
                    'image' => 'https://images.unsplash.com/photo-1537953773345-d172ccf13cf1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'amenities' => ['WiFi', 'Pool', 'Spa', 'Beach Access']
                ],
                [
                    'name' => 'Four Seasons Resort Bali',
                    'rating' => 5,
                    'price' => 400,
                    'image' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'amenities' => ['WiFi', 'Pool', 'Spa', 'Beach Access', 'Restaurant']
                ],
                [
                    'name' => 'Alila Villas Uluwatu',
                    'rating' => 4,
                    'price' => 220,
                    'image' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'amenities' => ['WiFi', 'Pool', 'Spa']
                ]
            ]
        ];
        
        return $hotels[$destination] ?? [];
    }
}
