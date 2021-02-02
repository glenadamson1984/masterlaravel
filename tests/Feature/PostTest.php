<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('nothing found');
    }

    public function testSeeOneBlogPostWithNoComments()
    {
        //Arrange
        $post = $this->createDummyBlogPost();

        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText('title');
        $response->assertSeeText("No comments");
        $this->assertDatabaseHas('blog_posts', ['title' => 'title']);
    }

    public function testSeeOneBlogPostWithComments()
    {
        //Arrange
        $post = $this->createDummyBlogPost();
         Comment::factory()->count(3)->create([
            'blog_post_id' => $post->id
        ]);

        //Act
        $response = $this->get('/posts');


        $response->assertSeeText('title');
        $response->assertSeeText("3 comments");
    }

    public function testStoreValid()
    {

        $params = [
            'title' => 'valid title',
            'content' => 'at least 10 characters'
        ];

        $response = $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'this blog was created');
    }

    public function testStoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();

        $this->assertEquals($messages['title'][0], 'The title must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content must be at least 10 characters.');
    }

    public function testUpdateValid()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title' => 'a new name',
            'content' => 'a new content added'
        ];

        $this->actingAs($this->user())
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was updated!');
        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        $this->assertDatabaseHas('blog_posts', ['title' => 'a new name']);
    }

    public function testDelete()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $this->actingAs($this->user())
            ->delete("/posts/{$post->id}")
            ->assertStatus(302);

        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
    }

    private function createDummyBlogPost(): BlogPost
    {
        return BlogPost::factory()->basic()->create();
    }
}
