<?php

use App\Http\Controllers\HomeController;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'getHome']);

Route::get('login', function() {
    return view('auth.login');
});

Route::get('logout', function() {
    return 'Logout usuario';
});

Route::get('perfil/{id?}', function($id = null) {
    return $id ? 'Visualizar el currículo de '. $id : 'Visualizar el currículo propio';
})->where('id', '[0-9]*');


Route::get('pruebaDB/{votos?}', function($votos = null) {

    $html = getEstadisticas();

    Estudiante::where('nombre', 'Juan')
        ->where('apellidos', 'Martinez')->delete();

    $html .= getEstadisticas();

    return $html . '</ul>';

});

function getEstadisticas(){
    $count = Estudiante::where('votos', '>', 100)->count();
    $max = Estudiante::max('votos');
    $min = Estudiante::min('votos');
    $media = Estudiante::avg('votos');
    $total = Estudiante::sum('votos');
    $html = '<ul>';
    $html .= '<li> Estudiantes con mas de 100 votos: '. $count . '</li>';
    $html .= '<li> Máximo numero de votos: '. $max . '</li>';
    $html .= '<li> Minimo numero de votos: '. $min . '</li>';
    $html .= '<li> Media de votos: '. $media . '</li>';
    $html .= '<li> Total de votos: '. $total . '</li>';
    $html .= '</ul>';
    $html .= "\n";
    return $html;
};

include __DIR__.'/actividades.php';
include __DIR__.'/curriculos.php';
include __DIR__.'/proyectos.php';
include __DIR__.'/reconocimientos.php';
include __DIR__.'/users.php';
