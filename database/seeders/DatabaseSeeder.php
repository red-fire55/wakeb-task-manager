<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(RequiredSeeder::class);
        $this->call(FrequencyTableSeeder::class);
        $this->call(KpiCategorySeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(SectionSeeder::class);
    }
}
