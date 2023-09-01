<?php

namespace Database\Seeders;

use App\Models\Section;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Factory::create();
        $sections = [
            ['name' => 'Techniques', 'description' => $faker->text],
            ['name' => 'Platforms', 'description' => $faker->text],
            ['name' => 'Tools', 'description' => $faker->text],
            ['name' => 'Languages & Frameworks', 'description' => $faker->text],
        ];

        foreach ($sections as $section) {
            Section::firstOrCreate(['name' => $section['name']], $section);
        }
    }
}
