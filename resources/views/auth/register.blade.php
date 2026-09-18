<x-guest-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-md mb-6 text-center">
        <!-- Logo / Icono LadrilloWeb -->
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-orange-600 text-white shadow-lg shadow-orange-500/30 mb-4">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 10V11m-4 10V11m8 10V11" />
            </svg>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 font-poppins">Crear Cuenta</h1>
        <p class="text-sm text-gray-600 font-inter mt-1">Únete a la plataforma del sector ladrillero de Patio Bonito</p>
    </div>

    <div class="bg-white py-8 px-6 shadow-xl shadow-gray-200/50 rounded-2xl border border-gray-100 sm:px-10">
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1 font-inter">
                    Nombre completo <span class="text-red-500">*</span>
                </label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent transition duration-150"
                       placeholder="Ej: Juan Pérez">
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-1 font-inter">
                    Correo electrónico <span class="text-red-500">*</span>
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent transition duration-150"
                       placeholder="ejemplo@correo.com">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1 font-inter">
                    Teléfono de contacto
                </label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent transition duration-150"
                       placeholder="Ej: 3001234567">
                <x-input-error :messages="$errors->get('phone')" class="mt-1" />
            </div>

            <!-- Role Selection -->
            <div>
                <label for="rol" class="block text-sm font-semibold text-gray-700 mb-1 font-inter">
                    ¿Cómo deseas registrarte? <span class="text-red-500">*</span>
                </label>
                <select id="rol" name="rol" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent transition duration-150">
                    <option value="trabajador" {{ old('rol') == 'trabajador' ? 'selected' : '' }}>Soy trabajador</option>
                    <option value="empleador" {{ old('rol') == 'empleador' ? 'selected' : '' }}>Soy empleador</option>
                    <option value="dual" {{ old('rol') == 'dual' ? 'selected' : '' }}>Soy trabajador y empleador</option>
                </select>
                <x-input-error :messages="$errors->get('rol')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-1 font-inter">
                    Contraseña <span class="text-red-500">*</span>
                </label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent transition duration-150"
                       placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1 font-inter">
                    Confirmar contraseña <span class="text-red-500">*</span>
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full px-4 py-2.5 rounded-xl border border-gray-300 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-orange-600 focus:border-transparent transition duration-150"
                       placeholder="••••••••">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <div class="pt-2">
                <button type="submit" 
                        class="w-full py-3 px-4 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-xl shadow-md shadow-orange-600/20 transition duration-150 font-inter focus:outline-none focus:ring-2 focus:ring-orange-600 focus:ring-offset-2">
                    Registrarse
                </button>
            </div>
        </form>

        <div class="mt-5 border-t border-gray-100 pt-4 text-center">
            <p class="text-xs text-gray-600 font-inter">
                ¿Ya tienes una cuenta? 
                <a href="{{ route('login') }}" class="text-orange-600 font-bold hover:underline">Inicia sesión</a>
            </p>
        </div>
    </div>
</x-guest-layout>