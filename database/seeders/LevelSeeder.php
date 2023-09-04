<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('levels')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $levels = [
            ['name' => 'Adopt', 'order' => 0, 'description' => 'We feel strongly that the industry should be adopting these items. We use them when appropriate on our projects.New Moved in/out No change Radar at a glance The Radar is all about tracking interesting things, which we refer to as blips. We organize the blips in the Radar using two categorizing elements: quadrants and rings. The quadrants represent different kinds of blips. The rings indicate what stage in an adoption lifecycle we think they should be in.A blip is a technology or technique that plays a role in software development. Blips are things that are ‘in motion’ — that is we find their position in the Radar is changing — usually indicating that we’re finding increasing confidence in them as they move'],
            ['name' => 'Trial', 'order' => 1, 'description' => 'Worth pursuing. It’s important to understand how to build up this capability. Enterprises can try this technology on a project that can handle the risk.'],
            ['name' => 'Assess', 'order' => 2, 'description' => 'Worth exploring with the goal of understanding how it will affect your enterprise.'],
            ['name' => 'Hold', 'order' => 3, 'description' => 'Proceed with caution.'],
        ];

        foreach ($levels as $key => $level) {
            Level::firstOrCreate(array_merge($level));
        }
    }
}
