<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bandeja de Correos Recibidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-700">Mensajes del Buzón (IMAP)</h3>
                    <span class="text-xs bg-orange-100 text-orange-800 font-semibold px-3 py-1 rounded-full border border-orange-200">
                        Total: {{ $emails->count() }}
                    </span>
                </div>

                @if($emails->isEmpty())
                    <div class="text-center py-8 text-gray-500">
                        No hay correos registrados en la base de datos.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remitente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asunto</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($emails as $email)
                                    <tr class="{{ $email->is_read ? 'bg-white' : 'bg-orange-50/60 font-semibold' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($email->is_read)
                                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600">Leído</span>
                                            @else
                                                <span class="px-2 py-1 text-xs rounded bg-orange-600 text-white">Nuevo</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $email->from_name }} <br>
                                            <span class="text-xs text-gray-500 font-normal">{{ $email->from_email }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-800">
                                            {{ $email->subject }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-normal">
                                            {{ \Carbon\Carbon::parse($email->received_at)->format('d/m/Y h:i A') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('emails.show', $email->id) }}" class="text-orange-600 hover:text-orange-900 font-bold">
                                                Ver mensaje
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>