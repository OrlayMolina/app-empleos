<div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($vacantes as $vacante)

                
            <div class="p-6 bg-white border-b border-gray-200 md:flex md:justify-between md:items-center">
                <div class="space-y-3"><!-- tambien puede ser leading-10 -->
                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500">Último día: {{ $vacante->ultimo_dia }}</p>
                </div>

                <div class="flex flex-col md:flex-row items-stretch gap-3 mt-5 md:mt-0">
                    <a 
                        href="{{ route('candidatos.index',$vacante) }}"
                        class="bg-slate-800 py-2 px-4 rounded-lg text-white text-sm font-bold uppercase text-center">{{ $vacante->candidatos->count() }} Canditatos
                    </a>

                    <a 
                        href="{{ route('vacantes.edit', $vacante->id) }}"
                        class="bg-blue-800 py-2 px-4 rounded-lg text-white text-sm font-bold uppercase text-center">Editar
                    </a>

                    <button 
                        wire:click="$emit('mostrarAlerta', {{ $vacante->id }})"
                        class="bg-red-600 py-2 px-4 rounded-lg text-white text-sm font-bold uppercase text-center">Eliminar
                    </button>
                </div>

            </div><!-- cierre de este div -->    

        @empty
        
            <p class="p-3 text-center text-xl text-gray-600">No hay vacantes para mostrar</p>

        @endforelse
        
    </div>

    <div class="mt-10">
        {{ $vacantes->links() }}
    </div>
</div>

@push('scripts') <!-- Coloco la zona que deseo utilizar, si scripts o styles -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        Livewire.on('mostrarAlerta', vacanteId => {
            
                Swal.fire({
                    title: '¿Estás seguro que deseas eliminar la vacante?',
                    text: "Una vacante eliminada no se puede recuperar",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, ¡Eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                if (result.isConfirmed) {
                    // Eliminar la vacante
                    Livewire.emit('eliminarVacante', vacanteId)
                    Swal.fire(
                        'Se eliminó la Vacante',
                        'Eliminado Correctamente',
                        'success'
                    )
                }
                })
        });

        

    </script>
    
@endpush