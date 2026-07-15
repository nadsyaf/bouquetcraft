@extends('admin.layout')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <h1 class="font-display italic text-2xl text-plum">Kelola Bunga</h1>
    <a href="{{ route('admin.flowers.create') }}"
       class="text-xs uppercase tracking-wide font-medium px-4 py-2 rounded-full bg-blush-dark text-white hover:bg-plum transition-colors">
        + Tambah Bunga
    </a>
</div>

<div class="bg-white/70 border border-blush-light rounded-2xl overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-blush-light/50 text-plum">
            <tr>
                <th class="px-4 py-3">Gambar</th>
                <th class="px-4 py-3">Nama Bunga</th>
                <th class="px-4 py-3">Harga / Tangkai</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($flowers as $flower)
                <tr class="border-t border-blush-light/60">
                    <td class="px-4 py-3">
                        <img src="{{ $flower->display_image }}" alt="{{ $flower->flower_name }}" class="w-12 h-12 rounded-lg object-cover">
                    </td>
                    <td class="px-4 py-3 text-plum">{{ $flower->flower_name }}</td>
                    <td class="px-4 py-3 text-plum">Rp {{ number_format($flower->price_per_stem, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.flowers.edit', $flower) }}"
                               class="px-3 py-1.5 rounded-lg bg-lavender-light text-plum hover:bg-lavender transition text-xs">Edit</a>
                            <form action="{{ route('admin.flowers.destroy', $flower) }}" method="POST"
                                  onsubmit="return confirm('Hapus bunga ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition text-xs">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-plum/50">Belum ada data bunga.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $flowers->links() }}</div>
@endsection