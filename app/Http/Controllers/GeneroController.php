<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeneroRequest;
use App\Models\Genero;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
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
        Alert::toast('Género "' . $genero->genero . '" añadido correctamente.', 'success')->position('top-end');
        return redirect()->route('main');
    }
}
