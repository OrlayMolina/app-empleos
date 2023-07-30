<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use Illuminate\Http\Request;

class VacanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $this->authorize('viewAny', Vacante::class);
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $this->authorize('create', Vacante::class);
        return view('vacantes.create');
    }


    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
        return view('vacantes.show', [
            'vacante' => $vacante
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacante $vacante)
    {
        // Si el usuario no está autenticado, puede que debas redirigirlo a la página de inicio de sesión antes de permitirle acceder a la página de edición de la vacante
        if (!auth()->check()) {
            return redirect('/login');
        }
        
        $this->authorize('update', $vacante); // primero se le pasa el nombre del método del policy y luego la instancia

        return view('vacantes.edit', [
            'vacante' => $vacante
        ]);
    }

}
