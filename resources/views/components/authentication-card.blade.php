<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-cyan-50 via-blue-50 to-purple-50">
    <div class="text-center mb-8">

        <p class="mt-2 text-gray-600">Accede a tu cuenta</p>
    </div>

    <div class="w-full sm:max-w-md px-8 py-10 bg-white backdrop-blur-sm bg-opacity-95 shadow-[0_20px_50px_rgba(8,_112,_184,_0.2)] rounded-3xl border border-gray-100 hover:shadow-[0_20px_60px_rgba(8,_112,_184,_0.3)] transition-all duration-300">
        {{ $slot }}
    </div>

    <!-- Footer opcional -->
    <div class="mt-8 text-center text-sm text-gray-600">
        © 2024 Clínica Amateus. Todos los derechos reservados
    </div>
</div>
