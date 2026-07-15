@extends('layouts.app')

@section('title', 'Custom Bouquet Planner')

@section('content')
<div
    x-data="bouquetPlanner({
        flowers: {!! Js::from($flowers->map(fn($f) => [
            'id' => $f->id,
            'flower_name' => $f->flower_name,
            'price_per_stem' => (float) $f->price_per_stem,
            'image' => $f->display_image,
            'qty' => 0,
        ])) !!},
        wrappers: {!! Js::from($wrappers->map(fn($w) => [
            'id' => $w->id,
            'wrapper_color' => $w->wrapper_color,
            'price' => (float) $w->price,
        ])) !!}
    })"
>
    {{-- ===================== HEADER RINGKAS + STEP INDICATOR ===================== --}}
    <div class="max-w-7xl mx-auto px-5 sm:px-8 pt-10 pb-6">
        <p class="uppercase tracking-[0.25em] text-xs text-blush-dark font-medium mb-2">Choose Your Moment</p>
        <h1 class="font-display italic text-3xl sm:text-4xl text-plum leading-tight max-w-2xl">
            Rangkai buketmu sendiri, langkah demi langkah.
        </h1>

        <div class="mt-6 flex flex-wrap gap-x-8 gap-y-2 text-xs sm:text-sm text-plum/60">
            <span class="flex items-center gap-2"><span class="font-display text-blush-dark">01</span> Pilih bunga</span>
            <span class="flex items-center gap-2"><span class="font-display text-blush-dark">02</span> Pilih pembungkus</span>
            <span class="flex items-center gap-2"><span class="font-display text-blush-dark">03</span> Tulis kartu ucapan</span>
            <span class="flex items-center gap-2"><span class="font-display text-blush-dark">04</span> Cek ringkasan & simpan</span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-5 sm:px-8 pb-10 lg:pb-12">

        <form method="POST" action="{{ route('orders.store') }}" @submit="onSubmit">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- ===================== KOLOM KIRI ===================== --}}
                <div class="lg:col-span-2 space-y-10">

                    {{-- ---------- 1. FLOWERS GRID ---------- --}}
                    <section>
                        <h2 class="font-display text-2xl text-plum mb-1">Pilih Bunga</h2>
                        <p class="text-sm text-plum/60 mb-5">Tambahkan sebanyak tangkai yang kamu mau untuk tiap jenis bunga.</p>

                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                            <template x-for="(flower, index) in flowers" :key="flower.id">
                                <div
                                    class="group relative bg-white/70 rounded-3xl p-4 border border-blush-light shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200"
                                    :class="flower.qty > 0 ? 'ring-2 ring-blush-dark bg-blush-light/40' : ''"
                                >
                                    <div class="aspect-square w-full rounded-2xl overflow-hidden bg-lavender-light mb-3">
                                        <img
                                            :src="flower.image ? flower.image : 'https://placehold.co/300x300/F3C6CE/4A3A48?text=Flower'"
                                            :alt="flower.flower_name"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                        >
                                    </div>

                                    <h3 class="font-medium text-sm text-plum truncate" x-text="flower.flower_name"></h3>
                                    <p class="text-xs text-plum/60 mb-3" x-text="'Rp ' + formatNumber(flower.price_per_stem) + ' / tangkai'"></p>

                                    <div class="flex items-center justify-between bg-cream rounded-full px-1 py-1">
                                        <button
                                            type="button"
                                            @click="decrement(index)"
                                            class="w-7 h-7 flex items-center justify-center rounded-full bg-white text-blush-dark font-semibold hover:bg-blush-light transition"
                                            aria-label="Kurangi jumlah"
                                        >−</button>

                                        <span class="text-sm font-medium w-6 text-center" x-text="flower.qty"></span>

                                        <button
                                            type="button"
                                            @click="increment(index)"
                                            class="w-7 h-7 flex items-center justify-center rounded-full bg-sage text-white font-semibold hover:bg-sage-dark transition"
                                            aria-label="Tambah jumlah"
                                        >+</button>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <template x-if="flowers.length === 0">
                            <p class="text-sm text-plum/50 italic py-6 text-center">Belum ada data bunga di master data. Tambahkan dulu lewat halaman admin / seeder.</p>
                        </template>
                    </section>

                    {{-- ---------- 2. WRAPPER SELECTION ---------- --}}
                    <section>
                        <h2 class="font-display text-2xl text-plum mb-1">Warna Kertas Pembungkus</h2>
                        <p class="text-sm text-plum/60 mb-5">Pilih satu warna yang paling cocok dengan mood buketmu.</p>

                        <div class="flex flex-wrap gap-3">
                            <template x-for="wrapper in wrappers" :key="wrapper.id">
                                <label
                                    class="flex items-center gap-3 pl-2 pr-4 py-2 rounded-full border cursor-pointer transition-all duration-150"
                                    :class="selectedWrapperId === wrapper.id
                                        ? 'border-blush-dark bg-blush-light shadow-sm'
                                        : 'border-blush-light bg-white/60 hover:border-blush'"
                                >
                                    <input
                                        type="radio"
                                        class="hidden"
                                        :value="wrapper.id"
                                        x-model.number="selectedWrapperId"
                                    >
                                    <span
                                        class="w-6 h-6 rounded-full border-2 border-white shadow"
                                        :style="'background-color:' + wrapperSwatch(wrapper.wrapper_color)"
                                    ></span>
                                    <span class="text-sm">
                                        <span class="font-medium" x-text="wrapper.wrapper_color"></span>
                                        <span class="text-plum/50" x-text="' · Rp ' + formatNumber(wrapper.price)"></span>
                                    </span>
                                </label>
                            </template>
                        </div>

                        <template x-if="wrappers.length === 0">
                            <p class="text-sm text-plum/50 italic py-4">Belum ada data wrapper di master data.</p>
                        </template>
                    </section>

                    {{-- ---------- 3. GREETING CARD ---------- --}}
                    <section>
                        <h2 class="font-display text-2xl text-plum mb-1">Kartu Ucapan</h2>
                        <p class="text-sm text-plum/60 mb-5">Tulis pesan singkat untuk penerima buket — akan tampil seperti tulisan tangan di kartu.</p>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <textarea
                                    x-model="greetingText"
                                    maxlength="180"
                                    rows="6"
                                    placeholder="Contoh: Selamat ulang tahun, semoga harimu seindah bunga ini"
                                    class="w-full rounded-2xl border border-lavender bg-white/70 p-4 text-sm text-plum focus:outline-none focus:ring-2 focus:ring-lavender-dark placeholder:text-plum/30 resize-none"
                                ></textarea>
                                <p class="text-xs text-plum/40 mt-1 text-right" x-text="greetingText.length + ' / 180'"></p>
                            </div>

                            <div class="relative bg-blush-light/60 rounded-2xl p-6 flex items-center justify-center min-h-[160px]">
                                <div class="deckle-edge bg-cream w-full max-w-xs mx-auto p-6 shadow-md min-h-[140px] flex items-center justify-center">
                                    <p
                                        class="font-hand text-2xl leading-snug text-plum text-center break-words"
                                        x-text="greetingText.length ? greetingText : 'Pesanmu akan tampil di sini…'"
                                        :class="greetingText.length ? 'text-plum' : 'text-plum/30 italic font-body text-sm'"
                                    ></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                {{-- ===================== KOLOM KANAN (STICKY SUMMARY / GIFT TAG) ===================== --}}
                <aside class="lg:sticky lg:top-24 self-start">
                    <div class="relative bg-lavender-light rounded-3xl p-6 stitch-border">

                        <div class="flex justify-center -mt-9 mb-3">
                            <span class="tag-hole"></span>
                        </div>

                        <h2 class="font-display italic text-xl text-plum text-center mb-1">Ringkasan Pesanan</h2>
                        <p class="text-xs text-plum/50 text-center mb-5">Update otomatis mengikuti pilihanmu</p>

                        <div class="space-y-2 mb-4 max-h-56 overflow-y-auto pr-1">
                            <template x-for="flower in selectedFlowers" :key="flower.id">
                                <div class="flex justify-between text-sm bg-white/60 rounded-xl px-3 py-2">
                                    <span class="truncate pr-2">
                                        <span x-text="flower.flower_name"></span>
                                        <span class="text-plum/50" x-text="' ×' + flower.qty"></span>
                                    </span>
                                    <span class="font-medium whitespace-nowrap" x-text="'Rp ' + formatNumber(flower.qty * flower.price_per_stem)"></span>
                                </div>
                            </template>

                            <template x-if="selectedFlowers.length === 0">
                                <p class="text-xs text-plum/40 italic text-center py-3">Belum ada bunga dipilih</p>
                            </template>
                        </div>

                        <div class="border-t border-dashed border-lavender-dark/60 pt-3 space-y-1.5 text-sm">
                            <div class="flex justify-between text-plum/70">
                                <span>Subtotal bunga</span>
                                <span x-text="'Rp ' + formatNumber(subtotalFlowers)"></span>
                            </div>
                            <div class="flex justify-between text-plum/70">
                                <span>Kertas pembungkus</span>
                                <span x-text="'Rp ' + formatNumber(wrapperPrice)"></span>
                            </div>
                        </div>

                        <div class="border-t border-lavender-dark/60 mt-3 pt-3 flex justify-between items-baseline">
                            <span class="font-display text-lg text-plum">Total</span>
                            <span class="font-display text-2xl text-blush-dark font-semibold" x-text="'Rp ' + formatNumber(total)"></span>
                        </div>

                        <input type="hidden" name="wrapper_id" :value="selectedWrapperId">
                        <input type="hidden" name="greeting_card_text" :value="greetingText">
                        <input type="hidden" name="total_price" :value="total">
                        <input type="hidden" name="order_details" :value="JSON.stringify(orderDetailsPayload)">

                        <button
                            type="submit"
                            :disabled="!canSubmit"
                            class="w-full mt-5 py-3 rounded-full bg-sage hover:bg-sage-dark disabled:bg-plum/20 disabled:cursor-not-allowed text-white font-medium tracking-wide transition-colors duration-150"
                        >
                            Simpan &amp; Buat Pesanan
                        </button>

                        <p class="text-xs text-plum/40 text-center mt-3" x-show="!canSubmit">
                            Pilih minimal 1 bunga dan 1 warna pembungkus dulu ya.
                        </p>
                    </div>
                </aside>

            </div>
        </form>
    </div>
</div>

@push('styles')
<style>
    .deckle-edge {
        clip-path: polygon(
            0% 2%, 3% 0%, 8% 3%, 14% 1%, 20% 3%, 27% 0%, 33% 2%, 40% 0%, 47% 3%,
            53% 0%, 60% 2%, 67% 0%, 74% 3%, 80% 0%, 87% 2%, 93% 0%, 100% 2%,
            100% 98%, 96% 100%, 90% 97%, 84% 100%, 78% 97%, 72% 100%, 65% 98%,
            59% 100%, 52% 97%, 46% 100%, 39% 98%, 33% 100%, 26% 97%, 20% 100%,
            13% 98%, 7% 100%, 0% 98%
        );
    }
    .stitch-border { border: 2px dashed #BBAADD; }
    .tag-hole {
        width: 16px; height: 16px;
        background: #FFF8F4;
        border: 2px solid #BBAADD;
        border-radius: 9999px;
    }
</style>
@endpush

@push('scripts')
<script>
    function bouquetPlanner({ flowers, wrappers }) {
        return {
            flowers: flowers,
            wrappers: wrappers,
            selectedWrapperId: wrappers.length ? wrappers[0].id : null,
            greetingText: '',

            increment(index) {
                this.flowers[index].qty++;
            },
            decrement(index) {
                if (this.flowers[index].qty > 0) {
                    this.flowers[index].qty--;
                }
            },

            get selectedFlowers() {
                return this.flowers.filter(f => f.qty > 0);
            },
            get subtotalFlowers() {
                return this.selectedFlowers.reduce((sum, f) => sum + (f.qty * f.price_per_stem), 0);
            },
            get wrapperPrice() {
                const wrapper = this.wrappers.find(w => w.id === this.selectedWrapperId);
                return wrapper ? wrapper.price : 0;
            },
            get total() {
                return this.subtotalFlowers + this.wrapperPrice;
            },
            get canSubmit() {
                return this.selectedFlowers.length > 0 && this.selectedWrapperId !== null;
            },
            get orderDetailsPayload() {
                return this.selectedFlowers.map(f => ({ flower_id: f.id, quantity: f.qty }));
            },

            formatNumber(value) {
                return new Intl.NumberFormat('id-ID').format(value || 0);
            },

            // Sesuaikan mapping ini dengan nama warna aktual di tabel wrappers kamu.
            wrapperSwatch(colorName) {
                const map = {
                    'pink': '#F3C6CE',
                    'pink pastel': '#F3C6CE',
                    'lavender': '#D8CDEE',
                    'cream': '#FFF3E6',
                    'putih': '#FFFFFF',
                    'classic white': '#FFFFFF',
                    'sage': '#A9C2A1',
                    'sage green': '#A9C2A1',
                    'coklat': '#b89576',
                    'hitam': '#3A2E36',
                };
                const key = (colorName || '').toLowerCase().trim();
                return map[key] || '#E7A9B6';
            },

            onSubmit(event) {
                if (!this.canSubmit) {
                    event.preventDefault();
                }
            },
        }
    }
</script>
@endpush
@endsection
