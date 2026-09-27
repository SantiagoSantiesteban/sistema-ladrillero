<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Muestra el listado de productos/servicios en el panel administrativo.
     */
    public function index()
    {
        $services = Service::orderBy('position', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto/servicio.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Guarda el nuevo producto/servicio en la base de datos.
     */
    public function store(StoreServiceRequest $request)
    {
        $data = $request->validated();

        // Carga segura de imagen en Storage
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['created_by'] = Auth::id();

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', '¡Producto/Servicio creado exitosamente!');
    }

    /**
     * Muestra el formulario para editar un producto/servicio existente.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Actualiza el producto/servicio en la base de datos.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $data = $request->validated();

        // Reemplazo seguro de imagen
        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', '¡Producto/Servicio actualizado correctamente!');
    }

    /**
     * Elimina el registro y su imagen asociada.
     */
    public function destroy(Service $service)
    {
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', '¡Producto/Servicio eliminado exitosamente!');
    }
}