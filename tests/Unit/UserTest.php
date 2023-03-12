<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * Testa conta de votos positivos caso um usuário vote positivo
     */
    public function test_single_post_user_positive_votes_calc(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $user->votePositive($post);

        $this->assertEquals(1, Post::find($post->id)->positiveVotes->count());
        $this->assertEquals(0, Post::find($post->id)->negativeVotes->count());
    }

    /**
     * Testa conta de votos negativos caso um usuário vote negativo
     */
    public function test_single_post_user_negative_votes_calc(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $user->voteNegative($post);

        $this->assertEquals(0, Post::find($post->id)->positiveVotes->count());
        $this->assertEquals(1, Post::find($post->id)->negativeVotes->count());
    }

    /**
     * Testa conta de seguidores caso um usuário siga o post
     */
    public function test_single_post_user_follows_calc(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);
        $user->follow($post);

        $this->assertEquals(1, Post::find($post->id)->follows->count());
    }

    /**
     * Testa conta caso um usuário comece votando positivo e depois troque para negativo
     */
    public function test_single_post_user_vote_and_unvotes_to_negative_calc(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $user->votePositive($post);
        $user->voteNegative($post);

        $this->assertEquals(0, Post::find($post->id)->positiveVotes->count());
        $this->assertEquals(1, Post::find($post->id)->negativeVotes->count());
    }

    /**
     * Testa conta caso um usuário comece seguindo e decida dar unfollow no post
     */
    public function test_single_post_user_follow_and_unfollows_calc(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->create(['user_id' => $user->id]);

        $user->follow($post);
        $user->follow($post);

        $this->assertEquals(0, Post::find($post->id)->follows->count());
    }
}
