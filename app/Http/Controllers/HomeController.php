<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Models\Wrapper;

class HomeController extends Controller
{
    /**
     * Landing page utama BouquetCraft — beda dari halaman Planner.
     * Isinya perkenalan brand, sorotan bunga terlaris, cara kerja, dan ajakan ke Planner.
     */
    public function index()
    {
        $featuredFlowers = Flower::select('id', 'flower_name', 'price_per_stem', 'image')
            ->latest()
            ->take(4)
            ->get();

        $wrapperCount = Wrapper::count();
        $flowerCount  = Flower::count();

        return view('customer.home', compact('featuredFlowers', 'wrapperCount', 'flowerCount'));
    }
}
