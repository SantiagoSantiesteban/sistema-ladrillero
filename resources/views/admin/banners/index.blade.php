<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestión de Banners (Hero Principal)') }}
            </h2>
            <a href="{{ route('admin.banners.create') }}" 
               class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-4 py-2 rounded-lg text-sm transition shadow-sm">
                + Crear Nuevo Banner
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
                @if($banners->isEmpty())
                    <div class="text-center py-12 text-gray-500">
                        <p class="text-base">No hay banners registrados aún.</p>
                        <a href="{{ route('admin.banners.create') }}" class="mt-3 inline-block text-orange-600 hover:underline font-semibold text-sm">
                            Crear el primer banner →
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título / Subtítulo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Orden</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($banners as $banner)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <img src="{{ asset('storage/' . $banner->image) }}" 
                                                alt="{{ $banner->title }}" 
                                                class="w-24 h-16 object-cover rounded-lg border border-gray-200 shadow-sm">
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $banner->title }}</div>
                                            @if($banner->subtitle)
                                                <div class="text-xs text-gray-500 truncate max-w-xs">{{ $banner->subtitle }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($banner->is_active)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Activo
                                                </span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                                                    Inactivo
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $banner->position }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ route('admin.banners.edit', $banner) }}" 
                                               class="text-blue-600 hover:text-blue-900 font-semibold">
                                                Editar
                                            </a>
                                            <form action="{{ route('admin.banners.destroy', $banner) }}" 
                                                  method="POST" 
                                                  class="inline-block"
                                                  onsubmit="return confirm('¿Estás seguro de eliminar este banner?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $banners->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>