<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoCollection;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return VideoCollection
     */
    public function index(): VideoCollection
    {
        return new VideoCollection(Video::all());
//        return new VideoCollection(Video::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return VideoResource
     */
    public function store(Request $request): VideoResource
    {
        // valida
        $dadosValidados = $request->validate([
            'titulo' => ['required', 'max:255'],
            'descricao' => ['required', 'max:255'],
            'url' => ['required', 'max:255', 'url'],
        ]);

        // salva
        $video = Video::create($dadosValidados);

        // retorna
        return new VideoResource($video);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return VideoResource
     */
    public function show(Video $video): VideoResource
    {
        return new VideoResource($video);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return VideoResource
     */
    public function update(Request $request, Video $video): VideoResource
    {
        // valida
        $dadosValidados = $request->validate([
             'titulo' => ['sometimes', 'required', 'max:255'],
             'descricao' => ['sometimes', 'required', 'max:255'],
             'url' => ['sometimes', 'required', 'max:255', 'url'],
         ]);

        // atualiza
        if (!empty($dadosValidados)) {
            $video->update($dadosValidados);
        }

        // retorna
        return new VideoResource($video);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return Response
     */
    public function destroy(Video $video): Response
    {
        if ($video->delete()) {
            return response('Video excluído com sucesso.');
        } else {
            return response('Falha ao excluir vídeo.');
        }
    }
}
