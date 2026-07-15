<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BouquetCraft') — Custom Bouquet &amp; Gift Planner</title>

    {{-- Google Fonts: Playfair Display (display), Poppins (body), Caveat (handwriting kartu ucapan) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;1,500&family=Poppins:wght@300;400;500;600&family=Caveat:wght@500;600&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#FFF8F4',
                        blush: { DEFAULT: '#F3C6CE', dark: '#E7A9B6', light: '#FAE3E7' },
                        lavender: { DEFAULT: '#D8CDEE', dark: '#BBAADD', light: '#EDE6F7' },
                        sage: { DEFAULT: '#A9C2A1', dark: '#8FAE85' },
                        plum: '#4A3A48',
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        body: ['Poppins', 'sans-serif'],
                        hand: ['Caveat', 'cursive'],
                    },
                }
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        [x-cloak] { display: none !important; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-thumb { background: #E7A9B6; border-radius: 9999px; }

        .envelope-card {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        .envelope-card.is-open {
            animation: cardSlideOut 0.6s ease-out forwards;
            animation-delay: 0.2s;
        }

        @keyframes cardSlideOut {
            from { opacity: 0; transform: translateY(20px) scale(0.95); }
            to   { opacity: 1; transform: translateY(-1.5rem) scale(1); }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-cream font-body text-plum antialiased min-h-screen flex flex-col">

    @include('partials.navbar')

    {{-- ===================== FLASH MESSAGES ===================== --}}
    <div class="max-w-5xl mx-auto w-full px-5 sm:px-8">
        @if (session('order_success'))
    @php $order = session('order_success'); @endphp

    <div class="mt-8 max-w-xl mx-auto">
        <div class="relative">

            {{-- Ilustrasi amplop terbuka (statis, digambar utuh pakai SVG) --}}
            <svg viewBox="0 0 300 170" class="w-full h-auto block relative z-0" style="max-height: 150px;">
                <defs>
                    <linearGradient id="envelopeBody" x1="0" y1="0" x2="0" y2="1">
                        <stop offset="0%" stop-color="#F3C6CE"/>
                        <stop offset="100%" stop-color="#E7A9B6"/>
                    </linearGradient>
                </defs>

                {{-- flap terbuka, berdiri di atas badan amplop --}}
                <polygon points="35,75 150,10 265,75" fill="#E7A9B6" stroke="#ffffff88" stroke-width="2"/>

                {{-- badan amplop --}}
                <rect x="25" y="75" width="250" height="85" rx="18" fill="url(#envelopeBody)" stroke="#ffffff55" stroke-width="2"/>

                {{-- garis kantong depan amplop --}}
                <polyline points="25,75 150,140 275,75" fill="none" stroke="#ffffff88" stroke-width="2"/>
            </svg>

            {{-- Kartu resi: meluncur keluar dari bawah amplop --}}
            <div id="envelope-card" class="envelope-card relative z-10 -mt-10">
                <div class="rounded-3xl bg-white border border-sage/40 shadow-lg px-6 py-6 sm:px-8 sm:py-7 flex flex-col sm:flex-row items-center sm:items-start gap-5">

                    <div class="w-14 h-14 shrink-0 rounded-full bg-sage/15 flex items-center justify-center">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-7 h-7 text-sage-dark">
                            <path d="M20 6L9 17l-5-5"></path>
                        </svg>
                    </div>

                    <div class="flex-1 text-center sm:text-left">
                        <p class="font-display italic text-xl text-plum mb-1">Pesanan berhasil dibuat!</p>
                        <p class="text-sm text-plum/60">
                            Terima kasih sudah merangkai buketmu di BouquetCraft. Simpan nomor pesanan di bawah ini untuk referensi.
                        </p>

                        <div class="flex flex-wrap justify-center sm:justify-start items-center gap-3 mt-4">
                            <span class="inline-flex items-center gap-2 bg-blush-light/70 border border-blush-dark/30 text-plum rounded-full px-4 py-1.5 text-sm">
                                <span class="text-plum/50">No. Pesanan</span>
                                <span class="font-display font-semibold text-blush-dark">#{{ str_pad($order['order_id'], 4, '0', STR_PAD_LEFT) }}</span>
                            </span>
                            <span class="inline-flex items-center gap-2 bg-lavender-light/70 border border-lavender-dark/30 text-plum rounded-full px-4 py-1.5 text-sm">
                                <span class="text-plum/50">{{ $order['item_count'] }} jenis bunga</span>
                            </span>
                            <span class="inline-flex items-center gap-2 bg-sage/15 border border-sage/40 text-plum rounded-full px-4 py-1.5 text-sm">
                                <span class="text-plum/50">Total</span>
                                <span class="font-display font-semibold text-sage-dark">Rp {{ number_format($order['total_price'], 0, ',', '.') }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var card = document.getElementById('envelope-card');
            setTimeout(function () {
                if (card) card.classList.add('is-open');
            }, 200);
        });
    </script>
@endif

        @if ($errors->any())
            <div class="mt-6 rounded-2xl bg-blush-light border border-blush-dark text-plum px-5 py-3 text-sm">
                <p class="font-medium mb-1">Ada yang perlu diperbaiki dulu ya:</p>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <main class="flex-1">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>
</html>