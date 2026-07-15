<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flower extends Model
{
    use HasFactory;

    // Mengizinkan semua kolom diisi data
    protected $guarded = [];

    protected $appends = ['display_image'];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    /**
     * URL gambar yang ditampilkan di halaman.
     * Mengambil langsung dari file lokal hasil download di folder public/images/
     */
    public function getDisplayImageAttribute(): string
    {
        // 1. Jika di database kolom image ada isinya (seperti dari seeder), langsung pakai path itu
        if ($this->image && (str_starts_with($this->image, '/'))) {
            return asset($this->image);
        }

        $name = strtolower($this->flower_name ?? '');

        // 2. Jika database kosong, ini aturan pencocokan nama bunga dengan file lokalmu
        if (str_contains($name, 'mawar merah') || str_contains($name, 'rose')) {
            return asset('/images/mawar-merah.jpg');
        }
        if (str_contains($name, 'mawar putih')) {
            return asset('/images/mawar-putih.jpg');
        }
        if (str_contains($name, 'lily')) {
            return asset('/images/lily-putih.jpg');
        }
        if (str_contains($name, 'tulip pink')) {
            return asset('/images/tulip-pink.jpg');
        }
        if (str_contains($name, 'tulip kuning')) {
            return asset('/images/tulip-kuning.jpg');
        }
        if (str_contains($name, 'baby')) {
            return asset('/images/baby-breath.jpg');
        }
        if (str_contains($name, 'daisy')) {
            return asset('/images/daisy-putih.jpg');
        }
        if (str_contains($name, 'carnation')) {
            return asset('/images/carnation-pink.jpg');
        }
        if (str_contains($name, 'sunflower') || str_contains($name, 'matahari')) {
            return asset('/images/sunflower.jpg');
        }
        if (str_contains($name, 'anggrek')) {
            return asset('/images/anggrek-ungu.jpg');
        }
        if (str_contains($name, 'hydrangea')) {
            return asset('/images/hydrangea.jpg');
        }
        if (str_contains($name, 'peony')) {
            return asset('/images/peony-pink.jpg');
        }

        // Fallback terakhir kalau nama bunga benar-benar tidak terdaftar di atas
        return 'https://images.unsplash.com/photo-1487070183336-b863922373d4?q=80&w=600&auto=format&fit=crop';
    }
}