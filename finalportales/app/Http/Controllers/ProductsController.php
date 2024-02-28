<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Country;
use App\Models\Provider;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Services\ProductsService;
use App\Http\Services\OrdersService;

class ProductsController extends Controller
{

    public function getAll(Request $request){
        $products = $this->getProductService()->getAll($request);
        // dd(auth()->user());
        $orders = (auth()->user() == null) ? [] : $this->getOrdersService()->getByUserId(auth()->user()->id);

        return view('products/index',[
            'products'=> $products,
            'orders'=> $orders,
            'q'=> $request->has('q') ? $request->query('q') : null,
        ]);
    }

    public function showProduct($id){
        $product = $this->getProductService()->getById($id);
        return view('products.show',[
            'product'=>$product,
        ]);
    }

    public function showOrderProduct($id){
        $product = $this->getProductService()->getById($id);
        return view('orders.item.show',[
            'product'=>$product,
        ]);
    }

    public function createProduct(Request $request){
        return  $this->getProductService()->createProduct($request);
    }

    public function editProduct(Request $request, int $id){
        return  $this->getProductService()->editProduct($request,$id);
    }

    public function deleteProduct(int $id){
        return  $this->getProductService()->delete($id);
    }

    public function getProductService(){
        return new ProductsService;
    }
    public function getOrdersService(){
        return new OrdersService;
    }

    protected function toRoute(string $route, array $messages = []){
        $redirect = redirect()->route($route);
        foreach($messages as $type => $message){
            $redirect->with('message.'.$type, $message);
        }
        return $redirect;
    }
}
