<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SortArticlesTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */

    public function it_can_sort_articles_by_title_asc() : void
    {
        factory(Article::class)->create(['title' => 'C Title']);
        factory(Article::class)->create(['title' => 'A Title']);
        factory(Article::class)->create(['title' => 'B Title']);

        $url = route('api.v1.articles.index', ['sort' => 'title']);
        $this->getJson($url)->assertSeeInOrder([
            'A Title',
            'B Title',
            'C Title'
        ]);

    }

    /**
     * @test
     */

    public function it_can_sort_articles_by_title_desc() : void
    {
        factory(Article::class)->create(['title' => 'C Title']);
        factory(Article::class)->create(['title' => 'A Title']);
        factory(Article::class)->create(['title' => 'B Title']);

        $url = route('api.v1.articles.index', ['sort' => '-title']);
        $this->getJson($url)->assertSeeInOrder([
            'C Title',
            'B Title',
            'A Title'
        ]);

    }

    /**
     * @test
     */

    public function it_can_sort_articles_by_title_and_content() : void
    {
        factory(Article::class)->create(['title' => 'C Title', 'content' => 'C Content']);
        factory(Article::class)->create(['title' => 'A Title', 'content' => 'A Content']);
        factory(Article::class)->create(['title' => 'B Title', 'content' => 'B Content']);

//        \DB::listen(function ($db) {
//            dump($db->sql);
//        });

        $url = route('api.v1.articles.index', ['sort' => 'title,content']);
        $this->getJson($url)->assertSeeInOrder([
            'A Title',
            'B Title',
            'C Title'
        ]);

    }
}
