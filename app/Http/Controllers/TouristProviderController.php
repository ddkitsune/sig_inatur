<?php

namespace App\Http\Controllers;

use App\Models\TouristProvider;
use App\Models\Category;
use App\Models\State;
use App\Models\Municipality;
use Illuminate\Http\Request;

class TouristProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TouristProvider::with(['category', 'municipality.state']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('razon_social', 'like', "%{$search}%")
                  ->orWhere('num_rtn', 'like', "%{$search}%")
                  ->orWhere('rif', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $providers = $query->latest()->get();
        $categories = Category::all();

        return view('providers.index', compact('providers', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $states = State::with('municipalities')->get();
        return view('providers.create', compact('categories', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'num_rtn' => 'required|unique:tourist_providers,num_rtn',
            'rif' => 'required|unique:tourist_providers,rif',
            'razon_social' => 'required|string|max:255',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email',
            'category_id' => 'required|exists:categories,id',
            'municipality_id' => 'required|exists:municipalities,id',
            'status' => 'required|in:activo,vencido,tramite',
            'valid_until' => 'nullable|date',
            'capacity' => 'required|integer|min:0',
        ]);

        TouristProvider::create($validated);

        return redirect()->route('providers.index')->with('success', 'Prestador registrado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TouristProvider $provider)
    {
        return view('providers.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TouristProvider $provider)
    {
        $categories = Category::all();
        $states = State::with('municipalities')->get();
        return view('providers.edit', compact('provider', 'categories', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TouristProvider $provider)
    {
        $validated = $request->validate([
            'num_rtn' => 'required|unique:tourist_providers,num_rtn,' . $provider->id,
            'rif' => 'required|unique:tourist_providers,rif,' . $provider->id,
            'razon_social' => 'required|string|max:255',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email',
            'category_id' => 'required|exists:categories,id',
            'municipality_id' => 'required|exists:municipalities,id',
            'status' => 'required|in:activo,vencido,tramite',
            'valid_until' => 'nullable|date',
            'capacity' => 'required|integer|min:0',
        ]);

        $provider->update($validated);

        return redirect()->route('providers.index')->with('success', 'Prestador actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TouristProvider $provider)
    {
        $provider->delete();
        return redirect()->route('providers.index')->with('success', 'Prestador eliminado exitosamente.');
    }
}
