<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mis Vacantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Sí existe el mensaje al crear vacante -->
            @if (session()->has('mensaje'))
                <div class="uppercase border border-green-600 bg-green-200 text-green-600
                    font-bold p-2 my-3 text-sm"><!-- text-sm para cambiar el tamaño -->
                    {{ session('mensaje')}}
                </div>
            @endif

            <livewire:mostrar-vacantes />

        </div>
    </div>
</x-app-layout>
