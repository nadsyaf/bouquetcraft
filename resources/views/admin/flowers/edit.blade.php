@extends('admin.layout')

@section('admin-content')
<h1 class="font-display italic text-2xl text-plum mb-6">Edit Bunga</h1>

<form action="{{ route('admin.flowers.update', $flower) }}" method="POST" enctype="multipart/form-data"
      class="bg-white/70 border border-blush-light rounded-2xl p-6 space-y-5 max-w-lg">
    @csrf
    @method('PUT')

    <div class="flex items-center gap-4">
        <img src="{{ $flower->display_image }}" alt="{{ $flower->flower_name }}" class="w-16 h-16 rounded-xl object-cover">
        <p class="text-sm text-plum/60">Gambar saat ini. Unggah file baru di bawah untuk mengganti.</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-plum mb-1">Nama Bunga</label>
        <input type="text" name="flower_name" value="{{ old('flower_name', $flower->flower_name) }}" required
               class="w-full rounded-xl border border-blush-light px-4 py-2.5 bg-cream/60 focus:outline-none focus:ring-2 focus:ring-blush-dark">
    </div>

    <div>
        <label class="block text-sm font-medium text-plum mb-1">Harga per Tangkai (Rp)</label>
        <input type="number" step="0.01" min="0" name="price_per_stem" value="{{ old('price_per_stem', $flower->price_per_stem) }}" required
               class="w-full rounded-xl border border-blush-light px-4 py-2.5 bg-cream/60 focus:outline-none focus:ring-2 focus:ring-blush-dark">
    </div>

    <div>
        <label class="block text-sm font-medium text-plum mb-1">Ganti Gambar (opsional)</label>
        <input type="file" name="image" accept="image/*"
               class="w-full text-sm text-plum/70 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blush-light file:text-plum">
    </div>

    <div class="flex gap-3 pt-2">
        <button type="submit" class="px-5 py-2.5 rounded-full bg-blush-dark text-white text-xs uppercase tracking-wide hover:bg-plum transition-colors">
            Update
        </button>
        <a href="{{ route('admin.flowers.index') }}" class="px-5 py-2.5 rounded-full bg-white border border-blush-light text-plum text-xs uppercase tracking-wide hover:bg-blush-light transition-colors">
            Batal
        </a>
    </div>
</form>
@endsection