@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm mt-3 list-none space-y-2']) }}>
        @foreach ((array) $messages as $message)
            <li class="bg-red-200 border-l4 border-red-600 text-red-700 font-bold p-3">{{ $message }}</li>
        @endforeach
    </ul>
@endif
