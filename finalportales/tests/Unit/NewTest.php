<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Services\NewsService;
use App\Models\News;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class NewsServiceTest extends TestCase
{
    protected $faker;
    protected $service;

    public function __construct()
    {
        parent::__construct();
        $this->faker = Faker::create();
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new NewsService();
    }
    
    /**
     * Verifica de obtener los noticias y que no este vacio.
     *
     * @return void
     */
    public function test_get_all_not_empty()
    {
        $news = $this->service->getAll(new Request);
        $this->assertNotEmpty($news);
    }

    /**
     * Verifica de obtener los noticias paginados y que no este vacio.
     *
     * @return void
     */
    public function test_get_all_paginated_not_empty()
    {
        $news = $this->service->getPaginated(new Request);
        $this->assertNotEmpty($news);
        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $news);
    }
    
    /**
     * Valida si se encuentran resultados paginados utilizando la propiedad search.
     *
     * @return void
     */
    public function test_getPaginated_with_search_returns_filtered_results()
    {
        $request = new Request(['q' => 'JUJUTSU']);

        $allNews = News::paginate(8);
        $filteredNews = $allNews->filter(function ($new) use ($request) {
            return str_contains(strtolower($new->detail), strtolower($request->query('q')));
        });

        $searchResults = $this->service->getPaginated($request);

        $this->assertCount(count($filteredNews), $searchResults->items());
        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $searchResults);
    }
    
    /**
     * Valida proceso de creacion de un noticia.
     *
     * @return void
     */ 
    public function test_create_new_with_valid_data()
    {
        $data = [
            'title' => random_int(1, 10000).'Noticia de prueba'.random_int(1, 10000),
            'detail' => random_int(1, 10000).'Noticia de prueba'.random_int(1, 10000),
            'description' => 'Lorem ipsum Lore ipsum...',
            'image' => $this->faker->image(),
            'date' => $this->faker->date(),
            'id_user' => $this->faker->numberBetween(1, 3),
            'id_genre' => [$this->faker->numberBetween(1, 14),$this->faker->numberBetween(1, 14)],
        ];

        $request = new Request($data);

        try {
            $new = $this->service->createNew($request);
            $this->assertInstanceOf(News::class, $new);
            $this->assertEquals($data['title'], $new->title);
            $this->assertEquals($data['detail'], $new->detail);
            $this->assertEquals($data['description'], $new->description);
            $this->assertEquals($data['date'], $new->date->format('Y-m-d'));
            $this->assertDatabaseHas('news', [
                'id_new' => $new->id_new,
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
    }
    
    /**
     * Valida proceso de edicion de un noticia.
     *
     * @return void
     */
    public function test_edit_new_with_valid_data()
    {
        try {
            $lastNew = News::latest()->first();
            if($lastNew){
                $data = [
                    'title' => random_int(1, 10000).'Noticia de prueba'.random_int(1, 10000),
                    'detail' => random_int(1, 10000).'Noticia de prueba'.random_int(1, 10000),
                    'description' => 'Lorem ipsum Lore ipsum...',
                    'image' => $this->faker->image(),
                    'date' => $this->faker->date(),
                    'id_user' => $lastNew->user->id,
                    'id_genre' => [$this->faker->numberBetween(1, 14),$this->faker->numberBetween(1, 14)],
                ];      
                $request = new Request($data);
                $new = $this->service->editNew($request, $lastNew->id_new);
                $this->assertInstanceOf(News::class, $new);
                $this->assertEquals($data['title'], $new->title);
                $this->assertEquals($data['detail'], $new->detail);
                $this->assertEquals($data['description'], $new->description);
                $this->assertEquals($data['date'], $new->date->format('Y-m-d'));
                $this->assertDatabaseHas('news', [
                    'id_new' => $new->id_new,
                ]);
            }
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
    }   
    
    /**
     * Valida proceso de eliminacion de un noticias.
     *
     * @return void
     */
    public function test_delete_with_valid_id_and_returns_success()
    {
        try {
            $lastNew = News::latest()->first();
            $newId = $lastNew->id_new;
        
            $this->service->delete($newId);

            $this->assertDatabaseMissing('news', [
                'id_new' => $newId
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
    }   
}
