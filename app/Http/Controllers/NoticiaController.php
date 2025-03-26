<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticiaRequest;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticiaController
{
    //Metodo para pasar noticias al main
    public function index()
    {
        $noticias = Noticia::orderBy('id','desc')->paginate(6);
        $usuario = Auth::user();
        return view('main', compact('noticias', 'usuario'));
    }

//Metodo para crear una noticia
    public function store(StoreNoticiaRequest $request)
    {
        $imagenPath = null;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen'); //accedemos al archivo
            $filename = $file->getClientOriginalName();
            $storagePath = "noticias/{$filename}";

            // Verificar si la imagen ya existe
            if (Storage::disk('public')->exists($storagePath)) {
                // Si la imagen ya existe, usarla sin subirla de nuevo
                $imagenPath = $storagePath;
            } else {
                // Si no existe, subir la imagen y guardar su ruta
                $imagenPath = $file->storeAs('noticias', $filename, 'public');
            }
        }
        // Crear la noticia con los datos y la imagen
        Noticia::create([
            'titulo' => $request->titulo,
            'fecha_publicacion' => $request->fecha_publicacion,
            'descripcion' => $request->descripcion,
            'imagen' => $imagenPath, 
            'genero' => $request->genero,
        ]);
        return redirect()->route('main');
    }

    //Metodo para encontrar una noticia
    public function show(Noticia $noticia)
    {
        return view('noticias.show', compact('noticia'));
    }

    //Metodo para eliminar una noticia
    public function destroy($noticia){
        $noticia=Noticia::find($noticia);
        $noticia->delete();
        return redirect()->route('main');
    }

    //Metodo para acceder a editar una noticia
    public function edit(Noticia $noticia){
        return view('noticias.edit', compact('noticia'));
    }

    //Metodo para actualizar una noticia
    public function update(StoreNoticiaRequest $request, Noticia $noticia){
    $imagenPath = $noticia->imagen; 

    if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        $filename = $file->getClientOriginalName();
        $storagePath = "noticias/{$filename}";
        if (Storage::disk('public')->exists($storagePath)) {
            $imagenPath = $storagePath;
        } else {
            $imagenPath = $file->storeAs('noticias', $filename, 'public');
        }
    }
    $noticia->update([
        'titulo' => $request->titulo,
        'fecha_publicacion' => $request->fecha_publicacion,
        'descripcion' => $request->descripcion,
        'imagen' => $imagenPath, 
        'genero' => $request->genero,
    ]);
    return redirect()->route('main');
}
//Funciones para dar like o quitarlo
    public function like(Noticia $noticia){
        $noticia->users()->attach(Auth::user()->id);
        return redirect()->route('main');
    }
    public function unlike(Noticia $noticia){
        $noticia->users()->detach(Auth::user()->id);
        return redirect()->route('main');
    }
}