<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Models\City;

class FetchMohaliTemperature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:temperature-mohali';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and store temperature data for Mohali from Open-Meteo API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("Cron Job running at ". now());
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
                    ['name' => 'Mohali'], // Key to check
                    [
                        'state' => 'Punjab',
                        'country' => 'India',
                        'temperature' => $temperature,
                    ]
                );

                $this->info("Temperature for Mohali successfully fetched and stored: {$temperature} °C");
            } else {
                $this->error("Temperature data not found in API response.");
            }
        } catch (\Exception $e) {
            $this->error("Failed to fetch temperature data: " . $e->getMessage());
        }

        return 0;
    }
}
