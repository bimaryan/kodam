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
        DB::table('kodam')->insert([
            [
                'nama' => 'Sendal Jepit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Semvak Firaun',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Kepala Gajah',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Prabu Siliwangi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ular berkepala Singa',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Tikus Berdasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Kucing kejepit Pager',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Kadal Ireng',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Rakun Wibu',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Cicak Kuning',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Bambu Kuning',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ratu Jomok',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ambatukam',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Rusdi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Rehan Wangsaf',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Serigala Hitam',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Jawir',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Macan Putih',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Dinosaurus Pendek',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Ular China',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Raja Naga Geni',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Mas Roni',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
