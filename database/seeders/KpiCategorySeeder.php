<?php

namespace Database\Seeders;

use App\Models\KpiCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KpiCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kpi_categories')->truncate();
        $categories = ['Financial', 'Customer', 'organizational excellence', 'Employees & Growth'];
        foreach ($categories as $category) {
            KpiCategory::firstOrCreate([
                'name' => $category,
                'description' => 'some text',
            ]);
        }
    }
}
