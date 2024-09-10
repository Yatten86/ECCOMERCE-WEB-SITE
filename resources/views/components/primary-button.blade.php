<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primary bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 w-full transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>