<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;

class SectorController extends Controller
{
    public function index()
    {
        // Consulta los banners activos y dentro del rango de fechas
        $banners = Banner::visible()->get();

        return view('sector.index', compact('banners'));
    }

    public function productos()
    {
        return view('sector.productos');
    }

    public function contacto()
    {
        return view('sector.contacto');
    }
}