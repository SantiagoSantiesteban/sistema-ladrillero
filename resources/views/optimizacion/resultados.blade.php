<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optimización de Consultas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 p-8">

    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Medición de Rendimiento</h1>
        <p class="text-gray-500 mb-8">Sistema Web Sector Ladrillero — Consultas con índices optimizados</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($resultados as $key => $resultado)
                <div class="bg-white rounded-lg shadow p-6">
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
                    <div class="mt-3 pt-3 border-t">
                        <span class="text-xs px-2 py-1 rounded {{ $resultado['tiempo_ms'] < 10 ? 'bg-green-100 text-green-700' : ($resultado['tiempo_ms'] < 50 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                            {{ $resultado['tiempo_ms'] < 10 ? '✅ Óptimo' : ($resultado['tiempo_ms'] < 50 ? '⚠️ Aceptable' : '❌ Lento') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mt-8">
            <h3 class="font-semibold text-blue-800 mb-2">Índices aplicados</h3>
            <ul class="text-blue-700 text-sm space-y-1">
                <li>✅ idx_users_role — Acelera búsqueda de trabajadores por rol</li>
                <li>✅ idx_users_email — Acelera autenticación por correo</li>
                <li>✅ idx_users_empleador — Acelera filtro de empleadores</li>
                <li>✅ idx_disp_user_id — Acelera relación usuario-disponibilidad</li>
                <li>✅ idx_disp_dias — Acelera búsqueda por días disponibles</li>
            </ul>
        </div>

        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                Volver al inicio
            </a>
        </div>
    </div>

</body>
</html>