<?php

namespace Database\Seeders;

use App\Models\Section;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('sections')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $faker = Factory::create();
        $sections = [
            ['name' => 'Techniques', 'description' => $faker->text, 'order' => 2],
            ['name' => 'Platforms', 'description' => $faker->text, 'order' => 1],
            ['name' => 'Tools', 'description' => $faker->text, 'order' => 3],
            ['name' => 'Languages & Frameworks', 'description' => $faker->text, 'order' => 0],
        ];

        foreach ($sections as $section) {
            Section::firstOrCreate(['name' => $section['name']], $section);
        }
    }
}
