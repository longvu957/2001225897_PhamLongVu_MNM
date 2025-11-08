<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlePolicyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test chỉ tác giả được sửa bài viết
     */
    public function test_only_owner_can_update_article(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        
        $article = Article::factory()->create([
            'user_id' => $owner->id,
            'title' => 'Test Article',
            'body' => 'Test content',
        ]);

        // Owner có thể sửa
        $response = $this->actingAs($owner)
            ->get("/articles/{$article->id}/edit");
        $response->assertStatus(200);

        // User khác không thể sửa
        $response = $this->actingAs($otherUser)
            ->get("/articles/{$article->id}/edit");
        $response->assertStatus(403);
    }

    /**
     * Test chỉ tác giả được xóa bài viết
     */
    public function test_only_owner_can_delete_article(): void
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        
        $article = Article::factory()->create([
            'user_id' => $owner->id,
        ]);

        // Owner có thể xóa
        $response = $this->actingAs($owner)
            ->delete("/articles/{$article->id}");
        $response->assertStatus(302);

        // User khác không thể xóa
        $article2 = Article::factory()->create([
            'user_id' => $owner->id,
        ]);

        $response = $this->actingAs($otherUser)
            ->delete("/articles/{$article2->id}");
        $response->assertStatus(403);
    }
}

