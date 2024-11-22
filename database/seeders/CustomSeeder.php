<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Race;
use App\Models\RaceVehicle;

class CustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usuários já validados
        $validatedUsers = [
            [
                'name' => 'João Silva',
                'username' => 'joaosilva',
                'email' => 'joaosilva@example.com',
                'number' => '12345678901',
                'age' => '1990-01-01',
                'password' => Hash::make('password'),
                'license_path' => 'app/private',
                'is_validated' => true,
                'is_administrator' => false,
            ],
            [
                'name' => 'Maria Oliveira',
                'username' => 'mariaoliveira',
                'email' => 'mariaoliveira@example.com',
                'number' => '12345678902',
                'age' => '1991-01-01',
                'password' => Hash::make('password'),
                'license_path' => 'app/private',
                'is_validated' => true,
                'is_administrator' => false,
            ],
            [
                'name' => 'Pedro Santos',
                'username' => 'pedrosantos',
                'email' => 'pedrosantos@example.com',
                'number' => '12345678905',
                'age' => '1994-01-01',
                'password' => Hash::make('password'),
                'license_path' => 'app/private',
                'is_validated' => true,
                'is_administrator' => false,
            ],
            [
                'name' => 'Julia Almeida',
                'username' => 'juliaalmeida',
                'email' => 'juliaalmeida@example.com',
                'number' => '12345678906',
                'age' => '1995-01-01',
                'password' => Hash::make('password'),
                'license_path' => 'app/private',
                'is_validated' => true,
                'is_administrator' => false,
            ],
            [
                'name' => 'Carlos Pereira',
                'username' => 'carlospereira',
                'email' => 'carlospereira@example.com',
                'number' => '12345678907',
                'age' => '1992-01-01',
                'password' => Hash::make('password'),
                'license_path' => 'app/private',
                'is_validated' => true,
                'is_administrator' => false,
            ],
            [
                'name' => 'Ana Costa',
                'username' => 'anacosta',
                'email' => 'anacosta@example.com',
                'number' => '12345678908',
                'age' => '1993-01-01',
                'password' => Hash::make('password'),
                'license_path' => 'app/private',
                'is_validated' => true,
                'is_administrator' => false,
            ],
        ];

        // Inserir usuários no banco de dados
        DB::table('users')->insert($validatedUsers);

        // Carros cadastrados para os usuários validados
        $vehicles = [
            [
                'model' => 'Fiesta',
                'brand' => 'Ford',
                'category' => 'A',
                'year' => 2020,
                'power' => 150,
                'user_id' => 3, // ID do usuário 'Pedro Santos'
            ],
            [
                'model' => 'Civic',
                'brand' => 'Honda',
                'category' => 'B',
                'year' => 2021,
                'power' => 200,
                'user_id' => 4, // ID do usuário 'Julia Almeida'
            ],
            [
                'model' => 'Corolla',
                'brand' => 'Toyota',
                'category' => 'A',
                'year' => 2019,
                'power' => 140,
                'user_id' => 5, // ID do usuário 'Carlos Pereira'
            ],
            [
                'model' => 'Cruze',
                'brand' => 'Chevrolet',
                'category' => 'B',
                'year' => 2018,
                'power' => 180,
                'user_id' => 6, // ID do usuário 'Ana Costa'
            ],
        ];

        // Inserir veículos no banco de dados
        DB::table('vehicles')->insert($vehicles);

        // Corridas cadastradas
        $races = [
            [
                'name' => 'Rally dos Sertões',
                'category' => 'A',
                'max_vehicles' => 10,
                'date_time' => '2024-11-01 21:00:00',
                'start_latitude' => -23.5505,
                'start_longitude' => -46.6333,
                'end_latitude' => -22.9068,
                'end_longitude' => -43.1729,
            ],
            [
                'name' => 'Rally da Amazônia',
                'category' => 'B',
                'max_vehicles' => 10,
                'date_time' => '2024-11-02 10:00:00',
                'start_latitude' => -23.5505,
                'start_longitude' => -46.6333,
                'end_latitude' => -22.9068,
                'end_longitude' => -43.1729,
            ],
            [
                'name' => 'Rally do Pantanal',
                'category' => 'A',
                'max_vehicles' => 10,
                'date_time' => '2024-11-03 03:00:00',
                'start_latitude' => -20.4697,
                'start_longitude' => -54.6201,
                'end_latitude' => -19.9320,
                'end_longitude' => -56.7210,
            ],
            [
                'name' => 'Rally das Dunas',
                'category' => 'B',
                'max_vehicles' => 10,
                'date_time' => '2024-11-04 02:00:00',
                'start_latitude' => -2.5307,
                'start_longitude' => -44.3068,
                'end_latitude' => -2.5387,
                'end_longitude' => -44.2825,
            ],
        ];

        // Inserir corridas no banco de dados
        DB::table('races')->insert($races);

        // Usuários participando de corridas
        $raceVehicles = [
            [
                'race_id' => 1, // ID da corrida 'Rally dos Sertões'
                'vehicle_id' => 1, // ID do veículo 'Fiesta'
                'position' => 1,
                'time' => '01:30:00',
                'fuel_consumption' => 10.5,
                'average_speed' => 50.0,
                'car_condition' => 'excellent',
                'points' => 1565,
            ],
            [
                'race_id' => 1, // ID da corrida 'Rally dos Sertões'
                'vehicle_id' => 3, // ID do veículo 'Corolla'
                'position' => 2,
                'time' => '01:45:00',
                'fuel_consumption' => 12.0,
                'average_speed' => 40.0,
                'car_condition' => 'good',
                'points' => 918,
            ],
            [
                'race_id' => 2, // ID da corrida 'Rally da Amazônia'
                'vehicle_id' => 2, // ID do veículo 'Civic'
                'position' => 1,
                'time' => '01:40:00',
                'fuel_consumption' => 11.0,
                'average_speed' => 65.0,
                'car_condition' => 'excellent',
                'points' => 2800,
            ],
            [
                'race_id' => 2, // ID da corrida 'Rally da Amazônia'
                'vehicle_id' => 4, // ID do veículo 'Cruze'
                'position' => 2,
                'time' => '01:50:00',
                'fuel_consumption' => 13.0,
                'average_speed' => 57.0,
                'car_condition' => 'good',
                'points' => 2300,
            ],
            [
                'race_id' => 3, // ID da corrida 'Rally do Pantanal'
                'vehicle_id' => 1, // ID do veículo 'Fiesta'
                'position' => 1,
                'time' => '01:35:00',
                'fuel_consumption' => 10.8,
                'average_speed' => 58.0,
                'car_condition' => 'excellent',
                'points' => 2454,
            ],
            [
                'race_id' => 3, // ID da corrida 'Rally do Pantanal'
                'vehicle_id' => 3, // ID do veículo 'Corolla'
                'position' => 2,
                'time' => '01:50:00',
                'fuel_consumption' => 12.5,
                'average_speed' => 48.2,
                'car_condition' => 'good',
                'points' => 2023,
            ],
            [
                'race_id' => 4, // ID da corrida 'Rally das Dunas'
                'vehicle_id' => 2, // ID do veículo 'Civic'
                'position' => 1,
                'time' => '01:45:00',
                'fuel_consumption' => 11.5,
                'average_speed' => 52.0,
                'car_condition' => 'excellent',
                'points' => 2302,
            ],
            [
                'race_id' => 4, // ID da corrida 'Rally das Dunas'
                'vehicle_id' => 4, // ID do veículo 'Cruze'
                'position' => 2,
                'time' => '01:55:00',
                'fuel_consumption' => 13.5,
                'average_speed' => 42.0,
                'car_condition' => 'poor',
                'points' => 1702,
            ],
        ];

        // Inserir veículos de corrida no banco de dados
        DB::table('race_vehicle')->insert($raceVehicles);
    }
}