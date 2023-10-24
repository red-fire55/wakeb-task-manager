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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('frequencies')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $frequencies = ['Daily', 'Weekly', 'Monthly', 'Quarter'];
        foreach ($frequencies as $frequency) {
            DB::table('frequencies')->insert(['name' => $frequency]);
        }
    }
}
