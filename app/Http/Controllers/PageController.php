<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function about()
    {
        return view('customer.about');
    }

    public function faq()
    {
        return view('customer.faq');
    }

    public function bouquets()
    {
        return view('customer.bouquets');
    }

    public function gallery()
    {
        return view('customer.gallery');
    }

    public function news()
    {
        return view('customer.news');
    }
}
