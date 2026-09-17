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
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <form method="POST" action="{{ route('trabajador.disponibilidad.guardar') }}" id="formDisponibilidad">
                    @csrf

                    <h3 class="text-base font-semibold text-gray-700 mb-1">Selecciona tus días disponibles</h3>
                    <p class="text-sm text-gray-400 mb-6">Puedes marcar los próximos 15 días. Haz clic en cada día para marcarlo.</p>

                    <!-- Calendario interactivo -->
                    <div class="border border-gray-200 rounded-xl overflow-hidden mb-6">
                        <div class="bg-gray-50 px-4 py-3 flex items-center justify-between border-b border-gray-200">
                            <h4 class="text-sm font-semibold text-gray-700" id="mesActual"></h4>
                            <div class="flex space-x-1">
                                <button type="button" onclick="cambiarMes(-1)"
                                        class="p-1.5 rounded hover:bg-gray-200 transition">
                                    <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button type="button" onclick="cambiarMes(1)"
                                        class="p-1.5 rounded hover:bg-gray-200 transition">
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

                    <!-- Fechas seleccionadas -->
                    <div class="mb-6">
                        <p class="text-sm font-medium text-gray-700 mb-2">Días seleccionados:</p>
                        <div id="fechasSeleccionadas" class="flex flex-wrap gap-2 min-h-8">
                            <p class="text-sm text-gray-400" id="sinFechas">Ningún día seleccionado</p>
                        </div>
                    </div>

                    <!-- Input hidden para enviar fechas -->
                    <div id="inputsFechas"></div>

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
        const fechasGuardadas = @json($fechasDisponibles);
        const hoy = new Date();
        hoy.setHours(0, 0, 0, 0);
        const limite = new Date(hoy);
        limite.setDate(limite.getDate() + 15);

        const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        const mesesCortos = ['ene','feb','mar','abr','may','jun','jul','ago','sep','oct','nov','dic'];
        const diasSemana = ['dom','lun','mar','mié','jue','vie','sáb'];

        let fechaActual = new Date(hoy);
        let fechasSeleccionadas = new Set(fechasGuardadas);

        function formatFecha(date) {
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        function formatFechaLegible(fechaStr) {
            const parts = fechaStr.split('-');
            const date = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));
            return `${diasSemana[date.getDay()]} ${date.getDate()} ${mesesCortos[date.getMonth()]}`;
        }

        function toggleFecha(fechaStr, celda) {
            const fecha = new Date(fechaStr + 'T00:00:00');
            if (fecha < hoy || fecha > limite) return;

            if (fechasSeleccionadas.has(fechaStr)) {
                fechasSeleccionadas.delete(fechaStr);
                celda.classList.remove('bg-orange-50');
                celda.querySelector('.dia-num').classList.remove('bg-orange-500', 'text-white');
                celda.querySelector('.dia-num').classList.add('text-gray-600');
                celda.querySelector('.dia-label').textContent = '-';
                celda.querySelector('.dia-label').classList.remove('text-orange-500');
                celda.querySelector('.dia-label').classList.add('text-gray-200');
            } else {
                fechasSeleccionadas.add(fechaStr);
                celda.classList.add('bg-orange-50');
                celda.querySelector('.dia-num').classList.add('bg-orange-500', 'text-white');
                celda.querySelector('.dia-num').classList.remove('text-gray-600');
                celda.querySelector('.dia-label').textContent = 'Disp.';
                celda.querySelector('.dia-label').classList.add('text-orange-500');
                celda.querySelector('.dia-label').classList.remove('text-gray-200');
            }

            actualizarFechasSeleccionadas();
        }

        function actualizarFechasSeleccionadas() {
            const contenedor = document.getElementById('fechasSeleccionadas');
            const inputsContenedor = document.getElementById('inputsFechas');
            const sinFechas = document.getElementById('sinFechas');

            const fechasOrdenadas = Array.from(fechasSeleccionadas).sort();

            if (fechasOrdenadas.length === 0) {
                contenedor.innerHTML = '<p class="text-sm text-gray-400" id="sinFechas">Ningún día seleccionado</p>';
                inputsContenedor.innerHTML = '';
                return;
            }

            sinFechas && sinFechas.remove();
            contenedor.innerHTML = '';
            inputsContenedor.innerHTML = '';

            fechasOrdenadas.forEach(fecha => {
                const tag = document.createElement('span');
                tag.className = 'inline-flex items-center space-x-1 bg-orange-50 border border-orange-200 text-orange-700 text-xs font-medium px-3 py-1.5 rounded-full cursor-pointer hover:bg-orange-100';
                tag.innerHTML = `
                    <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>${formatFechaLegible(fecha)}</span>
                `;
                contenedor.appendChild(tag);

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'fechas[]';
                input.value = fecha;
                inputsContenedor.appendChild(input);
            });
        }

        function cambiarMes(delta) {
            fechaActual.setMonth(fechaActual.getMonth() + delta);
            renderCalendario();
        }

        function renderCalendario() {
            const año = fechaActual.getFullYear();
            const mes = fechaActual.getMonth();

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
                const disponible = fechasSeleccionadas.has(fechaStr);
                const esHoy = fecha.toDateString() === hoy.toDateString();
                const esPasado = fecha < hoy;
                const esFuturoLejano = fecha > limite;
                const esSeleccionable = !esPasado && !esFuturoLejano;

                const celda = document.createElement('div');
                celda.className = `py-3 border-r border-b border-gray-100 text-center transition-all
                    ${disponible ? 'bg-orange-50' : 'bg-white'}
                    ${esHoy ? 'ring-2 ring-inset ring-orange-400' : ''}
                    ${esSeleccionable ? 'cursor-pointer hover:bg-orange-50' : 'opacity-40 cursor-not-allowed'}`;

                celda.innerHTML = `
                    <span class="dia-num inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium
                        ${disponible ? 'bg-orange-500 text-white' : esHoy ? 'text-orange-600 font-bold' : 'text-gray-600'}">
                        ${dia}
                    </span>
                    <p class="dia-label text-xs mt-1 ${disponible ? 'text-orange-500' : 'text-gray-200'}">
                        ${disponible ? 'Disp.' : '-'}
                    </p>
                `;

                if (esSeleccionable) {
                    celda.addEventListener('click', () => toggleFecha(fechaStr, celda));
                }

                contenedor.appendChild(celda);
            }
        }

        renderCalendario();
        actualizarFechasSeleccionadas();
    </script>
</x-app-layout>