<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for($i=1; $i<=5; $i++) {
            \DB::table('m_perusahaan_b2b')->insert([
                'NAMA_PERUSAHAAN' => $faker->company,
                'ALAMAT_PERUSAHAAN' => $faker->address,
                'NO_TELP_PERUSAHAAN' => $faker->e164PhoneNumber,
                'NPWP_PERUSAHAAN' => $faker->nik,
                'DELETED' => 0,
                'CREATED_BY' => 'admin_ticmi',
                'CREATED_AT' => $faker->dateTime,
                'UPDATED_BY' => 'admin_ticmi',
                'UPDATED_AT' => $faker->dateTime
            ]);
        }
    }
}
