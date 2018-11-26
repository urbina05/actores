<?php

namespace App\Http\Controllers;

use App\Movie;
// use App\ActorMovie;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function showAllMovies()
    {
        // Obtener lista de peliculas sin relacionar actor
        // return response()->json(Movie::all());

        // Obtener lista de peliculas con actores relacionados
        return response()->json(Movie::with('actors')->get()->all());
    }

    public function showOneMovie($id)
    {
        return response()->json(Movie::with('actors')->find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'year' => 'required|integer',
            'actors' => 'sometimes|exists:actors,id'
        ]);

        $movie = Movie::create($request->except('actors'));

        if ($request->has('actors')) {
            // Añadir actores a la lista
            $movie->actors()->sync($request->input('actors'));
        }

        // Buscar pelicula creada
        return $this->showOneMovie($movie->id);
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'actors' => 'sometimes|exists:actors,id'
        ]);

        $movie = Movie::with('actors')->findOrFail($id);
        $movie->update($request->except('actors'));

        if ($request->has('actors')) {
            // Reemplaza lista actual de actores
            $movie->actors()->sync($request->input('actors'));

            // Si se cambio actors: Nueva busqueda para actualizar la relacion
            return $this->showOneMovie($movie->id);
        }

        return response()->json($movie, 200);
    }

    public function addActor($id, Request $request)
    {
        $this->validate($request, [
            'actors' => 'required|exists:actors,id'
        ]);

        $movie = Movie::with('actors')->findOrFail($id);
        // Añade, si no existe, actores especificados, sin borrar anteriores
        $movie->actors()->syncWithoutDetaching($request->input('actors'));

        // Repetir busqueda para actualizar la relacion
        return $this->showOneMovie($movie->id);
    }

    public function removeActor($id, Request $request)
    {
        $this->validate($request, [
            'actors' => 'required'
        ]);

        $movie = Movie::with('actors')->findOrFail($id);
        // Borra si existe el actor de la lista
        $movie->actors()->detach($request->input('actors'));

        // Repetir busqueda para actualizar la relacion
        return $this->showOneMovie($movie->id);
    }

    public function delete($id)
    {
        Movie::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}