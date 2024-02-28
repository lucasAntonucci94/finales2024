<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Genre;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class StatisticsService
{
    public function getProductLiquidation($orders,$chartType)
    {
        $allItems = [];
        $arrayKeyValue = [];

        // recorro las ordenes de pedidos, y guardo todos los productos
        foreach($orders as $order){
            foreach($order->items as $item) $allItems[] = $item;
        }

        // los agrupo por producto
        $groupedItems = collect($allItems)->groupBy(function ($item) {
            return $item->product->id_product;
        });
        // los mappeo a un array con id producto y total (cantidad total * precio del producto)
        $mappedArray = $groupedItems->map(function ($items, $id) {
            $totalQuantity = $items->sum('quantity');
            $totalPrice = $totalQuantity * $items->first()->product->price;
            return [
                $items->first()->product->detail,
                $totalPrice,
            ];
        })->values()->toArray();

        foreach ($mappedArray as $item) {
            $arrayKeyValue[$item[0]] = $item[1];
        }  

        return [
            'data' => $arrayKeyValue,
            'title' => 'Liquidacion total por producto',
            'packages' => 'corechart',
            'headersChart' => ['Producto', 'Total'],
            'selectedChartType' => $chartType,
          ];
    }
    public function getProductBestSellers($orders,$chartType)
    { 
        $allItems = [];
        $arrayKeyValue = [];

        // recorro las ordenes de pedidos, y guardo todos los productos
        foreach($orders as $order){
            foreach($order->items as $item) $allItems[] = $item;
        }
        // los agrupo por producto
        $groupedItems = collect($allItems)->groupBy(function ($item) {
            return $item->product->id_product;
        });
        // los mappeo a un array con id producto y total (cantidad total * precio del producto)
        $mappedArray = $groupedItems->map(function ($items, $id) {
            $totalQuantity = $items->sum('quantity');
            return [
                $items->first()->product->detail,
                $totalQuantity,
            ];
        })->values()->toArray();

        foreach ($mappedArray as $item) {
            $arrayKeyValue[$item[0]] = $item[1];
        }  
        return [
            'data' => $arrayKeyValue,
            'title' => 'Cantidad total vendida por producto',
            'packages' => 'corechart',
            'headersChart' => ['Producto', 'Cantidad'],
            'selectedChartType' => $chartType,
          ];
    }
    public function getTotalProductByUser($orders,$chartType)
    {
        $arrayKeyValue = [];
        $groupedItems = collect($orders)->groupBy(function ($item) {
            return $item->id_user;
        });
        // los mappeo a un array con nombre de usuario y total (cantidad total de productos COMPRADOS)
        $mappedArray = $groupedItems->map(function ($orders, $id) {
            $orderQuantity = 0;
            $totalQuantity = 0;
            foreach($orders as $order){
                $orderQuantity = $order->items->sum('quantity');
                $totalQuantity += $orderQuantity;
            }
            return [
                $orders->first()->user->name,
                $totalQuantity,
            ];
        })->values()->toArray();

        foreach ($mappedArray as $item) {
            $arrayKeyValue[$item[0]] = $item[1];
        }  

        return [
            'data' => $arrayKeyValue,
            'title' => 'Cantidad total de productos comprados por usuario',
            'packages' => 'corechart',
            'headersChart' => ['Usuario', 'Total'],
            'selectedChartType' => $chartType,
          ];
    }
    public function getCountOrdersByUser($orders,$chartType)
    {
        $arrayKeyValue = [];
        // los agrupo por id de usuario
        $groupedItems = collect($orders)->groupBy(function ($item) {
            return $item->id_user;
        });
        // los mappeo a un array con nombre de usuario y total (cantidad total de productos COMPRADOS)
        $mappedArray = $groupedItems->map(function ($orders) {
            return [
                $orders->first()->user->name,
                Count($orders),
            ];
        })->values()->toArray();

        foreach ($mappedArray as $item) {
            $arrayKeyValue[$item[0]] = $item[1];
        }  
        return [
            'data' => $arrayKeyValue,
            'title' => 'Pedidos finalizados por usuario',
            'packages' => 'corechart',
            'headersChart' => ['Usuario', 'Total'],
            'selectedChartType' => $chartType,
          ];
    }
    public function getTotalLiquidationByUser($orders,$chartType)
    {
        $arrayKeyValue = [];
        // los agrupo por id de usuario
        $groupedItems = collect($orders)->groupBy(function ($item) {
            return $item->id_user;
        });
        // los mappeo a un array con nombre de usuario y total (cantidad total de productos COMPRADOS)
        $mappedArray = $groupedItems->map(function ($orders, $id) {
            $orderQuantity = 0;
            $totalQuantity = 0;
            $user = User::where('id', $id)->first();
            foreach($orders as $order){
                $totalOrder = 0;
                foreach($order->items as $item){
                    $totalOrder = $item->quantity * $item->product->price;
                }
                $totalQuantity += $totalOrder;
            }
            return [
                $user->name,
                $totalQuantity,
            ];
        })->values()->toArray();

        foreach ($mappedArray as $item) {
            $arrayKeyValue[$item[0]] = $item[1];
        }  

        return [
            'data' => $arrayKeyValue,
            'title' => 'Liquidacion total por producto',
            'packages' => 'corechart',
            'headersChart' => ['Usuario', 'Total'],
            'selectedChartType' => $chartType,
          ];
    }
    public function getproductsByCategoty($chartType)
    {
        $arrayKeyValue = [];
        $results = [];
        $genres = Genre::with('products')->get();
        $products = Product::all();
        foreach ($genres as $genre) {
            $productCount = $genre->products !== null ? $genre->products->count() : 0;
            $results[] = [$genre->name,$productCount];
        }
        foreach ($results as $item) {
            $arrayKeyValue[$item[0]] = $item[1];
        }  
        return [
            'data' => $arrayKeyValue,
            'title' => 'Productos por categoria',
            'packages' => 'corechart',
            'headersChart' => ['Categoria', 'Productos'],
            'selectedChartType' => $chartType,
          ];
    }
    public function getSalesByCategory($orders,$chartType)
    {
        $arrayKeyValue = [];
        $results = [];
        $products = Product::all();
        $genres = Genre::with('products')->get();
        if(Count($orders) > 0){
            foreach ($genres as $genre) {
                $totalLiquidation = 0;
                foreach ($orders as $order) {
                    $orderItems = $order->items;
                    foreach ($orderItems as $item) {
                        $collection = collect($item->product->genres);
                        $genreId = $genre->id_genre;
                        $hasGenre = $collection->contains(function ($prodGenre) use ($genreId) {
                            return $prodGenre['id_genre'] === $genreId;
                        });
                        if ($hasGenre) $totalLiquidation += $item->product->price * $item->quantity; 
                    }
                }
                $results[] = [$genre->name,$totalLiquidation];
            }
            foreach ($results as $item) {
                $arrayKeyValue[$item[0]] = $item[1];
            }
        }

        return [
            'data' => $arrayKeyValue,
            'title' => 'Liquidacion por categoria',
            'packages' => 'corechart',
            'headersChart' => ['Categoria', 'Total'],
            'selectedChartType' => $chartType,
          ];
    }
}
