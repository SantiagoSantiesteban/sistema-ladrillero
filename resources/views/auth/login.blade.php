<x-guest-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-md mb-6 text-center">
        <!-- Logo / Icono LadrilloWeb -->
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-orange-600 text-white shadow-lg shadow-orange-500/30 mb-4">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 10V11m-4 10V11m8 10V11" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 font-poppins">LadrilloWeb</h1>
        <p class="text-sm text-gray-600 font-inter mt-1">Gestión de Trabajadores — Patio Bonito</p>
    </div>

    <div class="bg-white py-8 px-6 shadow-xl shadow-gray-200/50 rounded-2xl border border-gray-100 sm:px-10">
        <h2 class="text-lg font-semibold text-gray-800 mb-6 font-poppins text-center">Iniciar Sesión</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1 font-inter">
                    Correo electrónico <span class="text-red-500">*</span>
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent transition duration-150"
                       placeholder="ejemplo@correo.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1 font-inter">
                    Contraseña <span class="text-red-500">*</span>
                </label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent transition duration-150"
                       placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between text-sm">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember" 
                           class="rounded border-gray-300 text-orange-600 shadow-xs focus:ring-orange-500">
                    <span class="ms-2 text-xs text-gray-600 font-inter">Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-xs text-orange-600 hover:text-orange-800 font-semibold font-inter transition" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <div>
                <button type="submit" 
                        class="w-full py-3 px-4 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-xl shadow-md shadow-orange-600/20 transition duration-150 font-inter focus:outline-none focus:ring-2 focus:ring-orange-600 focus:ring-offset-2">
                    Ingresar a la Plataforma
                </button>
            </div>
        </form>

        <div class="mt-6 border-t border-gray-100 pt-5 text-center">
            <p class="text-xs text-gray-600 font-inter">
                ¿Aún no tienes cuenta? 
                <a href="{{ route('register') }}" class="text-orange-600 font-bold hover:underline">Regístrate aquí</a>
            </p>
        </div>
    </div>
</x-guest-layout>