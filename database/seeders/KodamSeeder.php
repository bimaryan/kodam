<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KodamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nouns = [
            'Sendal', 'Sempak', 'Semvak', 'Kancut', 'Kepala', 'Tangan', 'Kaki', 'Prabu', 'Raja', 'Ratu', 'Pangeran', 'Putri',
            'Ular', 'Tikus', 'Kucing', 'Anjing', 'Babi', 'Monyet', 'Gorila', 'Banteng', 'Singa', 'Macan', 'Harimau', 'Serigala',
            'Beruang', 'Burung', 'Elang', 'Gagak', 'Ayam', 'Bebek', 'Ikan', 'Hiu', 'Paus', 'Lele', 'Cumi', 'Kepiting',
            'Siput', 'Kecoa', 'Semut', 'Laba-laba', 'Kadal', 'Cicak', 'Tokek', 'Buaya', 'Biawak', 'Kura-kura', 'Naga', 'Dinosaurus',
            'Godzilla', 'Alien', 'Robot', 'Cyborg', 'Pocong', 'Kuntilanak', 'Tuyul', 'Genderuwo', 'Wewe Gombel', 'Jin', 'Setan',
            'Bidadari', 'Dewa', 'Dewi', 'Raksasa', 'Kurcaci', 'Siluman', 'Jenglot', 'Ambatukam', 'Rusdi', 'Rehan', 'Jawir',
            'Roni', 'Sigit', 'Supri', 'Udin', 'Asep', 'Joko', 'Budi', 'Sule', 'Parto', 'Nunung', 'Cipung', 'Rafathar',
            'Rakun', 'Sepeda', 'Motor', 'Mobil', 'Becak', 'Bajaj', 'Angkot', 'Truk', 'Kapal', 'Pesawat', 'Helikopter', 'Meja',
            'Kursi', 'Lemari', 'Kasur', 'Bantal', 'Kipas', 'TV', 'Kulkas', 'Panci', 'Wajan', 'Piring', 'Gelas', 'Sendok',
            'Ember', 'Sapu', 'Sepatu', 'Baju', 'Celana', 'Jaket', 'Topi', 'Helm', 'Kacamata', 'Jam', 'Cincin', 'Tas',
            'HP', 'Laptop', 'Kabel', 'Baterai', 'Batu', 'Kayu', 'Besi', 'Plastik', 'Air', 'Api', 'Tanah', 'Angin', 'Petir'
        ];

        $adjectives = [
            'Jepit', 'Firaun', 'Siliwangi', 'Terbang', 'Ngesot', 'Berdasi', 'Wibu', 'Jomok', 'Wangsaf', 'Hitam', 'Putih', 'Merah',
            'Kuning', 'Hijau', 'Biru', 'Pink', 'Emas', 'Perak', 'Besi', 'Kayu', 'Api', 'Es', 'Gaib', 'Sakti', 'Gila',
            'Waras', 'Pintar', 'Bodoh', 'Kuat', 'Lemah', 'Besar', 'Kecil', 'Panjang', 'Pendek', 'Gemuk', 'Kurus', 'Tajam',
            'Kasar', 'Halus', 'Keras', 'Lembek', 'Panas', 'Dingin', 'Basah', 'Kering', 'Wangi', 'Bau', 'Basi', 'Busuk',
            'Manis', 'Pedas', 'Muntah', 'Berak', 'Kencing', 'Mandi', 'Tidur', 'Lari', 'Joget', 'Nangis', 'Ketawa', 'Marah',
            'Sedih', 'Galau', 'Bucin', 'Sombong', 'Pelit', 'Baik', 'Jahat', 'Nakal', 'Sholeh', 'Cacat', 'Utuh', 'Patah',
            'Botak', 'Gondrong', 'Keriting', 'Kumisan', 'Panuan', 'Jerawatan', 'Mencret', 'Laper', 'Haus', 'Mabuk', 'Barbar',
            'Jinak', 'Liar', 'Buas', 'Banci', 'Jomblo', 'Jamet', 'Kuproy', 'Sultan', 'Miskin', 'Ngebor', 'Kayang'
        ];

        $existing = [
            'Sendal Jepit', 'Semvak Firaun', 'Kepala Gajah', 'Prabu Siliwangi',
            'Ular berkepala Singa', 'Tikus Berdasi', 'Kucing kejepit Pager',
            'Kadal Ireng', 'Rakun Wibu', 'Cicak Kuning', 'Bambu Kuning',
            'Ratu Jomok', 'Ambatukam', 'Rusdi', 'Rehan Wangsaf',
            'Serigala Hitam', 'Jawir', 'Macan Putih', 'Dinosaurus Pendek',
            'Ular China', 'Raja Naga Geni', 'Mas Roni'
        ];

        $kodamNames = array_unique($existing);

        // Generate combinations until we have 1000 unique names
        while (count($kodamNames) < 1000) {
            $noun = $nouns[array_rand($nouns)];
            $adjective = $adjectives[array_rand($adjectives)];
            
            // Randomly sometimes combine two adjectives for extra weirdness
            if (rand(1, 10) > 8) {
                $name = $noun . ' ' . $adjectives[array_rand($adjectives)] . ' ' . $adjective;
            } else {
                $name = $noun . ' ' . $adjective;
            }

            if (!in_array($name, $kodamNames)) {
                $kodamNames[] = $name;
            }
        }

        // Shuffle the array so the initial 22 aren't always at the very top (optional)
        shuffle($kodamNames);

        $data = [];
        $now = now();
        foreach ($kodamNames as $name) {
            $data[] = [
                'nama' => $name,
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        // Insert in chunks of 100
        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('kodam')->insert($chunk);
        }
    }
}
