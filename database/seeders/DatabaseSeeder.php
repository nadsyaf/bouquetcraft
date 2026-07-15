<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Flower;
use App\Models\Wrapper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@bouquetcraft.test'],
            [
                'name'     => 'Admin BouquetCraft',
                'password' => Hash::make('admin12345'),
                'role'     => 'admin',
            ]
        );
        // 1. Data Bunga
        $flowers = [
            [
                'flower_name' => 'Mawar Merah (Rose)',   
                'price_per_stem' => 15000, 
                'image' => '/images/mawar-merah.jpg' // <-- Mengarah ke public/images/mawar-merah.jpg
            ],
            [
                'flower_name' => 'Mawar Putih',           
                'price_per_stem' => 15000, 
                'image' => '/images/mawar-putih.jpg'
            ],
            [
                'flower_name' => 'Bunga Lily Putih',      
                'price_per_stem' => 25000, 
                'image' => '/images/lily-putih.jpg'
            ],
            [
                'flower_name' => 'Tulip Pink',            
                'price_per_stem' => 30000, 
                'image' => '/images/tulip-pink.jpg'
            ],
            [
                'flower_name' => 'Tulip Kuning',          
                'price_per_stem' => 30000, 
                'image' => '/images/tulip-kuning.jpg'
            ],
            [
                'flower_name' => 'Baby Breath',           
                'price_per_stem' => 12000, 
                'image' => '/images/baby-breath.jpg'
            ],
            [
                'flower_name' => 'Daisy Putih',           
                'price_per_stem' => 10000, 
                'image' => '/images/daisy-putih.jpg'
            ],
            [
                'flower_name' => 'Carnation (Anyelir) Pink',   
                'price_per_stem' => 12000, 
                'image' => '/images/carnation-pink.jpg'
            ],
            [
                'flower_name' => 'Sunflower (Matahari)',  
                'price_per_stem' => 18000, 
                'image' => '/images/sunflower.jpg'
            ],
            [
                'flower_name' => 'Anggrek Ungu',          
                'price_per_stem' => 35000, 
                'image' => '/images/anggrek-ungu.jpg'
            ],
            [
                'flower_name' => 'hydrangea',          
                'price_per_stem' => 35000, 
                'image' => '/images/hydrangea.jpg'
            ],
            [
                'flower_name' => 'Peony Pink',            
                'price_per_stem' => 40000, 
                'image' => '/images/peony-pink.jpg'
            ],
        ];

        foreach ($flowers as $flower) {
            Flower::create(array_merge($flower, ['image' => null]));
        }

        // 2. Data Kertas Pembungkus
        $wrappers = [
            ['wrapper_color' => 'Pink',          'price' => 10000],
            ['wrapper_color' => 'Lavender',      'price' => 12000],
            ['wrapper_color' => 'Sage',          'price' => 10000],
            ['wrapper_color' => 'Putih',         'price' => 9000],
            ['wrapper_color' => 'Cream',         'price' => 9000],
            ['wrapper_color' => 'Coklat Kraft',  'price' => 8000],
            ['wrapper_color' => 'Hitam',         'price' => 15000],
        ];

        foreach ($wrappers as $wrapper) {
            Wrapper::create($wrapper);
        }
    }
}
