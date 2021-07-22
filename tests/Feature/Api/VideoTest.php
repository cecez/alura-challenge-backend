<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste para GET /videos
     */
    public function test_get_videos(): void
    {
        $response = $this->getJson('/api/videos');

        $response->assertStatus(200);
    }

    /**
     * Teste para GET /videos/{id}, caso de vídeo que existe
     */
    public function test_get_videos_1_existente(): void
    {
        $response = $this->getJson('/api/videos/1');

        $response->assertStatus(200);
    }

    /**
     * Teste para GET /videos/{x}, caso de vídeo que não existe
     */
    public function test_get_videos_1_nao_existente(): void
    {
        $response = $this->getJson('/api/videos/123123123');

        $response
            ->assertStatus(404)
            ->assertJson(['retorno' => 'Não encontrado.']);
    }

    /**
     * Teste para POST /videos, inserindo vídeo com sucesso
     */
    public function test_post_videos_com_sucesso()
    {
        $response = $this->postJson('/api/videos', [
            'titulo' => 'um título',
            'descricao' => 'uma descrição',
            'url' => 'http://uma.url'
        ]);

        $response
            ->assertStatus(201)
            ->assertJsonStructure(['data' => ['id', 'titulo', 'descricao', 'url']]);
    }

    /**
     * Teste para POST /videos, com falha ao inserir vídeo, barrado na validação
     */
    public function test_post_videos_sem_sucesso()
    {
        $response = $this->postJson('/api/videos', [
            'descricao' => 'uma descrição',
            'url' => 'http://uma.url'
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['titulo']);
    }

    /**
     * Teste para PUT /videos/1, atualizando vídeo com sucesso
     */
    public function test_put_videos_1_com_sucesso()
    {
        $response = $this->putJson('/api/videos/1', [
            'titulo' => 'um título atualizado',
            'descricao' => 'uma descrição atualizada',
            'url' => 'http://atualizada.url'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['id', 'titulo', 'descricao', 'url']]);
    }

    /**
     * Teste para PUT /videos/1, com falha ao atualizar vídeo, barrado na validação
     */
    public function test_put_videos_1_sem_sucesso()
    {
        $response = $this->putJson('/api/videos/1', [
            'descricao' => '',
            'url' => 'urlinexistente'
        ]);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors(['url', 'descricao']);
    }

    /**
     * Teste para DELETE /videos/1, caso de vídeo que existe
     */
    public function test_delete_videos_1_existente(): void
    {
        $response = $this->deleteJson('/api/videos/1');

        $response->assertStatus(200);
    }

    /**
     * Teste para DELETE /videos/{x}, caso de vídeo que não existe
     */
    public function test_delete_videos_1_nao_existente(): void
    {
        $response = $this->deleteJson('/api/videos/123123123');

        $response
            ->assertStatus(404)
            ->assertJson(['retorno' => 'Não encontrado.']);
    }


}
