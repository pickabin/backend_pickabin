<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use App\Models\KoorGedung;
use App\Models\KoorUmum;
use App\Models\Petugas;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uid' => 'P9iZNxo3toNAMP0FYjIhtPB9Q9k2',
            'name' => 'Fidisa Anindya Pastika',
            'address' => 'Surabaya',
            'phone' => '089521441520',
            'email' => 'fidianindya@gmail.com',
            'password' => bcrypt('fidisanindya'),
        ]);
        User::create([
            'uid' => 'D5Cs4zEOwgSRz3N64p1t6Orc1Sq2',
            'name' => 'Santi',
            'address' => 'Surabaya',
            'phone' => '089521441520',
            'email' => 'santi12@gmail.com',
            'password' => bcrypt('santi123'),
        ]);
        User::create([
            'uid' => 'jMJz1NZF6MPqipvCFItJm4TAY6p2',
            'name' => 'Aradhana Lukman',
            'address' => 'Surabaya',
            'phone' => '089521441520',
            'email' => 'aradhana@gmail.com',
            'password' => bcrypt('santi123'),
        ]);
        User::create([
            'uid' => 'Hqrg3fOYRVcvkQ374bBfwAhLsDT2',
            'name' => 'Hudzaifah Al Labib',
            'address' => 'Surabaya',
            'phone' => '089521441520',
            'email' => 'hudzaifah@gmail.com',
            'password' => bcrypt('santi123'),
        ]);
        User::create([
            'uid' => 'seQ2kQgK3fguAsH43VhTHbhRbW73',
            'name' => 'Budi',
            'address' => 'Surabaya',
            'phone' => '089521441520',
            'email' => 'budi123@gmail.com',
            'password' => bcrypt('Budi123'),
        ]);
        User::create([
            'uid' => 'lckw5isAqedAB5VYjdNF5ZKvh2y2',
            'name' => 'Aladino Zulmar Abadi',
            'address' => 'Surabaya',
            'phone' => '089521441520',
            'email' => 'aladinozulmar@gmail.com',
            'password' => bcrypt('Aladino123'),
        ]);
        KoorUmum::create([
            'user_id' => 2,
            'photo' => 'test.jpg',
        ]);
        KoorGedung::create([
            'user_id' => 1,
            'code' => 'D4PENS',
            'clean_area' => '2 SPE',
            'photo' => 'test.jpg',
        ]);
        KoorGedung::create([
            'user_id' => 3,
            'code' => 'D3PENS',
            'clean_area' => '1 IT',
            'photo' => 'test.jpg',
        ]);
        KoorGedung::create([
            'user_id' => 4,
            'code' => 'PSPENS',
            'clean_area' => 'Lantai 7',
            'photo' => 'test.jpg',
        ]);
        Petugas::create([
            'user_id' => 5,
            'code' => 'PSPENS',
            'clean_area' => 'Lantai 2',
            'photo' => 'test.jpg',
        ]);
        Petugas::create([
            'user_id' => 6,
            'code' => 'PSPENS',
            'clean_area' => 'Lantai 3',
            'photo' => 'test.jpg',
        ]);
        Jadwal::create([
            'user_id' => 1,
            'clean_area' => '2 SPE',
            'status' => 0,
        ]);
        Jadwal::create([
            'user_id' => 3,
            'clean_area' => '1 IT',
            'status' => 0,
        ]);
        Jadwal::create([
            'user_id' => 4,
            'clean_area' => 'Lantai 7',
            'status' => 0,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
