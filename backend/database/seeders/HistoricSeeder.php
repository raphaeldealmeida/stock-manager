<?php

namespace Database\Seeders;

use App\Models\Historic;
use Illuminate\Database\Seeder;

class HistoricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Historic::factory()->count(100)->create();
    }
}
