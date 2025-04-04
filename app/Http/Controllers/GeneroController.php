<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeneroRequest;
use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController
{
    //metodo find all
    public function index(){
        $generos = Genero::orderBy('id', 'desc')->get();
        return view('generos.genero',compact('generos'));
    }

    //Metodos para crear un genero
    public function store(StoreGeneroRequest $request){
        $genero = Genero::create($request->all());
        return redirect()->route('main');
    }
}
