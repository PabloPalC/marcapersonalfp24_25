<?php

namespace Database\Seeders;

use App\Models\Actividad;
use App\Models\Competencia;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CompetenciasActividadesTableSeeder extends Seeder {

    public function run(): void {
        // Borramos por si hubiese algun dato.
        DB::table('competencias_actividades')->truncate();

        $competencias = Competencia::all();
        $actividades = Actividad::all();

        foreach ($competencias as $competencia) {

            $actividadesAsociadas = $actividades->random(rand(0, 2));

            $competencia->actividades()->attach($actividadesAsociadas);
        }
    }
}
