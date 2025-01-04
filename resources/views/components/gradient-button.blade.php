<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full justify-center bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 py-3 transition-all duration-300 text-black font-semibold shadow-md hover:shadow-lg inline-flex items-center rounded-md']) }}>
    {{ $slot }}
</button>
