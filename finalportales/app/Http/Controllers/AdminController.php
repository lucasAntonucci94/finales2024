<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\News;
use App\Models\Country;
use App\Models\Provider;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Services\ProductsService;
use App\Http\Services\NewsService;
use App\Http\Services\UsersService;
use App\Http\Services\OrdersService;


class AdminController extends Controller
{
    public function dashboard(){
        return view('admin/dashboard');
    }
    // Products FUNCTIONS
    public function getProducts(Request $request){
        $products = $this->getProductService()->getPaginated($request);
        return view('admin/products/index',[
            'products'=> $products,
            'q'=>  $request->has('q') ? $request->query('q') : null,
        ]);
    }
    public function showProduct($id){
        $product = $this->getProductService()->getById($id);
        return view('admin.products.show',[
            'product'=>$product,
        ]);
    }
    public function formCreateProduct(){
       return  $this->getProductService()->formCreate();
    }
    public function formEditProduct(int $id){
        return  $this->getProductService()->formEdit($id);
    }
    // News FUNCTIONS
    public function getNews(Request $request){
        $news = $this->getNewsService()->getPaginated($request);
        return view('admin/news/index',[
            'news'=> $news,
            'q'=>  $request->has('q') ? $request->query('q') : null,
        ]);
    }
    public function showNew($id){
        $new = $this->getNewsService()->getById($id);
        return view('admin.news.show',[
            'new'=>$new,
        ]);
    }
    public function formCreateNew(){
       return  $this->getNewsService()->formCreate();
    }
    public function formEditNew(int $id){
        return  $this->getNewsService()->formEdit($id);
    }
    // USERS FUNCTIONS
    public function getUsers(Request $request){
        $users = $this->getUsersService()->getPaginated($request);
        return view('admin/users/index',[
            'users'=> $users,
            'q'=>  $request->has('q') ? $request->query('q') : null,
        ]);
    }
    public function showUser($id){
        $user = $this->getUsersService()->getById($id);
        return view('admin.users.show',[
            'user'=>$user,
        ]);
    }
    public function formCreateUser(){
        return  $this->getUsersService()->formCreate();
    }
    public function formEditUser(int $id){
        return  $this->getUsersService()->formEdit($id);
    }
    // ORDERS/PEDIDOS FUNCTIONS
    public function getOrders(Request $request){
        $orders = $this->getOrdersService()->getPaginated($request);

        return view('admin/orders/index',[
            'orders'=> $orders,
            'q'=>  $request->has('q') ? $request->query('q') : null,
        ]);
    }
    public function showOrder($id){
        $total = 0;
        $items = [];
        $order = $this->getOrdersService()->getById($id);
        if($order !== null && $order->items !== null){
            foreach ($order->items as $item) {
                $items[] = $item; //Order items, este tiene la caracteristicas del producto y la cantidad ingresada.
                $total += $item->product->price * $item->quantity;
            }
        }
        return view('admin.orders.show',[
            'order'=> $order,
            'items'=> $items,
            'total'=> $total,
        ]);
    }
    public function formEditOrder(int $id){
        return  $this->getOrdersService()->formEdit($id);
    }

    public function showUserOrders($id,$backurl){
        $ordersToShow = [];
        $user = $this->getUsersService()->getById($id);
        $orders = $this->getOrdersService()->getAllByUserId($id);
        
        if($orders !== null){
            foreach ($orders as $order) {
                $total = 0;
                $items = [];
                if($order !== null && $order->items !== null){
                    foreach ($order->items as $item) {
                        $items[] = $item; //Order items, este tiene la caracteristicas del producto y la cantidad ingresada.
                        $total += $item->product->price * $item->quantity;
                    }
                }
                if ($order && $order->items) {
                    $ordersToShow[] = [
                      'order_id' => $order->id,
                      'items' => $order->items,
                      'status' => $order->status,
                      'total' => $total,
                      'backurl'=>$backurl,
                    ];
                }
            }
        }
        return view('admin.users.orders.show',[
            'orders'=>$ordersToShow,
            'user'=>$user,
        ]);
    }
    // GET SERVICES INTANCES
    public function getProductService(){
        return new ProductsService;
    }
    public function getNewsService(){
        return new NewsService;
    }
    public function getUsersService(){
        return new UsersService;
    }
    public function getOrdersService(){
        return new OrdersService;
    }
}
