<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Buscar Trabajadores</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <h3 class="text-base font-semibold text-gray-700 mb-1">¿Cuándo necesitas trabajadores?</h3>
                <p class="text-sm text-gray-400 mb-6">Selecciona una fecha específica o un rango de fechas para encontrar trabajadores disponibles.</p>

                <form method="GET" action="{{ route('empleador.buscar') }}">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha de inicio
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="date"
                                   name="fecha_inicio"
                                   id="fecha_inicio"
                                   min="{{ $hoy->format('Y-m-d') }}"
                                   max="{{ $limite->format('Y-m-d') }}"
                                   value="{{ old('fecha_inicio') }}"
                                   required
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                            <p class="text-xs text-gray-400 mt-1">Desde hoy hasta 15 días adelante</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Fecha de fin
                                <span class="text-gray-400 font-normal">(opcional)</span>
                            </label>
                            <input type="date"
                                   name="fecha_fin"
                                   id="fecha_fin"
                                   min="{{ $hoy->format('Y-m-d') }}"
                                   max="{{ $limite->format('Y-m-d') }}"
                                   value="{{ old('fecha_fin') }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                            <p class="text-xs text-gray-400 mt-1">Déjalo vacío para buscar un solo día</p>
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-4">
                            @foreach($errors->all() as $error)
                                <p class="text-sm text-red-600">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <button type="submit"
                            class="inline-flex items-center space-x-2 bg-orange-600 text-white px-5 py-2.5 rounded-lg hover:bg-orange-700 transition font-medium text-sm">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Buscar trabajadores</span>
                    </button>
                </form>
            </div>

            <!-- Información -->
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 mt-4">
                <div class="flex items-start space-x-3">
                    <svg class="h-5 w-5 text-blue-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-blue-700 mb-1">¿Cómo funciona la búsqueda?</p>
                        <p class="text-sm text-blue-600">Los trabajadores registran los días en que están disponibles para trabajar. Al buscar por fecha, el sistema te muestra únicamente quienes confirmaron disponibilidad para esos días específicos, con su información de contacto.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Cuando cambia fecha inicio, actualizar mínimo de fecha fin
        document.getElementById('fecha_inicio').addEventListener('change', function() {
            const fechaFin = document.getElementById('fecha_fin');
            fechaFin.min = this.value;
            if (fechaFin.value && fechaFin.value < this.value) {
                fechaFin.value = this.value;
            }
        });
    </script>
</x-app-layout>