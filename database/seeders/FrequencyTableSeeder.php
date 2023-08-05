<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrequencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('frequencies')->truncate();
        $frequencies = ['Daily', 'Weekly', 'Monthly', 'Quarter'];
        foreach ($frequencies as $frequency) {
            DB::table('frequencies')->insert(['name' => $frequency]);
        }
    }
}
