@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm bg-green-600 py-3 px-4 text-white text-center rounded']) }}>
        {{ $status }}
    </div>
@endif