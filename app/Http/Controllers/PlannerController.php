<?php

namespace App\Http\Controllers;

use App\Models\Flower;
use App\Models\Wrapper;

class PlannerController extends Controller
{
    /**
     * Tampilkan halaman Custom Bouquet Planner (form rangkai buket + kalkulasi harga).
     */
    public function index()
    {
        $flowers  = Flower::select('id', 'flower_name', 'price_per_stem', 'image')->get();
        $wrappers = Wrapper::select('id', 'wrapper_color', 'price')->get();

        return view('customer.planner', compact('flowers', 'wrappers'));
    }

    /**
     * Halaman katalog bunga (full page, menampilkan semua bunga yang tersedia).
     */
    public function catalog()
    {
        $flowers = Flower::select('id', 'flower_name', 'price_per_stem', 'image')->get();

        return view('customer.catalog', compact('flowers'));
    }
}
