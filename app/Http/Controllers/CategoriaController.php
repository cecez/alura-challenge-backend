<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaCollection;
use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use App\Rules\Hexcolor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @param  Request  $request
     * @return CategoriaResource
     */
    public function store(Request $request): CategoriaResource
    {
        // valida
        $dadosValidados = $request->validate([
            'titulo' => ['required', 'max:255'],
            'cor' => ['required', 'max:255', new Hexcolor()],
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
     * @param  Categoria  $categoria
     * @return CategoriaResource
     */
    public function update(Categoria $categoria): CategoriaResource
    {
        // valida
        $dadosValidados = request()->validate([
            'titulo' => ['sometimes', 'required', 'max:255'],
            'cor' => ['sometimes', 'required', 'max:255', new Hexcolor()],
        ]);

        // atualiza
        $categoria->update($dadosValidados ?? []);

        // retorna
        return new CategoriaResource($categoria);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Categoria  $categoria
     * @return Response
     */
    public function destroy(Categoria $categoria): Response
    {
        if ($categoria->delete()) {
            return response('Categoria exclu??da com sucesso.');
        } else {
            return response('Falha ao excluir categoria.');
        }
    }
}
