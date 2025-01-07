<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'New Delhi', 'state' => 'Delhi', 'country' => 'India', 'temperature' => 25.6],
            ['name' => 'Mumbai', 'state' => 'Maharashtra', 'country' => 'India', 'temperature' => 29.1],
            ['name' => 'Chennai', 'state' => 'Tamil Nadu', 'country' => 'India', 'temperature' => 31.2],
            ['name' => 'Kolkata', 'state' => 'West Bengal', 'country' => 'India', 'temperature' => 28.0],
            ['name' => 'Bangalore', 'state' => 'Karnataka', 'country' => 'India', 'temperature' => 24.8],
            ['name' => 'Hyderabad', 'state' => 'Telangana', 'country' => 'India', 'temperature' => 26.3],
            ['name' => 'Ahmedabad', 'state' => 'Gujarat', 'country' => 'India', 'temperature' => 27.5],
            ['name' => 'Pune', 'state' => 'Maharashtra', 'country' => 'India', 'temperature' => 26.0],
            ['name' => 'Jaipur', 'state' => 'Rajasthan', 'country' => 'India', 'temperature' => 23.4],
            ['name' => 'Lucknow', 'state' => 'Uttar Pradesh', 'country' => 'India', 'temperature' => 22.9],
        ];

        foreach ($cities as $city) {
            // Will check if city name exists then it will update else insert
            City::updateOrCreate(
                ['name' => $city['name']], // Match based on the city name
                [
                    'state' => $city['state'],
                    'country' => $city['country'],
                    'temperature' => $city['temperature'],
                ]
            );
        }
    }
}
