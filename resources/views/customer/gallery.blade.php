@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
<div class="max-w-7xl mx-auto px-5 sm:px-8 py-14">
    <header class="mb-10 text-center">
        <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-2">Gallery</p>
        <h1 class="font-display italic text-4xl sm:text-5xl text-plum leading-tight">
            Galeri Buket Pelanggan
        </h1>
        <p class="mt-3 text-sm sm:text-base text-plum/70 max-w-xl mx-auto">
            Beberapa contoh rangkaian yang paling banyak dipesan lewat Custom Bouquet Planner.
        </p>
    </header>

    @php
        $galleryPhotos = [
            'https://images.unsplash.com/photo-1518895949257-7621c3c786d7?q=80&w=500&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1520763185298-1b434c919102?q=80&w=500&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1587145717466-8d2a1a4b1e3a?q=80&w=500&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1560717845-968823efbee1?q=80&w=500&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1524598171353-e1ce8fc16aa4?q=80&w=500&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1490750967868-88aa4486c946?q=80&w=500&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1487070183336-b863922373d4?q=80&w=500&auto=format&fit=crop',
            'https://images.unsplash.com/photo-1499002238440-d264edd596ec?q=80&w=500&auto=format&fit=crop',
        ];
    @endphp

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
        @foreach ($galleryPhotos as $photo)
            <div class="aspect-square rounded-2xl overflow-hidden bg-lavender-light border border-blush-light">
                <img src="{{ $photo }}" alt="Contoh buket BouquetCraft" class="w-full h-full object-cover" loading="lazy">
            </div>
        @endforeach
    </div>
</div>
@endsection
