<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <svg class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Medición de Rendimiento</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <x-admin-nav />

            <p class="text-gray-500 -mt-2">Sistema Web Sector Ladrillero — Consultas con índices optimizados</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($resultados as $key => $resultado)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-semibold text-gray-700 mb-3">{{ $resultado['descripcion'] }}</h3>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-500 text-sm">Tiempo de respuesta:</span>
                            <span class="font-bold text-lg {{ $resultado['tiempo_ms'] < 10 ? 'text-green-600' : ($resultado['tiempo_ms'] < 50 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ $resultado['tiempo_ms'] }} ms
                            </span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-sm">Registros encontrados:</span>
                            <span class="font-semibold text-blue-600">{{ $resultado['resultados'] }}</span>
                        </div>
                        <div class="mt-3 pt-3 border-t border-gray-100">
                            @php
                                $estado = $resultado['tiempo_ms'] < 10 ? 'optimo' : ($resultado['tiempo_ms'] < 50 ? 'aceptable' : 'lento');
                                $estilos = [
                                    'optimo' => 'bg-green-100 text-green-700',
                                    'aceptable' => 'bg-yellow-100 text-yellow-700',
                                    'lento' => 'bg-red-100 text-red-700',
                                ];
                                $etiquetas = [
                                    'optimo' => 'Óptimo',
                                    'aceptable' => 'Aceptable',
                                    'lento' => 'Lento',
                                ];
                            @endphp
                            <span class="inline-flex items-center space-x-1 text-xs px-2 py-1 rounded {{ $estilos[$estado] }}">
                                @if($estado === 'optimo')
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                @elseif($estado === 'aceptable')
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                @else
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                @endif
                                <span>{{ $etiquetas[$estado] }}</span>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <h3 class="font-semibold text-blue-800 mb-2">Índices aplicados</h3>
                <ul class="text-blue-700 text-sm space-y-1.5">
                    <li class="flex items-start space-x-2">
                        <svg class="h-4 w-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span><strong>idx_users_role</strong> — Acelera búsqueda de trabajadores por rol</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <svg class="h-4 w-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span><strong>idx_users_email</strong> — Acelera autenticación por correo</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <svg class="h-4 w-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span><strong>idx_users_empleador</strong> — Acelera filtro de empleadores</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <svg class="h-4 w-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span><strong>idx_disp_user_id</strong> — Acelera relación usuario-disponibilidad</span>
                    </li>
                    <li class="flex items-start space-x-2">
                        <svg class="h-4 w-4 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span><strong>idx_disp_dias</strong> — Acelera búsqueda por días disponibles</span>
                    </li>
                </ul>
            </div>

            <div class="text-center">
                <a href="{{ route('admin.index') }}"
                   class="inline-flex items-center space-x-2 bg-gray-700 text-white px-5 py-2.5 rounded-lg hover:bg-gray-800 transition font-medium text-sm">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span>Volver al panel admin</span>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>