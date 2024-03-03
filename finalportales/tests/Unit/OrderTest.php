<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Services\OrdersService;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class OrdersServiceTest extends TestCase
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
        $this->service = new OrdersService();
    }
    
    /**
     * Verifica de obtener las ordenes de compra paginadas y que no este vacio.
     *
     * @return void
     */
    public function test_get_all_orders_not_empty()
    {
        $orders = $this->service->getAll(new Request);
        $this->assertNotEmpty($orders);
    }

     /**
     * Verifica de obtener las ordenes de compra paginadas y que no este vacio.
     *
     * @return void
     */
    public function test_get_sale_orders_not_empty()
    {
        $orders = $this->service->getSales(new Request);
        $this->assertNotEmpty($orders);
    }

    /**
     * Verifica de obtener las ordenes de compra paginadas y que no este vacio.
     *
     * @return void
     */
    public function test_get_all_orders_paginated_not_empty()
    {
        $orders = $this->service->getPaginated(new Request);
        $this->assertNotEmpty($orders);
        $this->assertInstanceOf('Illuminate\Pagination\LengthAwarePaginator', $orders);
    }

    /**
     * Valida si se encuentran resultados utilizando la propiedad search.
     *
     * @return void
     */
    public function test_getPaginated_with_search_returns_filtered_results()
    {
        $request = new Request(['q' => 'lucas']);

        $allOrders = Order::all();
        $filteredOrders = $allOrders->filter(function ($order) use ($request) {
            return str_contains(strtolower($order->user->name), strtolower($request->query('q')));
        });
        $searchResults = $this->service->getPaginated($request);
        $this->assertCount(count($filteredOrders), $searchResults);
    }
    
    /**
     * Valida proceso de creacion de una orden de compra.
     *
     * @return void
     */ 
    public function test_create_order_with_valid_data()
    {
        $product = Product::latest()->first();
        $user = User::latest()->first();
        $data = [
            'quantity' => 6,
            'id_user' => $user->id,
            'id_product' => $product->id_product,
        ];
      
        $request = new Request($data);

        try {
            $order = $this->service->createOrder($request);
            $this->assertInstanceOf(Order::class, $order);
            $this->assertEquals(true, $order->enabled);
            // dd("pendiente", strtolower($order->status));
            $this->assertEquals("pendiente", strtolower($order->status));
            $this->assertDatabaseHas('orders', [
                'id' => $order->id,
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
    }
    
    /**
     * Valida proceso de edicion de una orden de compra.
     *
     * @return void
     */
    public function test_edit_order_with_valid_data()
    {
        $order_lts = Order::latest()->where('enabled', true)->first();
        $data = [
            'status' => 'Edita estado'.random_int(1, 10000),
            'id_user' => $order_lts->id_user,
        ];

        $request = new Request($data);

        try {
            $order = $this->service->editOrder($request, $order_lts->id);
            $this->assertInstanceOf(Order::class, $order);
            $this->assertNotEquals(strtolower($order_lts->status), strtolower($order->status));
            $this->assertDatabaseHas('orders', [
                'id' => $order->id,
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
    }   
    
    /**
     * Valida proceso de edicion de cantidad de un item de una orden de compra.
     *
     * @return void
     */
    public function test_update_quantity_order_item_with_valid_data()
    {
        $order_lts = Order::latest()->where('enabled', true)->first();
        $data = [
            'item_id' => $order_lts->items[0]->id,
            'new_quantity' => $order_lts->items[0]->quantity + 5,
        ];

        $request = new Request($data);

        try {
            $orderItem = $this->service->updateQuantity($request);
            $this->assertInstanceOf(OrderItem::class, $orderItem);
            $this->assertEquals($data['new_quantity'], $orderItem->quantity);
            $this->assertDatabaseHas('order_items', [
                'id' => $orderItem->id,
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
    }   
    
    /**
     * Valida proceso de eliminacion de una orden de compra.
     *
     * @return void
     */
    public function test_delete_order_with_valid_data()
    {
        try {
            $orderId = Order::latest()->where('enabled', true)->first()->id;
        
            $this->service->delete($orderId,'admin.orders.index');

            $this->assertDatabaseMissing('orders', [
                'id' => $orderId
            ]);
        } catch (ValidationException $e) {
            $errors = $e->errors();
        }
    }   
}
