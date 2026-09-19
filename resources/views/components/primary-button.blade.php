<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-lift inline-flex w-full items-center justify-center gap-2 rounded-xl bg-brand-red px-6 py-3 text-sm font-semibold text-white shadow-lg transition-colors hover:bg-brand-red-dark focus:outline-none focus:ring-2 focus:ring-brand-red/30 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>
