<?php

namespace App\Http\Controllers; // Harus sama persis dengan folder

use Illuminate\Http\Request;

class TamuController extends Controller // Nama class harus sama dengan nama file
{
    public function create()
    {
        return view('tamu.create');
    }
}