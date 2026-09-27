<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Service;

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
        // Consulta los productos/servicios activos ordenados por posición
        $services = Service::visible()->get();

        return view('sector.productos', compact('services'));
    }

    public function contacto()
    {
        return view('sector.contacto');
    }
}