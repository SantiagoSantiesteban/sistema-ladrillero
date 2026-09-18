<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Resultados de búsqueda</h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Resumen de búsqueda -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Mostrando trabajadores disponibles</p>
                        <div class="flex items-center space-x-2">
                            <svg class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            @if($fechaInicio->eq($fechaFin))
                                <span class="font-semibold text-gray-800">
                                    {{ $fechaInicio->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY') }}
                                </span>
                            @else
                                <span class="font-semibold text-gray-800">
                                    {{ $fechaInicio->locale('es')->isoFormat('D [de] MMMM') }}
                                    —
                                    {{ $fechaFin->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <span class="bg-orange-100 text-orange-700 text-sm font-semibold px-3 py-1.5 rounded-full">
                        {{ $trabajadores->count() }} {{ $trabajadores->count() === 1 ? 'trabajador' : 'trabajadores' }}
                    </span>
                </div>
            </div>

            @if($trabajadores->isEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-10 text-center">
                    <svg class="h-12 w-12 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h3 class="text-gray-500 font-medium mb-2">No se encontraron trabajadores</h3>
                    <p class="text-gray-400 text-sm mb-5">Ningún trabajador registró disponibilidad para las fechas seleccionadas.</p>
                    <a href="{{ route('empleador.index') }}"
                       class="inline-flex items-center space-x-2 bg-orange-600 text-white px-5 py-2.5 rounded-lg hover:bg-orange-700 transition font-medium text-sm">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Nueva búsqueda</span>
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($trabajadores as $trabajador)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 hover:shadow-md transition">

                            <!-- Header trabajador -->
                            <div class="flex items-center space-x-3 mb-4">
                                <div class="bg-orange-100 rounded-full p-2.5">
                                    <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">{{ $trabajador->name }}</h4>
                                    <span class="text-xs text-orange-600 font-medium">
                                        {{ $trabajador->fechasDisponibles->count() }} día(s) disponible(s)
                                    </span>
                                </div>
                            </div>

                            <!-- Fechas disponibles -->
                            <div class="mb-4">
                                <p class="text-xs font-medium text-gray-500 mb-2">Disponible los días:</p>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($trabajador->fechasDisponibles as $fecha)
                                        <span class="bg-orange-50 border border-orange-200 text-orange-700 text-xs font-medium px-2 py-1 rounded-full">
                                            {{ $fecha->fecha->locale('es')->isoFormat('ddd D MMM') }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Contacto -->
                            <div class="border-t border-gray-100 pt-4 space-y-2">
                                @if($trabajador->telefono)
                                    <a href="tel:{{ $trabajador->telefono }}"
                                       class="flex items-center space-x-2 text-sm text-gray-600 hover:text-orange-600 transition">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <span>{{ $trabajador->telefono }}</span>
                                    </a>
                                @endif
                                <a href="mailto:{{ $trabajador->email }}"
                                   class="flex items-center space-x-2 text-sm text-gray-600 hover:text-orange-600 transition">
                                    <svg class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span>{{ $trabajador->email }}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-2">
                    <a href="{{ route('empleador.index') }}"
                       class="inline-flex items-center space-x-2 bg-gray-100 text-gray-700 px-5 py-2.5 rounded-lg hover:bg-gray-200 transition font-medium text-sm">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span>Nueva búsqueda</span>
                    </a>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>