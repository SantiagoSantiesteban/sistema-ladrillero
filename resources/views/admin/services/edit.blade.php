<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Producto / Servicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nombre del Producto/Servicio *</label>
                            <input type="text" name="name" value="{{ old('name', $service->name) }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Slug (URL amigable)</label>
                            <input type="text" name="slug" value="{{ old('slug', $service->slug) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción Corta</label>
                        <textarea name="short_description" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">{{ old('short_description', $service->short_description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción Detallada</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">{{ old('description', $service->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen Actual</label>
                        @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="Preview" class="w-32 h-20 object-cover rounded my-2 border">
                        @endif
                        <input type="file" name="image" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Texto Botón Acción</label>
                            <input type="text" name="button_text" value="{{ old('button_text', $service->button_text) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Enlace Botón (URL)</label>
                            <input type="url" name="button_url" value="{{ old('button_url', $service->button_url) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Posición (Orden)</label>
                            <input type="number" name="position" value="{{ old('position', $service->position) }}" min="0"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>

                        <div class="flex items-center pt-6">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500">
                                <span class="ms-2 text-sm text-gray-700 font-medium">Producto / Servicio Activo</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('admin.services.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-medium text-sm">Cancelar</a>
                        <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-md font-semibold hover:bg-orange-700 text-sm shadow-sm">Actualizar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>