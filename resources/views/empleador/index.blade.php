<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel del Empleador</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if($errors->any())
                <div class="flex items-start space-x-2 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <svg class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <ul class="text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Bienvenida -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-orange-100 rounded-full p-3">
                        <svg class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Bienvenido, {{ Auth::user()->name }}</h3>
                        <p class="text-gray-500 text-sm">Selecciona una fecha o un rango en el calendario para ver quién está disponible.</p>
                    </div>
                </div>
            </div>

            <!-- Buscador con calendario -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Buscar disponibilidad</h3>
                    </div>
                    <span class="text-xs text-gray-400">Haz clic en un día, o en dos para un rango</span>
                </div>

                <!-- Calendario -->
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

                <!-- Resumen de selección -->
                <div id="resumenSeleccion" class="hidden mb-4 flex items-center justify-between bg-orange-50 border border-orange-200 rounded-lg px-4 py-3">
                    <div class="flex items-center space-x-2 text-sm text-orange-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="textoSeleccion"></span>
                    </div>
                    <button type="button" onclick="limpiarSeleccion()" class="text-xs text-orange-600 hover:text-orange-800 font-medium">
                        Limpiar
                    </button>
                </div>

                <form action="{{ route('empleador.buscar') }}" method="GET" id="formBusqueda">
                    <input type="hidden" name="fecha_inicio" id="inputFechaInicio">
                    <input type="hidden" name="fecha_fin" id="inputFechaFin">
                    <button type="submit" id="btnBuscar" disabled
                        class="inline-flex items-center space-x-2 bg-orange-600 text-white px-5 py-2.5 rounded-lg hover:bg-orange-700 transition font-medium text-sm disabled:opacity-40 disabled:cursor-not-allowed">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <span>Buscar trabajadores</span>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        let fechaActual = new Date();
        let fechaInicioSel = null;
        let fechaFinSel = null;

        function formatFecha(date) {
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        function esPasado(fecha) {
            const hoy = new Date();
            hoy.setHours(0,0,0,0);
            return fecha < hoy;
        }

        function limpiarSeleccion() {
            fechaInicioSel = null;
            fechaFinSel = null;
            actualizarResumen();
            renderCalendario();
        }

        function seleccionarDia(fechaStr) {
            if (!fechaInicioSel) {
                fechaInicioSel = fechaStr;
                fechaFinSel = null;
            } else if (!fechaFinSel) {
                if (fechaStr === fechaInicioSel) {
                    fechaInicioSel = null;
                } else if (new Date(fechaStr + 'T00:00:00') < new Date(fechaInicioSel + 'T00:00:00')) {
                    fechaInicioSel = fechaStr;
                } else {
                    fechaFinSel = fechaStr;
                }
            } else {
                fechaInicioSel = fechaStr;
                fechaFinSel = null;
            }

            actualizarResumen();
            renderCalendario();
        }

        function actualizarResumen() {
            const resumen = document.getElementById('resumenSeleccion');
            const texto = document.getElementById('textoSeleccion');
            const btn = document.getElementById('btnBuscar');
            const inputInicio = document.getElementById('inputFechaInicio');
            const inputFin = document.getElementById('inputFechaFin');

            if (!fechaInicioSel) {
                resumen.classList.add('hidden');
                btn.disabled = true;
                inputInicio.value = '';
                inputFin.value = '';
                return;
            }

            const opciones = { weekday: 'short', day: 'numeric', month: 'short' };
            const inicioFmt = new Date(fechaInicioSel + 'T00:00:00').toLocaleDateString('es-ES', opciones);

            if (fechaFinSel) {
                const finFmt = new Date(fechaFinSel + 'T00:00:00').toLocaleDateString('es-ES', opciones);
                texto.textContent = `Rango: ${inicioFmt} → ${finFmt}`;
                inputInicio.value = fechaInicioSel;
                inputFin.value = fechaFinSel;
            } else {
                texto.textContent = `Fecha: ${inicioFmt}`;
                inputInicio.value = fechaInicioSel;
                inputFin.value = '';
            }

            resumen.classList.remove('hidden');
            btn.disabled = false;
        }

        function cambiarMes(delta) {
            fechaActual.setMonth(fechaActual.getMonth() + delta);
            renderCalendario();
        }

        function enRango(fechaStr) {
            if (!fechaInicioSel || !fechaFinSel) return false;
            return fechaStr > fechaInicioSel && fechaStr < fechaFinSel;
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
                const pasado = esPasado(fecha);
                const esHoy = fecha.toDateString() === hoy.toDateString();
                const esInicio = fechaStr === fechaInicioSel;
                const esFin = fechaStr === fechaFinSel;
                const dentroRango = enRango(fechaStr);

                const celda = document.createElement('div');
                let clases = 'py-3 border-r border-b border-gray-100 text-center';

                if (pasado) {
                    clases += ' bg-gray-50 cursor-not-allowed';
                } else {
                    clases += ' cursor-pointer hover:bg-orange-50 transition';
                }

                if (esInicio || esFin) clases += ' bg-orange-500';
                else if (dentroRango) clases += ' bg-orange-100';
                else if (!pasado) clases += ' bg-white';

                if (esHoy && !esInicio && !esFin) clases += ' ring-2 ring-inset ring-orange-400';

                celda.className = clases;

                let numeroClases = 'inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium';
                if (esInicio || esFin) numeroClases += ' bg-white text-orange-600 font-bold';
                else if (pasado) numeroClases += ' text-gray-300';
                else if (esHoy) numeroClases += ' text-orange-600 font-bold';
                else numeroClases += ' text-gray-600';

                celda.innerHTML = `<span class="${numeroClases}">${dia}</span>`;

                if (!pasado) {
                    celda.addEventListener('click', () => seleccionarDia(fechaStr));
                }

                contenedor.appendChild(celda);
            }
        }

        renderCalendario();
    </script>

</x-app-layout><x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel del Empleador</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if($errors->any())
                <div class="flex items-start space-x-2 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                    <svg class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <ul class="text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Bienvenida -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center space-x-4">
                    <div class="bg-orange-100 rounded-full p-3">
                        <svg class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Bienvenido, {{ Auth::user()->name }}</h3>
                        <p class="text-gray-500 text-sm">Selecciona una fecha o un rango en el calendario para ver quién está disponible.</p>
                    </div>
                </div>
            </div>

            <!-- Buscador con calendario -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-lg font-semibold text-gray-800">Buscar disponibilidad</h3>
                    </div>
                    <span class="text-xs text-gray-400">Haz clic en un día, o en dos para un rango</span>
                </div>

                <!-- Calendario -->
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

                <!-- Resumen de selección -->
                <div id="resumenSeleccion" class="hidden mb-4 flex items-center justify-between bg-orange-50 border border-orange-200 rounded-lg px-4 py-3">
                    <div class="flex items-center space-x-2 text-sm text-orange-700">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span id="textoSeleccion"></span>
                    </div>
                    <button type="button" onclick="limpiarSeleccion()" class="text-xs text-orange-600 hover:text-orange-800 font-medium">
                        Limpiar
                    </button>
                </div>

                <form action="{{ route('empleador.buscar') }}" method="GET" id="formBusqueda">
                    <input type="hidden" name="fecha_inicio" id="inputFechaInicio">
                    <input type="hidden" name="fecha_fin" id="inputFechaFin">
                    <button type="submit" id="btnBuscar" disabled
                        class="inline-flex items-center space-x-2 bg-orange-600 text-white px-5 py-2.5 rounded-lg hover:bg-orange-700 transition font-medium text-sm disabled:opacity-40 disabled:cursor-not-allowed">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                        <span>Buscar trabajadores</span>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        const meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        let fechaActual = new Date();
        let fechaInicioSel = null;
        let fechaFinSel = null;

        function formatFecha(date) {
            const y = date.getFullYear();
            const m = String(date.getMonth() + 1).padStart(2, '0');
            const d = String(date.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        function esPasado(fecha) {
            const hoy = new Date();
            hoy.setHours(0,0,0,0);
            return fecha < hoy;
        }

        function limpiarSeleccion() {
            fechaInicioSel = null;
            fechaFinSel = null;
            actualizarResumen();
            renderCalendario();
        }

        function seleccionarDia(fechaStr) {
            if (!fechaInicioSel) {
                fechaInicioSel = fechaStr;
                fechaFinSel = null;
            } else if (!fechaFinSel) {
                if (fechaStr === fechaInicioSel) {
                    fechaInicioSel = null;
                } else if (new Date(fechaStr + 'T00:00:00') < new Date(fechaInicioSel + 'T00:00:00')) {
                    fechaInicioSel = fechaStr;
                } else {
                    fechaFinSel = fechaStr;
                }
            } else {
                fechaInicioSel = fechaStr;
                fechaFinSel = null;
            }

            actualizarResumen();
            renderCalendario();
        }

        function actualizarResumen() {
            const resumen = document.getElementById('resumenSeleccion');
            const texto = document.getElementById('textoSeleccion');
            const btn = document.getElementById('btnBuscar');
            const inputInicio = document.getElementById('inputFechaInicio');
            const inputFin = document.getElementById('inputFechaFin');

            if (!fechaInicioSel) {
                resumen.classList.add('hidden');
                btn.disabled = true;
                inputInicio.value = '';
                inputFin.value = '';
                return;
            }

            const opciones = { weekday: 'short', day: 'numeric', month: 'short' };
            const inicioFmt = new Date(fechaInicioSel + 'T00:00:00').toLocaleDateString('es-ES', opciones);

            if (fechaFinSel) {
                const finFmt = new Date(fechaFinSel + 'T00:00:00').toLocaleDateString('es-ES', opciones);
                texto.textContent = `Rango: ${inicioFmt} → ${finFmt}`;
                inputInicio.value = fechaInicioSel;
                inputFin.value = fechaFinSel;
            } else {
                texto.textContent = `Fecha: ${inicioFmt}`;
                inputInicio.value = fechaInicioSel;
                inputFin.value = '';
            }

            resumen.classList.remove('hidden');
            btn.disabled = false;
        }

        function cambiarMes(delta) {
            fechaActual.setMonth(fechaActual.getMonth() + delta);
            renderCalendario();
        }

        function enRango(fechaStr) {
            if (!fechaInicioSel || !fechaFinSel) return false;
            return fechaStr > fechaInicioSel && fechaStr < fechaFinSel;
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
                const pasado = esPasado(fecha);
                const esHoy = fecha.toDateString() === hoy.toDateString();
                const esInicio = fechaStr === fechaInicioSel;
                const esFin = fechaStr === fechaFinSel;
                const dentroRango = enRango(fechaStr);

                const celda = document.createElement('div');
                let clases = 'py-3 border-r border-b border-gray-100 text-center';

                if (pasado) {
                    clases += ' bg-gray-50 cursor-not-allowed';
                } else {
                    clases += ' cursor-pointer hover:bg-orange-50 transition';
                }

                if (esInicio || esFin) clases += ' bg-orange-500';
                else if (dentroRango) clases += ' bg-orange-100';
                else if (!pasado) clases += ' bg-white';

                if (esHoy && !esInicio && !esFin) clases += ' ring-2 ring-inset ring-orange-400';

                celda.className = clases;

                let numeroClases = 'inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-medium';
                if (esInicio || esFin) numeroClases += ' bg-white text-orange-600 font-bold';
                else if (pasado) numeroClases += ' text-gray-300';
                else if (esHoy) numeroClases += ' text-orange-600 font-bold';
                else numeroClases += ' text-gray-600';

                celda.innerHTML = `<span class="${numeroClases}">${dia}</span>`;

                if (!pasado) {
                    celda.addEventListener('click', () => seleccionarDia(fechaStr));
                }

                contenedor.appendChild(celda);
            }
        }

        renderCalendario();
    </script>

</x-app-layout>