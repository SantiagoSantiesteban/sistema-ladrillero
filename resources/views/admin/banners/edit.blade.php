<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Banner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Título Principal *</label>
                        <input type="text" name="title" value="{{ old('title', $banner->title) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        @error('title') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Subtítulo</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen Actual</label>
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="Preview" class="w-48 h-28 object-cover rounded-md my-2 border">
                        <label class="block text-xs font-medium text-gray-500">Reemplazar imagen (Opcional - Máx 2MB):</label>
                        <input type="file" name="image" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                        @error('image') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Texto del Botón</label>
                            <input type="text" name="button_text" value="{{ old('button_text', $banner->button_text) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Enlace del Botón (URL)</label>
                            <input type="url" name="button_url" value="{{ old('button_url', $banner->button_url) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Posición (Orden)</label>
                            <input type="number" name="position" value="{{ old('position', $banner->position) }}" min="0"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>

                        <div class="flex items-center pt-6">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500">
                                <span class="ms-2 text-sm text-gray-700 font-medium">Banner Activo</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('admin.banners.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-medium hover:bg-gray-300 text-sm">
                            Cancelar
                        </a>
                        <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-md font-semibold hover:bg-orange-700 text-sm shadow-sm">
                            Actualizar Banner
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>