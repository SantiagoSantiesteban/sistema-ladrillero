<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Sección Institucional') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('admin.about.update', $section) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Título *</label>
                            <input type="text" name="title" value="{{ old('title', $section->title) }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Subtítulo</label>
                            <input type="text" name="subtitle" value="{{ old('subtitle', $section->subtitle) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tipo de Sección *</label>
                            <select name="section_type" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                                <option value="historia" {{ $section->section_type == 'historia' ? 'selected' : '' }}>Historia del Sector</option>
                                <option value="mision" {{ $section->section_type == 'mision' ? 'selected' : '' }}>Misión</option>
                                <option value="vision" {{ $section->section_type == 'vision' ? 'selected' : '' }}>Visión</option>
                                <option value="valores" {{ $section->section_type == 'valores' ? 'selected' : '' }}>Valores</option>
                                <option value="general" {{ $section->section_type == 'general' ? 'selected' : '' }}>General</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Posición (Orden)</label>
                            <input type="number" name="position" value="{{ old('position', $section->position) }}" min="0"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contenido Detallado *</label>
                        <textarea name="content" rows="5" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500">{{ old('content', $section->content) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Imagen Actual</label>
                        @if($section->image)
                            <img src="{{ asset('storage/' . $section->image) }}" alt="Preview" class="w-32 h-20 object-cover rounded my-2 border">
                        @endif
                        <input type="file" name="image" accept="image/*"
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100">
                    </div>

                    <div class="flex items-center">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $section->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-orange-600 shadow-sm focus:ring-orange-500">
                            <span class="ms-2 text-sm text-gray-700 font-medium">Sección Activa</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t">
                        <a href="{{ route('admin.about.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-medium text-sm">Cancelar</a>
                        <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-md font-semibold hover:bg-orange-700 text-sm shadow-sm">Actualizar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>