<?php

namespace App\Http\Livewire;

use App\Models\Salario;
use App\Models\Vacante;
use Livewire\Component;
use App\Models\Categoria;
use Livewire\WithFileUploads;

class CrearVacante extends Component
{
    public $titulo;
    public $salario;
    public $categoria;
    public $empresa;
    public $ultimo_dia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    protected $rules = [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'empresa' => 'required',
        'ultimo_dia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024'
    ];

    public function crearVacante()
    {
        $datos = $this->validate();

        // Almacenar la imagen para saber en que lugar del disco quedo almacenada
        $imagen = $this->imagen->store('public/vacantes');
        $datos['imagen'] = str_replace('public/vacantes/','',$imagen); //funcion de php

        //dd($nombre_imagen);

        // Crear la vacante, llamar el modelo
        Vacante::create([
            'titulo' => $datos['titulo'],
            'salario_id' => $datos['salario'],
            'categoria_id' => $datos['categoria'],
            'empresa' => $datos['empresa'],
            'ultimo_dia' => $datos['ultimo_dia'],
            'descripcion' => $datos['descripcion'],
            'imagen' => $datos['imagen'],
            'user_id' => auth()->user()->id,
        ]);

        // Crear un mensaje
        session()->flash('mensaje', 'La Vacante se publico correctamente');

        // Redireccionar un usuario
        return redirect()->route('vacantes.index');
    }

    public function render()
    {

        // Consultar base de datos para options make:model Salario
        $salarios = Salario::all();
        $categorias = Categoria::all(); //Categoria -> modelo

        // Mostrar los resultados de la consulta anterior all();
        return view('livewire.crear-vacante', [
            'salarios' =>$salarios,
            'categorias' =>$categorias
        ]);
    }
}
