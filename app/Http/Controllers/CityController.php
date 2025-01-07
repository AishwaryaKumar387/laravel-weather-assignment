<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\City;

class CityController extends Controller
{
    public function fetchMohaliTemperature()
    {
        $client = new Client();
        $latitude = 30.7046; // Latitude for Mohali
        $longitude = 76.7179; // Longitude for Mohali

        try {
            $response = $client->get("https://api.open-meteo.com/v1/forecast", [
                'query' => [
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'current_weather' => true,
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['current_weather']['temperature'])) {
                $temperature = $data['current_weather']['temperature'];

                // Update or Create Mohali record in the database
                City::updateOrCreate(
                    ['name' => 'Mohali'],
                    [
                        'state' => 'Punjab',
                        'country' => 'India',
                        'temperature' => $temperature,
                    ]
                );

                return response()->json([
                    'success' => true,
                    'message' => "Temperature for Mohali fetched successfully.",
                    'temperature' => $temperature,
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Temperature data not found in API response.",
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Failed to fetch temperature data: " . $e->getMessage(),
            ]);
        }
    }
}
