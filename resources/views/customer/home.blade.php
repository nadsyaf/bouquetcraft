@extends('layouts.app')

@section('title', 'BouquetCraft — Custom Bouquet & Gift Planner')

@section('content')

{{-- ===================== HERO ===================== --}}
<div class="max-w-7xl mx-auto px-5 sm:px-8 mt-6">
    <div class="relative w-full h-[320px] sm:h-[440px] rounded-3xl overflow-hidden bg-blush-light/50 border border-blush-light shadow-sm flex items-center">
        <img
            src="https://images.unsplash.com/photo-1561181286-d3fee7d55364?q=80&w=1400&auto=format&fit=crop"
            alt="Rangkaian bunga segar BouquetCraft"
            class="absolute inset-0 w-full h-full object-cover opacity-90"
        >
        <div class="absolute inset-0 bg-gradient-to-r from-cream/95 via-cream/50 to-transparent"></div>

        <div class="relative z-10 pl-8 sm:pl-14 max-w-md sm:max-w-xl space-y-4">
            <!-- Penanda Berubah Jadi: ✨ NEW PRODUCT SELECTION -->
            <span class="inline-block bg-white/80 text-blush-dark text-[10px] sm:text-xs font-bold tracking-widest uppercase px-3 py-1.5 rounded-full border border-blush/30 shadow-sm">
                ✨ New Product Selection
            </span>
            
            <!-- Judul Berubah Jadi: Seasonal Blossom Sale -->
            <h1 class="font-display italic text-4xl sm:text-6xl text-plum leading-tight">
                Seasonal<br>
                <span class="not-italic text-blush-dark font-semibold">Blossom Sale</span>
            </h1>
            
            <!-- Deskripsi Baru -->
            <p class="text-sm sm:text-base text-plum/80 max-w-xs sm:max-w-md">
                Dapatkan potongan harga otomatis untuk kombinasi bunga mawar premium khusus bulan ini.
            </p>
            
            <!-- Teks Diskon Menggantikan Tombol -->
            <div class="pt-2">
                <p class="text-xs sm:text-sm text-plum/60 tracking-wider uppercase font-medium inline-flex items-center gap-2">
                    Diskon Hingga 
                    <span class="text-xl sm:text-2xl font-semibold text-blush-dark not-italic font-display">20%*</span>
                </p>
            </div>
        </div>

        <!-- Tag Kecil Tambahan di Kanan Bawah Sesuai Gambar -->
        <div class="absolute bottom-5 right-5 bg-white/85 backdrop-blur-sm border border-blush-light rounded-full px-3 py-1.5 shadow-sm text-[10px] sm:text-xs text-plum/70 hidden sm:flex items-center gap-1.5">
            <span class="text-blush-dark">🌸</span> Fresh Flowers Daily <span class="text-plum/30">•</span> Premium Quality
        </div>
    </div>
</div>

{{-- ===================== JUDUL UTAMA (DI BAWAH HERO) ===================== --}}
<div class="max-w-7xl mx-auto px-5 sm:px-8 pt-16 text-center">
    <!-- Teks Kecil Atas -->
    <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-3">
        BouquetCraft — Custom Planner
    </p>
    
    <!-- Judul Besar Dua Warna -->
    <h2 class="font-display italic text-4xl sm:text-6xl text-plum leading-tight max-w-4xl mx-auto">
        Rangkai buket rasa hatimu, <span class="not-italic text-blush-dark font-semibold">tangkai demi tangkai.</span>
    </h2>
    
    <!-- Deskripsi Sub-judul -->
    <p class="text-sm sm:text-base text-plum/70 max-w-2xl mx-auto mt-5 leading-relaxed">
        Pilih bunga favoritmu, tentukan warna pembungkus, lalu titipkan pesan di kartu ucapan. Harga otomatis terhitung di ringkasan sebelah kanan.
    </p>
</div>

{{-- ===================== VALUE PROPS ===================== --}}
<div class="max-w-7xl mx-auto px-5 sm:px-8 py-14">
    @php
        $valueProps = [
            [
                'title' => 'Bunga Segar Setiap Hari',
                'desc'  => 'Stok bunga diperbarui rutin supaya buketmu selalu terlihat dan bertahan segar.',
            ],
            [
                'title' => 'Sepenuhnya Bisa Dikustom',
                'desc'  => 'Kamu yang menentukan jenis bunga, jumlah tangkai, warna pembungkus, sampai pesan di kartu.',
            ],
            [
                'title' => 'Harga Transparan',
                'desc'  => 'Total harga terlihat langsung saat kamu menyusun buket — tidak ada biaya tersembunyi.',
            ],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
        @foreach ($valueProps as $prop)
            <div class="bg-white/70 rounded-2xl p-6 border border-blush-light">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" class="w-7 h-7 text-blush-dark mb-3">
                    <path d="M12 2C12 2 15 5 15 8C15 11 12 12 12 12C12 12 9 11 9 8C9 5 12 2 12 2Z"></path>
                    <path d="M12 12C12 12 15 12 17 14C19 16 19 19 17 21C15 23 12 22 12 22C12 22 9 23 7 21C5 19 5 16 7 14C9 12 12 12 12 12Z"></path>
                </svg>
                <h3 class="font-display text-lg text-plum mb-1">{{ $prop['title'] }}</h3>
                <p class="text-sm text-plum/60 leading-relaxed">{{ $prop['desc'] }}</p>
            </div>
        @endforeach
    </div>
</div>

{{-- ===================== FEATURED FLOWERS ===================== --}}
<div class="bg-white/50 border-y border-blush-light">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 py-14">
        <div class="flex items-end justify-between mb-8 flex-wrap gap-3">
            <div>
                <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-2">Koleksi Bunga</p>
                <h2 class="font-display italic text-3xl sm:text-4xl text-plum leading-tight">
                    Beberapa bunga favorit
                </h2>
            </div>
            <a href="{{ route('catalog') }}" class="text-sm text-blush-dark font-medium hover:underline">
                Lihat semua katalog &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-5">
            @forelse ($featuredFlowers as $flower)
                <div class="bg-white rounded-3xl p-4 border border-blush-light shadow-sm">
                    <div class="aspect-square w-full rounded-2xl overflow-hidden bg-lavender-light mb-3">
                        <img src="{{ $flower->display_image }}" alt="{{ $flower->flower_name }}" class="w-full h-full object-cover" loading="lazy">
                    </div>
                    <h3 class="font-medium text-sm text-plum truncate">{{ $flower->flower_name }}</h3>
                    <p class="text-xs text-plum/60">Rp {{ number_format($flower->price_per_stem, 0, ',', '.') }} / tangkai</p>
                </div>
            @empty
                <p class="col-span-full text-center text-sm text-plum/50 italic py-6">
                    Belum ada data bunga di master data.
                </p>
            @endforelse
        </div>
    </div>
</div>

{{-- ===================== CARA KERJA ===================== --}}
<div class="max-w-7xl mx-auto px-5 sm:px-8 py-16">
    <div class="text-center mb-10">
        <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-2">Cara Kerja</p>
        <h2 class="font-display italic text-3xl sm:text-4xl text-plum leading-tight">
            Empat langkah menuju buket impianmu
        </h2>
    </div>

    @php
        $steps = [
            ['no' => '01', 'title' => 'Pilih Bunga', 'desc' => 'Tentukan jenis dan jumlah tangkai bunga favoritmu.'],
            ['no' => '02', 'title' => 'Pilih Pembungkus', 'desc' => 'Sesuaikan warna kertas pembungkus dengan mood buketmu.'],
            ['no' => '03', 'title' => 'Tulis Kartu Ucapan', 'desc' => 'Titipkan pesan personal untuk penerima buket.'],
            ['no' => '04', 'title' => 'Simpan Pesanan', 'desc' => 'Cek ringkasan harga, lalu buat pesanan dalam satu klik.'],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($steps as $step)
            <div class="relative pl-2">
                <p class="font-display text-4xl text-blush-light font-semibold mb-2">{{ $step['no'] }}</p>
                <h3 class="font-medium text-plum mb-1">{{ $step['title'] }}</h3>
                <p class="text-sm text-plum/60 leading-relaxed">{{ $step['desc'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="text-center mt-10">
        <a href="{{ route('planner') }}" class="inline-block px-6 py-3 rounded-full bg-sage hover:bg-sage-dark text-white text-sm font-medium transition-colors">
            Coba Sekarang di Choose Your Moment
        </a>
    </div>
</div>

{{-- ===================== INSPIRASI BUKET ===================== --}}
<div class="bg-lavender-light/40 border-t border-blush-light">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 py-16">
        <div class="flex items-end justify-between mb-8 flex-wrap gap-3">
            <div>
                <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-2">Inspirasi</p>
                <h2 class="font-display italic text-3xl sm:text-4xl text-plum leading-tight">
                    Nggak tahu mau mulai dari mana?
                </h2>
            </div>
            <a href="{{ route('bouquets') }}" class="text-sm text-blush-dark font-medium hover:underline">
                Lihat semua inspirasi &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            @php
                $inspirations = [
                    ['title' => 'Romantic Rose', 'photo' => '/images/romantic-rose.jpg'],
                    ['title' => 'Soft Pastel',    'photo' => '/images/soft-pastel.jpg'],
                    ['title' => 'Pure Elegance',  'photo' => '/images/pure-elegance.jpg'],
                ];
            @endphp

            @foreach ($inspirations as $item)
                <a href="{{ route('planner') }}" class="group block rounded-3xl overflow-hidden border border-blush-light shadow-sm bg-white hover:shadow-md hover:-translate-y-0.5 transition-all duration-200">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ $item['photo'] }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                    </div>
                    <div class="p-4">
                        <h3 class="font-display text-lg text-plum">{{ $item['title'] }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ===================== CTA AKHIR ===================== --}}
<div class="max-w-7xl mx-auto px-5 sm:px-8 py-16 text-center">
    <h2 class="font-display italic text-3xl sm:text-4xl text-plum leading-tight mb-3">
        Siap merangkai buketmu sendiri?
    </h2>
    <p class="text-sm sm:text-base text-plum/70 max-w-lg mx-auto mb-6">
        Butuh kurang dari lima menit untuk memilih bunga, pembungkus, dan menulis kartu ucapan.
    </p>
    <a href="{{ route('planner') }}" class="inline-block px-8 py-3 rounded-full bg-sage hover:bg-sage-dark text-white text-sm font-medium transition-colors">
        Buka Choose Your Moment
    </a>
</div>

@endsection
