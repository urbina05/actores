<?php

namespace App\Http\Controllers;

use App\Actor;
use Illuminate\Http\Request;

class ActorController extends Controller
{

    public function showAllActors()
    {
        return response()->json(Actor::all());
    }

    public function showOneActor($id)
    {
        return response()->json(Actor::find($id));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $actor = Actor::create($request->all());

        return response()->json($actor, 201);
    }

    public function update($id, Request $request)
    {
        $actor = Actor::findOrFail($id);
        $actor->update($request->all());

        return response()->json($actor, 200);
    }

    public function delete($id)
    {
        Actor::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}