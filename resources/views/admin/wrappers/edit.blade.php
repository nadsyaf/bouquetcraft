@extends('admin.layout')

@section('admin-content')
<h1 class="font-display italic text-2xl text-plum mb-6">Edit Wrapper</h1>

<form action="{{ route('admin.wrappers.update', $wrapper) }}" method="POST"
      class="bg-white/70 border border-blush-light rounded-2xl p-6 space-y-5 max-w-lg">
    @csrf
    @method('PUT')

    <div>
        <label class="block text-sm font-medium text-plum mb-1">Warna Wrapper</label>
        <input type="text" name="wrapper_color" value="{{ old('wrapper_color', $wrapper->wrapper_color) }}" required
               class="w-full rounded-xl border border-blush-light px-4 py-2.5 bg-cream/60 focus:outline-none focus:ring-2 focus:ring-blush-dark">
    </div>

    <div>
        <label class="block text-sm font-medium text-plum mb-1">Harga (Rp)</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $wrapper->price) }}" required
               class="w-full rounded-xl border border-blush-light px-4 py-2.5 bg-cream/60 focus:outline-none focus:ring-2 focus:ring-blush-dark">
    </div>

    <div class="flex gap-3 pt-2">
        <button type="submit" class="px-5 py-2.5 rounded-full bg-blush-dark text-white text-xs uppercase tracking-wide hover:bg-plum transition-colors">
            Update
        </button>
        <a href="{{ route('admin.wrappers.index') }}" class="px-5 py-2.5 rounded-full bg-white border border-blush-light text-plum text-xs uppercase tracking-wide hover:bg-blush-light transition-colors">
            Batal
        </a>
    </div>
</form>
@endsection