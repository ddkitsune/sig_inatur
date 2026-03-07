<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TouristProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = [
            [
                'num_rtn' => 'RTN-001',
                'rif' => 'J-12345678-1',
                'razon_social' => 'Posada del Sol Merideño',
                'direccion' => 'Av. Universidad km 4, Mérida',
                'telefono' => '0274-1234567',
                'email' => 'posada@merida.com',
                'category_id' => 2, // Alojamiento
                'municipality_id' => 2, // Libertador (Mérida)
            ],
            [
                'num_rtn' => 'RTN-002',
                'rif' => 'J-12345678-2',
                'razon_social' => 'Arepera El Chamo',
                'direccion' => 'Calle Real Sabana Grande, Caracas',
                'telefono' => '0212-9876543',
                'email' => 'contacto@arepera.ve',
                'category_id' => 1, // Alimentos y Bebidas
                'municipality_id' => 1, // Libertador (Distrito Capital)
            ],
            [
                'num_rtn' => 'RTN-003',
                'rif' => 'J-11223344-5',
                'razon_social' => 'TransTur Nueva Esparta',
                'direccion' => 'Puerto del Guamache, Isla Margarita',
                'telefono' => '0295-8887766',
                'email' => 'trans@margarita.com',
                'category_id' => 5, // Transporte Turístico
                'municipality_id' => 6, // Mariño (N. Esparta)
            ],
            [
                'num_rtn' => 'RTN-004',
                'rif' => 'J-55667788-0',
                'razon_social' => 'Agencia Viajes Aventura',
                'direccion' => 'C.C. Las Virtudes, Punto Fijo',
                'telefono' => '0269-1112233',
                'email' => 'viajes@aventura.ve',
                'category_id' => 3, // Agencias de Viajes
                'municipality_id' => 8, // Carirubana (Falcón)
            ],
        ];

        foreach ($providers as $provider) {
            \App\Models\TouristProvider::create($provider);
        }
    }
}
