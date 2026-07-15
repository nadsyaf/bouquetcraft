@extends('admin.layout')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <h1 class="font-display italic text-2xl text-plum">Kelola Wrapper</h1>
    <a href="{{ route('admin.wrappers.create') }}"
       class="text-xs uppercase tracking-wide font-medium px-4 py-2 rounded-full bg-blush-dark text-white hover:bg-plum transition-colors">
        + Tambah Wrapper
    </a>
</div>

<div class="bg-white/70 border border-blush-light rounded-2xl overflow-hidden">
    <table class="w-full text-sm text-left">
        <thead class="bg-blush-light/50 text-plum">
            <tr>
                <th class="px-4 py-3">Warna Wrapper</th>
                <th class="px-4 py-3">Harga</th>
                <th class="px-4 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($wrappers as $wrapper)
                <tr class="border-t border-blush-light/60">
                    <td class="px-4 py-3 text-plum">{{ $wrapper->wrapper_color }}</td>
                    <td class="px-4 py-3 text-plum">Rp {{ number_format($wrapper->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('admin.wrappers.edit', $wrapper) }}"
                               class="px-3 py-1.5 rounded-lg bg-lavender-light text-plum hover:bg-lavender transition text-xs">Edit</a>
                            <form action="{{ route('admin.wrappers.destroy', $wrapper) }}" method="POST"
                                  onsubmit="return confirm('Hapus wrapper ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1.5 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 transition text-xs">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-6 text-center text-plum/50">Belum ada data wrapper.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">{{ $wrappers->links() }}</div>
@endsection