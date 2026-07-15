<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-green-600 border border-transparent rounded-full font-bold text-sm text-white tracking-widest hover:bg-green-700 hover:shadow-lg focus:bg-green-700 active:bg-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transform transition-all duration-200 hover:-translate-y-0.5']) }}>
    {{ $slot }}
</button>
