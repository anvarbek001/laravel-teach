<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function getWeather($city)
    {
        $apiKey = env('WEATHER_API_KEY'); // .env faylga API kalitini qo'shamiz
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json(['error' => 'Ob-havo maʼlumotlarini olishda xatolik yuz berdi'], 500);
        }

        return response()->json($response->json());
    }
}
