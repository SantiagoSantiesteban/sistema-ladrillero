<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalle del Correo Recibido') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <a href="{{ route('emails.index') }}" class="text-sm text-orange-600 hover:underline mb-4 inline-block">
                        ← Volver a la bandeja
                    </a>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ $email->subject }}</h3>
                    
                    <div class="mt-4 text-sm text-gray-600 grid grid-cols-1 md:grid-cols-2 gap-2 bg-gray-50 p-4 rounded-lg">
                        <div><strong>De:</strong> {{ $email->from_name }} &lt;{{ $email->from_email }}&gt;</div>
                        <div><strong>Recibido:</strong> {{ \Carbon\Carbon::parse($email->received_at)->format('d/m/Y h:i A') }}</div>
                        <div><strong>Message-ID:</strong> <code class="text-xs bg-gray-200 px-1 rounded">{{ $email->message_id }}</code></div>
                    </div>
                </div>

                <div class="prose max-w-none text-gray-800 py-4">
                    <h4 class="font-bold text-gray-700 mb-2">Contenido:</h4>
                    <div class="bg-gray-50 p-4 rounded-md border border-gray-200 whitespace-pre-wrap">
                        {{ $email->body }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>