<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriWisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kategori = [
            'Alam',
            'Buatan',
            'Budaya',
            'Sejarah',
            'Religi',
        ];

        $q = [];
        foreach ($kategori as $item) {
            $q[] = [
                'nama_kategori_wisata' => $item,
                'slug_kategori_wisata' => urlencode($item),
                'icon_kategori_wisata' => strtolower($item).".png"
            ];
        }

        DB::table('kategori_wisata')->insert($q);
    }
}
