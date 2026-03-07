<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categorías
        $categories = [
            'Alimentos y Bebidas',
            'Alojamiento',
            'Agencias de Viajes',
            'Recreación',
            'Transporte Turístico',
            'Guías de Turismo'
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        }

        // Estados y Municipios
        $locations = [
            'Distrito Capital' => ['Libertador'],
            'Mérida' => ['Libertador', 'Alberto Adriani', 'Campo Elías'],
            'Nueva Esparta' => ['Mariño', 'Maneiro', 'Antolín del Campo'],
            'Falcón' => ['Miranda', 'Carirubana', 'Silva'],
            'Aragua' => ['Girardot', 'Santiago Mariño', 'Tovar']
        ];

        foreach ($locations as $stateName => $municipalities) {
            $state = \App\Models\State::create(['name' => $stateName]);
            foreach ($municipalities as $munName) {
                \App\Models\Municipality::create([
                    'name' => $munName,
                    'state_id' => $state->id
                ]);
            }
        }
    }
}
