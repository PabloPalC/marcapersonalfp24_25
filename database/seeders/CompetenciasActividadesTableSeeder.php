<?php

namespace Database\Seeders;

use App\Models\CompetenciaActividad;
use Illuminate\Database\Seeder;

class CompetenciasActividadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompetenciaActividad::truncate();

        if (CompetenciaActividad::count() == 0) {
            if (config('app.env') === 'local') {
                CompetenciaActividad::factory(10)->create();
            }
        }
    }
}
