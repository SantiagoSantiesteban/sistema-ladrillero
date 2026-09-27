<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestión de Productos y Servicios Ladrilleros') }}
            </h2>
            <a href="{{ route('admin.services.create') }}" 
               class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-4 py-2 rounded-lg text-sm transition shadow-sm">
                + Crear Producto / Servicio
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-admin-nav />

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if($services->isEmpty())
                    <div class="text-center py-12 text-gray-500">
                        <p class="text-base">No hay productos o servicios registrados aún.</p>
                        <a href="{{ route('admin.services.create') }}" class="mt-3 inline-block text-orange-600 hover:underline font-semibold text-sm">
                            Crear el primer producto →
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Imagen</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre / Slug</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Orden</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($services as $service)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($service->image)
                                                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-16 h-12 object-cover rounded-md border">
                                            @else
                                                <div class="w-16 h-12 bg-gray-100 rounded-md border flex items-center justify-center text-xs text-gray-400">Sin Foto</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $service->name }}</div>
                                            <div class="text-xs text-gray-500">/{{ $service->slug }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($service->is_active)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">Inactivo</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $service->position }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('admin.services.edit', $service) }}" class="text-blue-600 hover:text-blue-900 font-semibold">Editar</a>
                                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar este producto/servicio?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $services->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>