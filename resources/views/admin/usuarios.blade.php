<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Usuarios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2 px-4">Nombre</th>
                            <th class="py-2 px-4">Email</th>
                            <th class="py-2 px-4">Rol</th>
                            <th class="py-2 px-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-2 px-4">{{ $usuario->name }}</td>
                                <td class="py-2 px-4">{{ $usuario->email }}</td>
                                <td class="py-2 px-4">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">
                                        {{ ucfirst($usuario->role) }}
                                    </span>
                                </td>
                                <td class="py-2 px-4">
                                    <form method="POST" action="{{ route('admin.usuarios.rol', $usuario) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="role" class="border rounded px-2 py-1 text-sm mr-2">
                                            <option value="trabajador" {{ $usuario->role == 'trabajador' ? 'selected' : '' }}>Trabajador</option>
                                            <option value="empleador" {{ $usuario->role == 'empleador' ? 'selected' : '' }}>Empleador</option>
                                            <option value="dual" {{ $usuario->role == 'dual' ? 'selected' : '' }}>Dual</option>
                                            <option value="admin" {{ $usuario->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                            Cambiar
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.usuarios.eliminar', $usuario) }}" class="inline"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700 ml-2">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>