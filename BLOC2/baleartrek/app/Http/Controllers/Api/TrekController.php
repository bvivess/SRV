<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trek;

class TrekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // SELECCIÓ DE LES DADES
        //$treks = Trek::all();
        // $treks = Trek::paginate(3);  // crea una sortida amb paginació
        // $treks = Trek::with([])->get();  // no té sentit
        $treks = Trek::with(["meetings","meetings.users"])->get();  // post amb les taules relacionades, més óptima
        // $treks = Trek::with(["user", "category", "comments", "comments.images"])->get();
        // $treks = Trek::with(["user", "category", "comments", "comments.images"])->paginate(3);

        // SELECCIÓ DEL FORMAT DE LA RESPOSTA
        return response()->json($treks);  // --> torna una resposta serialitzada en format 'json'
        // return (PostResource::collection($posts))->additional(['meta' => 'Posts mostrats correctament']);  // torna una resposta personalitzada
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
