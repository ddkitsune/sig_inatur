<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TouristProvider;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProviders = TouristProvider::count();
        $statsByCategory = Category::withCount('touristProviders')->get();
        $statsByState = \App\Models\State::withCount(['municipalities as tourist_providers_count' => function($query) {
            $query->join('tourist_providers', 'municipalities.id', '=', 'tourist_providers.municipality_id');
        }])->get();

        $statsByStatus = [
            'activo' => TouristProvider::where('status', 'activo')->count(),
            'vencido' => TouristProvider::where('status', 'vencido')->count(),
            'tramite' => TouristProvider::where('status', 'tramite')->count(),
        ];

        return view('dashboard', compact('totalProviders', 'statsByCategory', 'statsByState', 'statsByStatus'));
    }
}
