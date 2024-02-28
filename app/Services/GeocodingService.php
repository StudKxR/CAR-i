<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeocodingService
{
    public static function geocode($address)
    {
        // Replace 'YOUR_MAPBOX_ACCESS_TOKEN' with your actual Mapbox access token
        $accessToken = 'pk.eyJ1IjoiYWZpZm5hcWliIiwiYSI6ImNsc2c4cDNsODFtbXAyaW1ob3A4Z3pkcDgifQ.0l3UzsJXTDunmkFePL8PKA';

        $response = Http::get('https://api.mapbox.com/geocoding/v5/mapbox.places/' . urlencode($address) . '.json', [
            'access_token' => $accessToken,
            'limit' => 1,
        ]);

        $data = $response->json();

        if (!empty($data['features']) && isset($data['features'][0]['center'])) {
            $latitude = $data['features'][0]['center'][1];
            $longitude = $data['features'][0]['center'][0];

            return [
                'latitude' => $latitude,
                'longitude' => $longitude,
            ];
        }

        return null;
    }
}
