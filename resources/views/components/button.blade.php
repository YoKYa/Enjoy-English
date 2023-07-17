<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text uppercase tracking-widest hover:bg-biru-2 bg-biru-3 focus:outline-none focus:ring-2 text-whi focus:ring-offset-2transition text-white ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
