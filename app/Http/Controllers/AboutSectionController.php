<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Http\Requests\StoreAboutSectionRequest;
use App\Http\Requests\UpdateAboutSectionRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AboutSectionController extends Controller
{
    public function index()
    {
        $sections = AboutSection::orderBy('position', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.about.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.about.create');
    }

    public function store(StoreAboutSectionRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        $data['is_active'] = $request->has('is_active');
        $data['created_by'] = Auth::id();

        AboutSection::create($data);

        return redirect()->route('admin.about.index')
            ->with('success', '¡Sección institucional creada exitosamente!');
    }

    public function edit(AboutSection $about)
    {
        return view('admin.about.edit', ['section' => $about]);
    }

    public function update(UpdateAboutSectionRequest $request, AboutSection $about)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            $data['image'] = $request->file('image')->store('about', 'public');
        }

        $data['is_active'] = $request->has('is_active');

        $about->update($data);

        return redirect()->route('admin.about.index')
            ->with('success', '¡Sección institucional actualizada correctamente!');
    }

    public function destroy(AboutSection $about)
    {
        if ($about->image && Storage::disk('public')->exists($about->image)) {
            Storage::disk('public')->delete($about->image);
        }

        $about->delete();

        return redirect()->route('admin.about.index')
            ->with('success', '¡Sección institucional eliminada correctamente!');
    }
}