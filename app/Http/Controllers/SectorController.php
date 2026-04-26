<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        return view('sector.index');
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