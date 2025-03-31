<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticiaRequest;
use App\Models\Noticia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller

{
    use AuthorizesRequests;
    
    // Función para mostrar las noticias
    public function index()
    {
        if (Auth::check()) {
            // Autorización manual para ver las noticias
            $this->authorize('viewAny', Noticia::class);
            
            $noticias = Noticia::orderBy('id', 'desc')->paginate(6);
            $usuario = Auth::user();
            return view('main', compact('noticias', 'usuario'));
        } else {
            return redirect()->route('auth.login.get');
        }
    }

    // Función para almacenar una noticia nueva
    public function store(StoreNoticiaRequest $request)
    {
        // Autorización manual para crear una noticia
        $this->authorize('create', Noticia::class);

        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . $file->getClientOriginalName(); // Nombre único
            $imagenPath = $file->storeAs('noticias', $filename, 'public');
        }

        Noticia::create([
            'titulo' => $request->titulo,
            'fecha_publicacion' => $request->fecha_publicacion,
            'descripcion' => $request->descripcion,
            'imagen' => $imagenPath,
            'genero' => $request->genero,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('main')->with('success', 'Noticia creada correctamente.');
    }

    // Función para acceder a la vista de crear noticia
    public function acceso()
    {
        // Autorización manual para ver la página de crear noticia
        $this->authorize('create', Noticia::class);
        
        return view('noticias.create');
    }

    // Función para mostrar una noticia específica
    public function show(Noticia $noticia)
    {
        // Autorización manual para ver una noticia
        $this->authorize('view', $noticia);

        return view('noticias.show', compact('noticia'));
    }

    // Función para eliminar una noticia
    public function destroy(Noticia $noticia)
    {
        // Autorización manual para eliminar una noticia
        $this->authorize('delete', $noticia);

        $noticia->delete();
        return redirect()->route('main');
    }

    // Función para editar una noticia
    public function edit(Noticia $noticia)
    {
        // Autorización manual para editar una noticia
        $this->authorize('update', $noticia);

        return view('noticias.edit', compact('noticia'));
    }

    // Función para actualizar una noticia
    public function update(StoreNoticiaRequest $request, Noticia $noticia)
    {
        // Autorización manual para actualizar una noticia
        $this->authorize('update', $noticia);

        $imagenPath = $noticia->imagen;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = $file->getClientOriginalName();
            $storagePath = "noticias/{$filename}";

            if (!Storage::disk('public')->exists($storagePath)) {
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

    // Función para dar like a una noticia
    public function like(Noticia $noticia)
    {
        if (!$noticia->users()->where('user_id', Auth::id())->exists()) {
            $noticia->users()->attach(Auth::id());
        }
        return redirect()->route('main');
    }

    // Función para quitar el like de una noticia
    public function unlike(Noticia $noticia)
    {
        $noticia->users()->detach(Auth::id());
        return redirect()->route('main');
    }
}
