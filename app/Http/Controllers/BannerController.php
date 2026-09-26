<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    /**
     * Muestra la lista de banners en el panel administrativo.
     */
    public function index()
    {
        $banners = Banner::orderBy('position', 'asc')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Muestra el formulario para crear un nuevo banner.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Almacena un banner recién creado en la base de datos.
     */
    public function store(StoreBannerRequest $request)
    {
        $data = $request->validated();

        // Subida segura de imagen usando Laravel Storage
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $data['image'] = $path;
        }

        $data['is_active'] = $request->has('is_active');
        $data['created_by'] = Auth::id();

        Banner::create($data);

        return redirect()->route('admin.banners.index')
            ->with('success', '¡Banner creado exitosamente!');
    }

    /**
     * Muestra el formulario para editar un banner existente.
     */
    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Actualiza el banner en la base de datos.
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        $data = $request->validated();

        // Si se sube una nueva imagen, eliminar la anterior del Storage
        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $banner->update($data);

        return redirect()->route('admin.banners.index')
            ->with('success', '¡Banner actualizado correctamente!');
    }

    /**
     * Elimina un banner y su archivo de imagen.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', '¡Banner eliminado exitosamente!');
    }
}