@extends('layouts.app')

@section('title', 'News')

@section('content')
<div class="max-w-3xl mx-auto px-5 sm:px-8 py-14">
    <header class="mb-10 text-center">
        <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-2">News</p>
        <h1 class="font-display italic text-4xl sm:text-5xl text-plum leading-tight">
            Kabar Terbaru BouquetCraft
        </h1>
    </header>

    @php
        $news = [
            ['title' => 'BouquetCraft resmi rilis!', 'date' => 'Juli 2026', 'desc' => 'Custom Bouquet Planner kini bisa diakses semua pelanggan.'],
            ['title' => 'Koleksi bunga baru ditambahkan', 'date' => 'Juli 2026', 'desc' => 'Kini tersedia lebih banyak pilihan bunga segar tiap minggu.'],
        ];
    @endphp

    <div class="space-y-4">
        @foreach ($news as $item)
            <div class="bg-white/70 rounded-2xl border border-blush-light p-5">
                <p class="text-xs text-blush-dark uppercase tracking-wide mb-1">{{ $item['date'] }}</p>
                <h3 class="font-display text-lg text-plum mb-1">{{ $item['title'] }}</h3>
                <p class="text-sm text-plum/70">{{ $item['desc'] }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
