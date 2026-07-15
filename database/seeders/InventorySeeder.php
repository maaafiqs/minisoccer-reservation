<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InventoryCategory;
use App\Models\InventoryItem;

class InventorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Bola' => InventoryCategory::create(['name' => 'Bola']),
            'Rompi' => InventoryCategory::create(['name' => 'Rompi']),
            'Alat Medis' => InventoryCategory::create(['name' => 'Alat Medis']),
            'Perlengkapan Lapangan' => InventoryCategory::create(['name' => 'Perlengkapan Lapangan']),
            'Kebersihan' => InventoryCategory::create(['name' => 'Kebersihan']),
        ];

        $items = [
            ['cat' => 'Bola', 'code' => 'BL-001', 'name' => 'Bola Sepak Ukuran 5', 'brand' => 'Adidas', 'qty' => 5, 'status' => 'baik', 'desc' => 'Bola standar FIFA match.'],
            ['cat' => 'Bola', 'code' => 'BL-002', 'name' => 'Bola Latihan', 'brand' => 'Nike', 'qty' => 10, 'status' => 'baik', 'desc' => 'Bola untuk latihan harian.'],
            ['cat' => 'Bola', 'code' => 'BL-003', 'name' => 'Bola Futsal', 'brand' => 'Specs', 'qty' => 3, 'status' => 'rusak', 'desc' => 'Kempes, butuh dipompa/tambal.'],
            ['cat' => 'Bola', 'code' => 'BL-004', 'name' => 'Bola Sepak Ukuran 4', 'brand' => 'Puma', 'qty' => 2, 'status' => 'baik', 'desc' => 'Untuk anak-anak.'],
            
            ['cat' => 'Rompi', 'code' => 'RM-001', 'name' => 'Rompi Latihan Biru', 'brand' => 'Lokal', 'qty' => 12, 'status' => 'baik', 'desc' => 'Warna biru neon.'],
            ['cat' => 'Rompi', 'code' => 'RM-002', 'name' => 'Rompi Latihan Merah', 'brand' => 'Lokal', 'qty' => 12, 'status' => 'baik', 'desc' => 'Warna merah terang.'],
            ['cat' => 'Rompi', 'code' => 'RM-003', 'name' => 'Rompi Latihan Hijau', 'brand' => 'Specs', 'qty' => 10, 'status' => 'baik', 'desc' => 'Warna hijau stabilo.'],
            ['cat' => 'Rompi', 'code' => 'RM-004', 'name' => 'Rompi Latihan Kuning', 'brand' => 'Specs', 'qty' => 2, 'status' => 'rusak', 'desc' => 'Robek di bagian bahu.'],
            
            ['cat' => 'Alat Medis', 'code' => 'MD-001', 'name' => 'Kotak P3K Lengkap', 'brand' => 'OneMed', 'qty' => 2, 'status' => 'baik', 'desc' => 'Isi masih penuh, expired 2028.'],
            ['cat' => 'Alat Medis', 'code' => 'MD-002', 'name' => 'Tandu Lipat', 'brand' => 'GEA', 'qty' => 1, 'status' => 'baik', 'desc' => 'Tandu darurat.'],
            ['cat' => 'Alat Medis', 'code' => 'MD-003', 'name' => 'Semprotan Es (Ice Spray)', 'brand' => 'Perskindol', 'qty' => 4, 'status' => 'baik', 'desc' => 'Pereda nyeri otot instan.'],
            ['cat' => 'Alat Medis', 'code' => 'MD-004', 'name' => 'Tabung Oksigen Portable', 'brand' => 'Oxycan', 'qty' => 0, 'status' => 'rusak', 'desc' => 'Tabung habis, perlu beli baru.'],
            
            ['cat' => 'Perlengkapan Lapangan', 'code' => 'PL-001', 'name' => 'Jaring Gawang Utama', 'brand' => 'Lokal', 'qty' => 2, 'status' => 'baik', 'desc' => 'Jaring cadangan warna putih.'],
            ['cat' => 'Perlengkapan Lapangan', 'code' => 'PL-002', 'name' => 'Tiang Corner Flag', 'brand' => 'Lokal', 'qty' => 4, 'status' => 'baik', 'desc' => 'Bendera sudut lapangan.'],
            ['cat' => 'Perlengkapan Lapangan', 'code' => 'PL-003', 'name' => 'Cone Latihan (Kerucut)', 'brand' => 'Specs', 'qty' => 20, 'status' => 'baik', 'desc' => 'Kerucut pembatas untuk latihan.'],
            ['cat' => 'Perlengkapan Lapangan', 'code' => 'PL-004', 'name' => 'Papan Taktik Coach', 'brand' => 'Molten', 'qty' => 1, 'status' => 'baik', 'desc' => 'Papan strategi dengan magnet.'],
            ['cat' => 'Perlengkapan Lapangan', 'code' => 'PL-005', 'name' => 'Papan Skor Manual', 'brand' => 'Lokal', 'qty' => 1, 'status' => 'rusak', 'desc' => 'Angka copot.'],
            
            ['cat' => 'Kebersihan', 'code' => 'KB-001', 'name' => 'Sapu Lidi Taman', 'brand' => 'Lokal', 'qty' => 3, 'status' => 'baik', 'desc' => 'Sapu untuk area pinggir rumput.'],
            ['cat' => 'Kebersihan', 'code' => 'KB-002', 'name' => 'Mesin Penyedot Air', 'brand' => 'Karcher', 'qty' => 1, 'status' => 'baik', 'desc' => 'Untuk menyedot genangan setelah hujan lebat.'],
            ['cat' => 'Kebersihan', 'code' => 'KB-003', 'name' => 'Tempat Sampah Besar', 'brand' => 'Krisbow', 'qty' => 5, 'status' => 'baik', 'desc' => 'Kapasitas 120 Liter.'],
        ];

        foreach ($items as $item) {
            InventoryItem::create([
                'inventory_category_id' => $categories[$item['cat']]->id,
                'item_code' => $item['code'],
                'name' => $item['name'],
                'brand' => $item['brand'],
                'quantity' => $item['qty'],
                'status' => $item['status'],
                'description' => $item['desc']
            ]);
        }
    }
}
