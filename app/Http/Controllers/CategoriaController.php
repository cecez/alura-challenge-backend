<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return CategoriaCollection
     */
    public function index(): CategoriaCollection
    {
        return new CategoriaCollection(Categoria::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return CategoriaResource
     */
    public function store(Request $request): CategoriaResource
    {
        // valida
        $dadosValidados = $request->validate([
            'titulo' => ['required', 'max:255'],
            'cor' => ['required', 'max:255', 'regex:/#([[:xdigit:]]{3}){1,2}\b/'],
        ]);

        // salva e retorna
        return new CategoriaResource(Categoria::create($dadosValidados));
    }

    /**
     * Display the specified resource.
     *
     * @param  Categoria  $categoria
     * @return CategoriaResource
     */
    public function show(Categoria $categoria): CategoriaResource
    {
        return new CategoriaResource($categoria);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
