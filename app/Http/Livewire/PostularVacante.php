<?php

namespace App\Http\Livewire;

use App\Models\Vacante;
use App\Notifications\NuevoCandidato;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostularVacante extends Component
{
    use WithFileUploads;
    public $cv;
    public $vacante;

    protected $rules = [
        'cv' => 'required|mimes:pdf'
    ];

    public function mount(Vacante $vacante)
    {
        $this->vacante = $vacante;
    }


    public function postularme()
    {
        // Verificar si el usuario ha creado una cuenta
        if (!auth()->check()) {
        // Redirigir al usuario a la página de crear cuenta
        return redirect()->back(); // Asumiendo que tienes una ruta con nombre "crear_cuenta" para la página de crear cuenta
        }

        $datos = $this->validate();

        // Almacenar la CV para saber en que lugar del disco quedo almacenada
        $cv = $this->cv->store('public/cv');
        $datos['cv'] = str_replace('public/cv/','',$cv); //funcion de php

        // Crear el canditado a la vacante
        $this->vacante->candidatos()->create([
            'user_id' => auth()->user()->id,
            'cv' => $datos['cv']
        ]);

        // Crear notificacion y enviar email
        $this->vacante->reclutador->notify(new NuevoCandidato($this->vacante->id, $this->vacante->titulo,auth()->user()->id));

        // Mostrar al usuario de que se creo correctamente
        session()->flash('mensaje', 'Se envió correctamente tu información, mucha suerte');
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.postular-vacante');
    }
}
