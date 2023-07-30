@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm text-teal-700 font-bold 
    uppercase mb-2 w-full']) }}>
    {{ $value ?? $slot }}
</label>
