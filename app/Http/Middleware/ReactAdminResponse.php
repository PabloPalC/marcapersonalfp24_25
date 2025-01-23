<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReactAdminResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $request->merge(['perPage' => 10]);
        if($request->filled('_start')) {
            if($request->filled('_end')) {
                $request->merge(['perPage' => intval($request->_end - $request->_start) + 1]);
            }
            $request->merge(['page' => intval($request->_start / $request->perPage) + 1]);
        }


        if($request->filled('q')){
            $filterValue =$request->q;
            $filterColumns = [
                'ciclo.codCiclo','ciclo.grado','ciclo.nombre',
                'actividades.id',
                'curriculo.id',
                'familiaProfesional.id', 'familias_profesionales.codigo', 'familias_profesionales.nombre',
                'reconocimiento.id',
                'proyecto.id','proyecto.nombre','proyecto.calificacion',
                'user.name','user.nombre','user.apellidos'
            ];
            $modelClassName = $request->route()->controller->modelclass;
            $query = $modelClassName::query();
            $query = $this->applyFilter($filterValue, $filterColumns, $query);
            $request->merge(['query' => $query]);

        }

        $response = $next($request);

        if ($request->routeIs('*.index')) {
            $controller = $request->route()->controller;
            abort_unless(
                $controller && property_exists($controller, 'modelclass'),
                500,
                "The controller must have a 'modelclass' property."
            );
            $modelClassName = $controller->modelclass;
            $response->header('X-Total-Count', $modelClassName::count());
        }

        try {
            if (is_callable([$response, 'getData'])) {
                $responseData = $response->getData();
                if (isset($responseData->data)) {
                    $response->setData($responseData->data);
                }
            }
        } catch (\Throwable $th) {}
        return $response;
    }

    private function applyFilter($filterValue, $filterColumns, $query)  {

        if ($filterValue) {
            $query->where(function ($query) use ($filterValue, $filterColumns) {
                foreach ( $filterColumns  as $column) {
                    $query->orWhere($column, 'like', '%' . $filterValue . '%');
                }
            });
        }
        return $query;
    }
}
