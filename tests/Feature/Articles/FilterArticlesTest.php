<?php

namespace Tests\Feature\Articles;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilterArticlesTest extends TestCase
{

    use RefreshDatabase;

    /**
     * @test
     */
    public function can_filter_articles_by_filter() : void
    {
        factory(Article::class)->create([
           'title' => 'Arende Laravel Desde Cero'
        ]);

        factory(Article::class)->create([
            'title' => 'Other Article'
        ]);

        $url = route('api.v1.articles.index', ['filter[title]' => 'Laravel']);

        $this->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('Arende Laravel Desde Cero')
            ->assertDontSee('Other Article');
    }

    /**
     * @test
     */
    public function can_filter_articles_by_content() : void
    {
        factory(Article::class)->create([
            'content' => '<div>Arende Laravel Desde Cero</div>'
        ]);

        factory(Article::class)->create([
            'content' => '<div>Other Article</div>'
        ]);

        $url = route('api.v1.articles.index', ['filter[content]' => 'Laravel']);

        $this->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('Arende Laravel Desde Cero')
            ->assertDontSee('Other Article');
    }

    /**
     * @test
     */
    public function can_filter_articles_by_year() : void
    {
        factory(Article::class)->create([
            'content' => 'Article from 2020',
            'created_at' => now()->year(2020)
        ]);

        factory(Article::class)->create([
            'content' => 'Article from 2021',
            'created_at' => now()->year(2021)
        ]);

        $url = route('api.v1.articles.index', ['filter[year]' => 2020]);

        $this->getJson($url)
            ->assertJsonCount(1, 'data')
            ->assertSee('Article from 2020')
            ->assertDontSee('Article from 2021');
    }

    /**
     * @test
     */
    public function can_filter_articles_by_month() : void
    {
        factory(Article::class)->create([
            'content' => 'Article from February',
            'created_at' => now()->month(2)
        ]);

        factory(Article::class)->create([
            'content' => 'Another Article from February',
            'created_at' => now()->month(2)
        ]);

        factory(Article::class)->create([
            'content' => 'Article from January',
            'created_at' => now()->month(1)
        ]);

        $url = route('api.v1.articles.index', ['filter[month]' => 2]);

        $this->getJson($url)
            ->assertJsonCount(2, 'data')
            ->assertSee('Article from February')
            ->assertSee('Another Article from February')
            ->assertDontSee('Article from January');
    }

    /**
     * @test
     */
    public function cannot_filter_articles_by_unknown_filters() : void
    {
        factory(Article::class)->create();

        $url = route('api.v1.articles.index', ['filter[unknown]' => 'unknown']);

        $this->getJson($url)->assertStatus(400);
    }

}
