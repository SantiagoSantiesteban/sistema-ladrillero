<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel del Trabajador</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="flex items-center space-x-2 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Bienvenida -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-orange-100 rounded-full p-3">
                        <svg class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Bienvenido, {{ Auth::user()->name }}</h3>
                        <p class="text-gray-500 text-sm">Gestiona tu disponibilidad laboral para los próximos 15 días.</p>
                    </div>
                </div>
                @if(Auth::user()->telefono)
                    <div class="mt-4 flex items-center space-x-2 text-sm text-gray-600">
                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>{{ Auth::user()->telefono }}</span>
                    </div>
                @endif
            </div>

            <!-- Disponibilidad -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Mi Disponibilidad</h3>
                    </div>
                    <span class="text-xs text-gray-400">Próximos 15 días</span>
                </div>

                @if(count($fechasDisponibles) > 0)
                    <div class="mb-4">
                        <p class="text-sm text-gray-500 mb-3">Días marcados como disponible:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($fechasDisponibles as $fecha)
                                <span class="inline-flex items-center space-x-1 bg-orange-50 border border-orange-200 text-orange-700 text-xs font-medium px-3 py-1.5 rounded-full">
                                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($fecha)->locale('es')->isoFormat('ddd D MMM') }}</span>
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Calendario vista -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden mb-5">
                        <div class="bg-gray-50 px-4 py-2 flex items-center justify-between border-b border-gray-200">
                            <h4 class="text-sm font-semibold text-gray-700" id="mesActual"></h4>
                            <div class="flex space-x-1">
                                <button type="button" onclick="cambiarMes(-1)" class="p-1 rounded hover:bg-gray-200 transition">
                                    <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button type="button" onclick="cambiarMes(1)" class="p-1 rounded hover:bg-gray-200 transition">
                                    <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-7 bg-gray-50 border-b border-gray-200">
                            @foreach(['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'] as $cab)
                                <div class="text-center py-2 text-xs font-semibold text-gray-500">{{ $cab }}</div>
                            @endforeach
                        </div>
                        <div class="grid grid-cols-7" id="diasCalendario"></div>
                    </div>
                @else
                    <div class="flex items-center space-x-3 bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-5">
                        <svg class="h-5 w-5 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <p class="text-yellow-700 text-sm">Aún no has registrado tu disponibilidad. Los empleadores no podrán encontrarte.</p>
                    </div>
                @endif

                <a href="{{ route('trabajador.disponibilidad') }}"
                   class="inline-flex items-center space-x-2 bg-orange-600 text-white px-5 py-2.5 rounded-lg hover:bg-orange-700 transition font-medium text-sm">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>{{ count($fechasDisponibles) > 0 ? 'Editar disponibilidad' : 'Registrar disponibilidad' }}</span>
                </a>
            </div>

        </div>
    </div>

    @if(count($fechasDisponibles) > 0)
    <script>
        const fechasDisponibles = @json($fechasDisponibles);
        const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        let fechaActual = new Date();

        function cambiarMes(delta) {
            fechaActual.setMonth(fechaActual.getMonth() + delta);
            renderCalendario();
        }

        function formatFecha(date) {
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        function renderCalendario() {
            const año = fechaActual.getFullYear();
            const mes = fechaActual.getMonth();
            const hoy = new Date();

            document.getElementById('mesActual').textContent = meses[mes] + ' ' + año;

            const primerDia = new Date(año, mes, 1);
            const ultimoDia = new Date(año, mes + 1, 0);

            let inicioSemana = primerDia.getDay();
            inicioSemana = inicioSemana === 0 ? 6 : inicioSemana - 1;

            const contenedor = document.getElementById('diasCalendario');
            contenedor.innerHTML = '';

            for (let i = 0; i < inicioSemana; i++) {
                const celda = document.createElement('div');
                celda.className = 'py-3 border-r border-b border-gray-100 bg-gray-50';
                contenedor.appendChild(celda);
            }

            for (let dia = 1; dia <= ultimoDia.getDate(); dia++) {
                const fecha = new Date(año, mes, dia);
                const fechaStr = formatFecha(fecha);
                const disponible = fechasDisponibles.includes(fechaStr);
                const esHoy = fecha.toDateString() === hoy.toDateString();

                const celda = document.createElement('div');
                celda.className = `py-3 border-r border-b border-gray-100 text-center
                    ${disponible ? 'bg-orange-50' : 'bg-white'}
                    ${esHoy ? 'ring-2 ring-inset ring-orange-400' : ''}`;

                celda.innerHTML = `
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium
                        ${disponible ? 'bg-orange-500 text-white' : esHoy ? 'text-orange-600 font-bold' : 'text-gray-500'}">
                        ${dia}
                    </span>
                    ${disponible ? '<p class="text-xs text-orange-500 mt-1">Disp.</p>' : '<p class="text-xs text-gray-200 mt-1">-</p>'}
                `;

                contenedor.appendChild(celda);
            }
        }

        renderCalendario();
    </script>
    @endif

</x-app-layout>