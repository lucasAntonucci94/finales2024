<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Services\ProductsService;
use App\Models\Product;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class ProductsServiceTest extends TestCase
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
        $this->service = new ProductsService();
    }
    /**
     * Verifica de obtener los productos y que no este vacio.
     *
     * @return void
     */
    public function test_get_all_products_not_empty()
    {
        $products = $this->service->getAll(new Request);
        $this->assertNotEmpty($products);
    }

    /**
     * Verifica de obtener los productos paginados y que no este vacio.
     *
     * @return void
     */
    public function test_get_all_products_paginated_not_empty()
    {
        $products = $this->service->getPaginated(new Request);
        $this->assertNotEmpty($products);
        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $products);
    }

    /**
     * Valida si se encuentran resultados utilizando la propiedad search.
     *
     * @return void
     */
    public function test_getAll_with_search_returns_filtered_results()
    {
        $request = new Request(['q' => 'mob']);

        $allProducts = Product::all();
        $filteredProducts = $allProducts->filter(function ($product) use ($request) {
            return str_contains(strtolower($product->detail), strtolower($request->query('q')));
        });

        $searchResults = $this->service->getAll($request);
        $this->assertCount(count($filteredProducts), $searchResults);
    }
    
    /**
     * Valida si se encuentran resultados paginados utilizando la propiedad search.
     *
     * @return void
     */
    public function test_getPaginated_with_search_returns_filtered_results()
    {
        $request = new Request(['q' => 'mob']);

        $allProducts = Product::paginate(8);
        $filteredProducts = $allProducts->filter(function ($product) use ($request) {
            return str_contains(strtolower($product->detail), strtolower($request->query('q')));
        });

        $searchResults = $this->service->getPaginated($request);

        $this->assertCount(count($filteredProducts), $searchResults->items());
        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $searchResults);
    }
    
    /**
     * Valida proceso de creacion de un producto.
     *
     * @return void
     */ 
    public function test_create_with_valid_data_creates_product_and_returns_success()
    {
        $data = [
            'detail' => random_int(1, 10000).'Producto de prueba'.random_int(1, 10000),
            'description' => 'Lorem ipsum Lore ipsum...',
            'image' => $this->faker->image(),
            'id_country' => $this->faker->numberBetween(1, 10),
            'id_provider' => $this->faker->numberBetween(1, 3),
            'price' => $this->faker->randomNumber(5, true),
            'date' => $this->faker->date(),
            'id_genre' => [$this->faker->numberBetween(1, 14),$this->faker->numberBetween(1, 14)],
        ];

        $request = new Request($data);

        try {
            $product = $this->service->createProduct($request);
            $this->assertInstanceOf(Product::class, $product);
            $this->assertEquals($data['detail'], $product->detail);
            $this->assertEquals($data['description'], $product->description);
            $this->assertEquals($data['price'], $product->price);
            $this->assertEquals($data['date'], $product->date->format('Y-m-d'));
            $this->assertDatabaseHas('products', [
                'id_product' => $product->id_product,
            ]);
            // $this->assertDatabaseHas('products', $data);
            // $this->assertDatabaseHas('products', function ($query) use ($data) {
            //     dd($data);

            //     $query->where('detail', $data['detail'])
            //           ->where('price', $data['price'])
            //           ->where('description', $data['description'])
            //           ->where('date', $data['date'])
            //           ->where('id_country', $data['id_country'])
            //           ->where('id_provider', $data['id_provider']);
            // });
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
    }
    
    /**
     * Valida proceso de edicion de un producto.
     *
     * @return void
     */
    public function test_edit_with_valid_data_creates_product_and_returns_success()
    {
        try {
            $lastProduct = Product::latest()->first();
            if($lastProduct){
                $data = [
                    'detail' => random_int(1, 10000).'Producto de prueba'.random_int(1, 10000),
                    'description' => 'Lorem ipsum Lore ipsum...',
                    'image' => $this->faker->image(),
                    'id_country' => $this->faker->numberBetween(1, 10),
                    'id_provider' => $this->faker->numberBetween(1, 3),
                    'price' => $this->faker->randomNumber(5, true),
                    'date' => $this->faker->date(),
                    'id_genre' => [$this->faker->numberBetween(1, 14),$this->faker->numberBetween(1, 14)],
                ];
                
                $request = new Request($data);
                $product = $this->service->editProduct($request, $lastProduct->id_product);
                $this->assertInstanceOf(Product::class, $product);
                $this->assertEquals($data['detail'], $product->detail);
                $this->assertEquals($data['description'], $product->description);
                $this->assertEquals($data['price'], $product->price);
                $this->assertEquals($data['date'], $product->date->format('Y-m-d'));
                $this->assertDatabaseHas('products', [
                    'id_product' => $product->id_product,
                ]);
            }
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
    }   
    
    /**
     * Valida proceso de eliminacion de un producto.
     *
     * @return void
     */
    public function test_delete_with_valid_id_and_returns_success()
    {
        try {
            $lastProduct = Product::latest()->first();
            $productId = $lastProduct->id_product;
        
            $this->service->delete($productId);

            $this->assertDatabaseMissing('products', [
                'id_product' => $productId
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
    }   
}
