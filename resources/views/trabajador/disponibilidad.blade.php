<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mi Disponibilidad</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Días de la semana -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <form method="POST" action="{{ route('trabajador.disponibilidad.guardar') }}" id="formDisponibilidad">
                    @csrf

                    <h3 class="text-base font-semibold text-gray-700 mb-1">Días disponibles</h3>
                    <p class="text-sm text-gray-400 mb-5">Selecciona los días de la semana en que puedes trabajar</p>

                    <div class="grid grid-cols-7 gap-2 mb-6">
                        @foreach([
                            'lunes' => 'L',
                            'martes' => 'M',
                            'miercoles' => 'X',
                            'jueves' => 'J',
                            'viernes' => 'V',
                            'sabado' => 'S',
                            'domingo' => 'D'
                        ] as $dia => $letra)
                            @php $checked = $disponibilidad && $disponibilidad->$dia; @endphp
                            <div class="text-center">
                                <p class="text-xs font-semibold text-gray-400 mb-1">{{ $letra }}</p>
                                <button type="button"
                                        onclick="toggleDia('{{ $dia }}', this)"
                                        class="w-full py-3 rounded-lg text-xs font-semibold border-2 transition-all duration-200
                                               {{ $checked
                                                  ? 'bg-orange-500 border-orange-500 text-white'
                                                  : 'bg-white border-gray-200 text-gray-500 hover:border-orange-300 hover:text-orange-500' }}">
                                    {{ strtoupper(substr($dia, 0, 3)) }}
                                </button>
                                <input type="checkbox"
                                       name="{{ $dia }}"
                                       id="check_{{ $dia }}"
                                       value="1"
                                       {{ $checked ? 'checked' : '' }}
                                       class="hidden">
                            </div>
                        @endforeach
                    </div>

                    <!-- Calendario del mes -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden mb-6">
                        <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-b border-gray-200">
                            <h4 class="text-sm font-semibold text-gray-700" id="mesActual"></h4>
                            <div class="flex space-x-2">
                                <button type="button" onclick="cambiarMes(-1)"
                                        class="p-1 rounded hover:bg-gray-200 transition">
                                    <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button type="button" onclick="cambiarMes(1)"
                                        class="p-1 rounded hover:bg-gray-200 transition">
                                    <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Cabeceras días -->
                        <div class="grid grid-cols-7 bg-gray-50 border-b border-gray-200">
                            @foreach(['Lun','Mar','Mié','Jue','Vie','Sáb','Dom'] as $cab)
                                <div class="text-center py-2 text-xs font-semibold text-gray-500">{{ $cab }}</div>
                            @endforeach
                        </div>

                        <!-- Días del mes -->
                        <div class="grid grid-cols-7" id="diasCalendario"></div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Descripción adicional
                            <span class="text-gray-400 font-normal">(opcional)</span>
                        </label>
                        <textarea name="descripcion"
                                  rows="3"
                                  maxlength="500"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition"
                                  placeholder="Ej: Tengo experiencia en quema de ladrillo, disponible para turnos largos...">{{ $disponibilidad->descripcion ?? '' }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Máximo 500 caracteres</p>
                    </div>

                    <div class="flex items-center space-x-3">
                        <button type="submit"
                                class="inline-flex items-center space-x-2 bg-orange-600 text-white px-5 py-2.5 rounded-lg hover:bg-orange-700 transition font-medium text-sm">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Guardar disponibilidad</span>
                        </button>
                        <a href="{{ route('trabajador.index') }}"
                           class="inline-flex items-center space-x-2 bg-gray-100 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-200 transition font-medium text-sm">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span>Cancelar</span>
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        const diasDisponibles = {
            lunes: {{ ($disponibilidad && $disponibilidad->lunes) ? 'true' : 'false' }},
            martes: {{ ($disponibilidad && $disponibilidad->martes) ? 'true' : 'false' }},
            miercoles: {{ ($disponibilidad && $disponibilidad->miercoles) ? 'true' : 'false' }},
            jueves: {{ ($disponibilidad && $disponibilidad->jueves) ? 'true' : 'false' }},
            viernes: {{ ($disponibilidad && $disponibilidad->viernes) ? 'true' : 'false' }},
            sabado: {{ ($disponibilidad && $disponibilidad->sabado) ? 'true' : 'false' }},
            domingo: {{ ($disponibilidad && $disponibilidad->domingo) ? 'true' : 'false' }},
        };

        const mapaDias = ['domingo','lunes','martes','miercoles','jueves','viernes','sabado'];
        const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];

        let fechaActual = new Date();

        function toggleDia(dia, btn) {
            const checkbox = document.getElementById('check_' + dia);
            const activo = checkbox.checked;

            if (activo) {
                checkbox.checked = false;
                diasDisponibles[dia] = false;
                btn.classList.remove('bg-orange-500', 'border-orange-500', 'text-white');
                btn.classList.add('bg-white', 'border-gray-200', 'text-gray-500', 'hover:border-orange-300', 'hover:text-orange-500');
            } else {
                checkbox.checked = true;
                diasDisponibles[dia] = true;
                btn.classList.remove('bg-white', 'border-gray-200', 'text-gray-500', 'hover:border-orange-300', 'hover:text-orange-500');
                btn.classList.add('bg-orange-500', 'border-orange-500', 'text-white');
            }
            renderCalendario();
        }

        function cambiarMes(delta) {
            fechaActual.setMonth(fechaActual.getMonth() + delta);
            renderCalendario();
        }

        function renderCalendario() {
            const año = fechaActual.getFullYear();
            const mes = fechaActual.getMonth();
            const hoy = new Date();

            document.getElementById('mesActual').textContent = meses[mes] + ' ' + año;

            const primerDia = new Date(año, mes, 1);
            const ultimoDia = new Date(año, mes + 1, 0);

            // Ajustar para que semana empiece en lunes
            let inicioSemana = primerDia.getDay();
            inicioSemana = inicioSemana === 0 ? 6 : inicioSemana - 1;

            const contenedor = document.getElementById('diasCalendario');
            contenedor.innerHTML = '';

            // Celdas vacías al inicio
            for (let i = 0; i < inicioSemana; i++) {
                const celda = document.createElement('div');
                celda.className = 'py-3 border-r border-b border-gray-100 bg-gray-50';
                contenedor.appendChild(celda);
            }

            // Días del mes
            for (let dia = 1; dia <= ultimoDia.getDate(); dia++) {
                const fecha = new Date(año, mes, dia);
                const diaSemana = mapaDias[fecha.getDay()];
                const disponible = diasDisponibles[diaSemana];
                const esHoy = fecha.toDateString() === hoy.toDateString();

                const celda = document.createElement('div');
                celda.className = `py-3 border-r border-b border-gray-100 text-center text-sm transition-all
                    ${disponible ? 'bg-orange-50' : 'bg-white'}
                    ${esHoy ? 'ring-2 ring-inset ring-orange-400' : ''}`;

                celda.innerHTML = `
                    <span class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium
                        ${disponible ? 'bg-orange-500 text-white' : esHoy ? 'text-orange-600 font-bold' : 'text-gray-600'}">
                        ${dia}
                    </span>
                    ${disponible ? '<p class="text-xs text-orange-500 mt-1">Disp.</p>' : '<p class="text-xs text-gray-300 mt-1">-</p>'}
                `;

                contenedor.appendChild(celda);
            }
        }

        renderCalendario();
    </script>
</x-app-layout>