<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class IndexController extends Controller
{
    public function index()
    {
        $cities = City::select('name', 'temperature', 'created_at')->get();
        return view('index', compact('cities'));
    }
}
