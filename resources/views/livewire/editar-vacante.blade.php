<form class="md:w-1/2 space-y-5" wire:submit.prevent='editarVacante'>

    <div>
        <x-input-label for="titulo" :value="__('Titulo Vacante')" />
        <x-text-input 
            id="titulo" 
            class="block mt-1 w-full"
            type="text" 
            wire:model="titulo" 
            :value="old('titulo')"
            placeholder="Titulo Vacante" />

            @error('titulo')
                <livewire:mostrar-alerta :message="$message" />
            @enderror
        
    </div><!-- titulo -->

    <div>
        <x-input-label 
            
            for="salario" 
            :value="__('Salario Mensual')" />

        <select 
            wire:model="salario" 
            id="salario" 
            class="border-teal-600 focus:border-teal-500
            focus:ring-teal-500 rounded-md focus:ring-opacity-50 shadow-sm w-full">
            <option> -- Seleccione --</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id}}">{{ $salario->salario }}</option>
            @endforeach
        </select>

        @error('salario')
            <livewire:mostrar-alerta :message="$message" />
        @enderror

    </div><!-- salario -->

    <div>
        <x-input-label 
            
            for="categoria" 
            :value="__('Categoria')" />

        <select 
            wire:model="categoria" 
            id="categoria" 
            class="border-teal-600 focus:border-teal-500
            focus:ring-teal-500 rounded-md focus:ring-opacity-50 shadow-sm w-full">
            <option> -- Seleccione --</option>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id}}">{{ $categoria->categoria }}</option>
            @endforeach
        </select>

        @error('categoria')
            <livewire:mostrar-alerta :message="$message" />
        @enderror

    </div><!-- categoria -->

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input 
            id="empresa" 
            class="block mt-1 w-full"
            type="text" 
            wire:model="empresa" 
            :value="old('empresa')"
            placeholder="Empresa: ej. Netflix, Uber, Shopify" />
        
            @error('empresa')
                <livewire:mostrar-alerta :message="$message" />
            @enderror
    </div><!-- empresa -->

    <div>
        <x-input-label for="ultimo_dia" :value="__('Último día para postularse')" />
        <x-text-input 
            id="ultimo_dia" 
            class="block mt-1 w-full"
            type="date" 
            wire:model="ultimo_dia" 
            :value="old('ultimo_dia')"/>

            @error('ultimo_dia')
                <livewire:mostrar-alerta :message="$message" />
            @enderror
        
    </div><!-- ultimo_dia -->

    <div>
        <x-input-label for="descripcion" :value="__('Descripción Puesto')" />
        <textarea 
            wire:model="descripcion" 
            placeholder="Descripción general del puesto, experiencia"
            class="border-teal-600 focus:border-teal-500
        focus:ring-teal-500 rounded-md focus:ring-opacity-50 shadow-sm w-full h-72"></textarea>

        @error('descripcion')
            <livewire:mostrar-alerta :message="$message" />
        @enderror

    </div><!-- descripcion -->

    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input 
            id="imagen" 
            class="block mt-1 w-full"
            type="file" 
            wire:model="imagen_nueva"
            accept="image/*"/>

            <div class="my-5 w-80">
                <x-input-label :value="__('Imagen Actual')" />

                <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Imagen Vaante' . $titulo }}">
            </div>

            <!-- Pre view de imagen del componente de editar imagen -->

            <div class="my-5 w-80">
                @if ($imagen_nueva)
                    Imagen Nueva:
                    <img src="{{ $imagen_nueva->temporaryUrl() }}" alt="Imagen previsualizada">
                @endif
            </div>

            @error('imagen_nueva')
                <livewire:mostrar-alerta :message="$message" />
            @enderror
        
    </div><!-- imagen -->

    <x-primary-button>
        {{ __('Guardar Cambios') }}
    </x-primary-button>

</form>