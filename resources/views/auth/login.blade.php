<x-guest-layout>
    <x-authentication-card>
        <!-- Header con logo y título -->
        <div class="mb-8 text-center">
            <!-- Puedes agregar un logo aquí -->
            <img src="{{ asset('img/clinica-amateus-logo.svg') }}" alt="Clínica Amateus Logo" class="mx-auto h-16 w-auto mb-4">
            <h1 class="text-3xl font-bold text-gray-800">
                Clínica Amateus
            </h1>
            <p class="mt-2 text-gray-600">Portal de Acceso</p>
        </div>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-700">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <x-label for="email" value="{{ __('Email') }}" class="text-gray-700 font-semibold" />
                <x-input id="email"
                         class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                         type="email"
                         name="email"
                         :value="old('email')"
                         required
                         autofocus
                         autocomplete="username" />
            </div>

            <!-- Contraseña -->
            <div>
                <x-label for="password" value="{{ __('Password') }}" class="text-gray-700 font-semibold" />
                <x-input id="password"
                         class="block mt-2 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                         type="password"
                         name="password"
                         required
                         autocomplete="current-password" />
            </div>

            <!-- Recordar sesión -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="rounded text-blue-600" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-600 hover:text-blue-800 font-medium"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <!-- Botón de login -->
            <div>
                <x-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 py-3 transition-colors">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <!-- Enlace para registrarse -->
        <div class="mt-4 text-center text-sm text-gray-600">
            ¿No tienes una cuenta?
            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                Regístrate aquí
            </a>
        </div>

        <!-- Footer opcional -->
        <div class="mt-8 text-center text-sm text-gray-600">
            ¿Necesita ayuda? Contacte con soporte técnico
        </div>
    </x-authentication-card>
</x-guest-layout>
