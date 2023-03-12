<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Testa o middleware de autenticação nas páginas restritas.
     */
    public function test_user_can_access_posts_feed_with_middleware(): void
    {
        $response = $this->get(route('posts.index'));
        $response->assertRedirectToRoute('login');

        $response = $this->get(route('posts.history'));
        $response->assertRedirectToRoute('login');

        $response = $this->get(route('posts.followed'));
        $response->assertRedirectToRoute('login');
    }

    /**
     * Testa o acesso as páginas autenticado.
     */
    public function test_user_can_access_posts_feed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('posts.index'));
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get(route('posts.history'));
        $response->assertStatus(200);

        $response = $this->actingAs($user)->get(route('posts.followed'));
        $response->assertStatus(200);
    }

    /**
     * Testa o middleware de autenticação criando um Post.
     */
    public function test_create_post_with_middleware(): void
    {
        $data = ['name' => 'Teste megabless', 'type' => '1', 'gender' => '1'];

        $response = $this->post(route('posts.store'), $data);
        $response->assertRedirectToRoute('login');
    }

    /**
     * Testa a criação de um Post.
     */
    public function test_create_post(): void
    {
        $data = ['name' => 'Teste megabless', 'type' => '1', 'gender' => '1'];
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('posts.store'), $data);
        $response->assertRedirectToRoute('posts.index');
    }

    /**
     * Testa o middleware de autenticação
     */
    public function test_update_post_with_middleware(): void
    {
        $data = ['name' => 'Teste megabless', 'type' => '1', 'gender' => '1'];

        $response = $this->post(route('posts.update', 1), $data);

        $this->assertGuest();
        $response->assertRedirectToRoute('login');
    }

    /**
     * Testa se é possível atualizar um post concluído
     */
    public function test_update_post_with_conclued(): void
    {
        $data = ['name' => 'Teste megabless', 'type' => '1', 'gender' => '1'];
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id, 'conclued' => true]);

        $response = $this->actingAs($user)->post(route('posts.update', $post->id), $data);
        $response->assertUnauthorized();
    }

    /**
     * Testa atualização de um post
     */
    public function test_update_post(): void
    {
        $data = ['name' => 'Teste megabless', 'type' => '1', 'gender' => '1'];
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('posts.update', $post->id), $data);
        $response->assertRedirectToRoute('posts.index');
    }

    /**
     * Testa tentativa de atualização de post de um outro usuário
     */
    public function test_update_another_users_post_middleware(): void
    {
        $data = ['name' => 'Teste megabless', 'type' => '1', 'gender' => '1'];
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $userNew = User::factory()->create();

        $response = $this->actingAs($userNew)->post(route('posts.update', $post->id), $data);
        $response->assertUnauthorized();
    }

    /**
     * Testa atualização de um post com interações
     */
    public function test_update_post_with_interation_middleware(): void
    {
        $data = ['name' => 'Teste megabless', 'type' => '1', 'gender' => '1'];
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        Vote::factory()->create(['user_id' => $user->id, 'post_id' => $post->id]);

        $response = $this->actingAs($user)->post(route('posts.update', $post->id), $data);
        $response->assertUnauthorized();
    }

    /**
     * Testa o middleware de autenticação
     */
    public function test_delete_post_with_middleware(): void
    {
        $response = $this->delete(route('posts.delete', 1));
        $this->assertGuest();
        $response->assertRedirectToRoute('login');
    }
    
    /**
     * Testa se é possível deletar um post já concluído
     */
    public function test_delete_post_with_conclued(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id, 'conclued' => true]);

        $response = $this->actingAs($user)->delete(route('posts.delete', $post->id));
        $response->assertUnauthorized();
    }

    /**
     * Testa deletar um post
     */
    public function test_delete_post(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('posts.delete', $post->id));
        $response->assertRedirectToRoute('posts.index');
    }

    /**
     * Testa deletar um post de outro usuário
     */
    public function test_delete_another_users_post_middleware(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $userNew = User::factory()->create();

        $response = $this->actingAs($userNew)->delete(route('posts.delete', $post->id));
        $response->assertUnauthorized();
    }

    /**
     * Testa deletar um post com interação
     */
    public function test_delete_post_with_interation_middleware(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        
        Vote::factory()->create(['user_id' => $user->id, 'post_id' => $post->id]);

        $response = $this->actingAs($user)->delete(route('posts.delete', $post->id));
        $response->assertUnauthorized();
    }

    /**
     * Testa o middleware de autenticação
     */
    public function test_set_post_conclued_with_middleware(): void
    {
        $response = $this->post(route('posts.conclued', 1));
        $this->assertGuest();
        $response->assertRedirectToRoute('login');
    }

    /**
     * Testa se é possível concluir um post já concluído
     */
    public function test_set_post_conclued_post_with_already_conclued(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id, 'conclued' => true]);

        $response = $this->actingAs($user)->post(route('posts.conclued', $post->id));
        $response->assertUnauthorized();
    }

    /**
     * Testa concluir um post
     */
    public function test_set_post_conclued(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->post(route('posts.conclued', $post->id));
        $response->assertRedirectToRoute('posts.index');
    }

    /**
     * Testa se é possível concluir post de outros usuários
     */
    public function test_set_post_conclued_another_users_post_middleware(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $userNew = User::factory()->create();

        $response = $this->actingAs($userNew)->post(route('posts.conclued', $post->id));
        $response->assertUnauthorized();
    }
}
