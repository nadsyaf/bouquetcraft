# Catatan Perbaikan — BouquetCraft

Ringkasan perubahan yang dilakukan terhadap project yang diunggah, supaya alurnya berjalan penuh
dari Planner sampai tersimpan ke database, tanpa error.

## 1. Backend

- **`app/Models/Order.php`** dan **`app/Models/OrderDetail.php`** dibuat baru — sebelumnya belum ada
  sama sekali, padahal tabelnya sudah ada di migration. Ini penyebab utama pesanan tidak bisa benar-benar
  tersimpan.
- **`app/Http/Controllers/OrderController.php`** ditulis ulang: sebelumnya route `orders.store` hanya
  closure yang mengembalikan teks statis "Pesanan berhasil disubmit!" — sekarang benar-benar
  memvalidasi input, menghitung ulang total harga di server (mencegah manipulasi harga dari
  DevTools), lalu menyimpan `Order` + banyak `OrderDetail` dalam satu database transaction.
- **`app/Http/Controllers/PlannerController.php`** ditulis ulang: menghapus `die("Data bunga kosong...")`
  yang bisa mematikan seluruh halaman kalau tabel `flowers` kosong, dan mengambil data `wrappers`
  langsung dari database (sebelumnya di-hardcode 3 item statis, tidak sinkron dengan seeder).
- **`app/Http/Controllers/PageController.php`** dibuat baru untuk halaman informasi statis
  (About, FAQ, Bouquets, Gallery, News).
- **`routes/web.php`** dirapikan: semua route sekarang mengarah ke controller yang benar dan
  bernama (`name(...)`) supaya konsisten dipakai di `route()` helper.
- **Migration `orders`**: kolom `user_id` dibuat `nullable` sementara, karena fitur login/auth belum
  dibangun di tahap ini. Begitu ada sistem login, tinggal isi `Auth::id()` di `OrderController` (sudah
  disiapkan) dan opsional dibuat wajib lagi lewat migration baru.
- Ditambahkan relasi Eloquent (`hasMany` / `belongsTo`) antar model `User`, `Order`, `OrderDetail`,
  `Flower`, `Wrapper`.

## 2. Frontend / Blade Views

- Dibuat **`resources/views/layouts/app.blade.php`** sebagai layout utama + partial
  **`partials/navbar.blade.php`** dan **`partials/footer.blade.php`**, supaya kode nav/header
  tidak diduplikasi di tiap halaman.
- **`customer/planner.blade.php`** ditulis ulang: memperbaiki tag HTML yang sebelumnya tidak lengkap
  di navbar (ada `<a>` yang tidak ditutup dan `</div>` yang tidak berpasangan), menghapus duplikasi
  `id="catalog-target"`, dan memperbaiki logic gambar bunga (`asset(null)` sebelumnya bisa
  menghasilkan URL gambar yang salah kalau kolom `image` kosong).
- Panel katalog samping (slide-over) di halaman Planner disederhanakan menjadi halaman **Catalog**
  tersendiri (`/catalog`) supaya tidak ada duplikasi UI antara panel dan halaman katalog yang memang
  sudah direncanakan terpisah.
- Halaman **`about`**, **`faq`**, **`bouquets`**, **`gallery`**, **`news`** yang sebelumnya masih
  0 KB (kosong) sekarang berisi konten nyata, konsisten dengan tema visual girly & elegant.

## 3. Yang masih perlu dikerjakan (belum termasuk di sini)

- Sistem **autentikasi** (login/register) untuk role `admin` dan `customer` — saat ini pesanan bisa
  dibuat tanpa login (`user_id` bernilai null), sesuai catatan di migration.
- Halaman **admin** untuk mengelola master data `flowers`, `wrappers`, dan mengubah status pesanan.
- Jalankan `php artisan storage:link` di server/lokal supaya path gambar `storage/...` bisa diakses
  dari browser (dibutuhkan kalau kamu upload gambar bunga lewat field `image`).
