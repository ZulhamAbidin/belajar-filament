<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(20)->create();
        User::create([
            'name' => 'Admin User',
            'email' => 'zlhm378@gmail.com',
            'password' => Hash::make('123809'),
        ]);

        $kategori = [
            ['nama' => 'Teknologi', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Pendidikan', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Kesehatan', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Bisnis', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('kategori')->insert($kategori);

        $postingan = [
            [
                'judul' => 'Perkembangan Teknologi AI',
                'slug' => Str::slug('Perkembangan Teknologi AI'),
                'konten' => 'Teknologi AI berkembang pesat, memberikan dampak besar di berbagai industri.',
                'kategori_id' => 1,
                'published' => true,
                'sampul' => 'dummy.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Tips Belajar Efektif',
                'slug' => Str::slug('Tips Belajar Efektif'),
                'konten' => 'Belajar efektif dapat dilakukan dengan manajemen waktu dan teknik membaca cepat.',
                'kategori_id' => 2,
                'published' => true,
                'sampul' => 'dummy.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Pentingnya Hidup Sehat',
                'slug' => Str::slug('Pentingnya Hidup Sehat'),
                'konten' => 'Menjaga kesehatan tubuh adalah hal penting untuk mendukung produktivitas.',
                'kategori_id' => 3,
                'published' => false,
                'sampul' => 'dummy.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('postingan')->insert($postingan);

    }
}
