<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('pengaturans')->insert([
            'jam_masuk'=>'06:30:00',
            'jam_pulang'=>'12:30:00',
            'jam_maksimal_masuk'=>'10:30:00',
            'jam_maksimal_pulang'=>'18:30:00',
            'jarak_maksimal'=>'170',
            'group_wa_id' => '',
            'token' => ''
        ]);
    }
}
