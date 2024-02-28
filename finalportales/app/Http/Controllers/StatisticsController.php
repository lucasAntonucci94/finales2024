<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Http\Services\StatisticsService;
use App\Http\Services\OrdersService;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class StatisticsController extends Controller
{
    public function showIndex(){
        $allItems = [];
        $orders = $this->getOrdersService()->getSales();
        $response = $this->getStatisticsService()->getProductBestSellers($orders,1);
        
        return view('admin/statistics/index', [
            'data' => $response['data'],
            'title' => $response['title'],
            'packages' => $response['packages'],
            'headersChart' => ['Producto', 'Total'],
            'selectedChartType' => 1,
          ]);
    }
    public function getById(Request $request)
    {
        $allItems = [];
        $response = null;
        $orders = $this->getOrdersService()->getSales();
        $chartType = (int)$request->get('chartTypeId');
        
        switch ($chartType) {
            case 1:
                $response = $this->getStatisticsService()->getProductBestSellers($orders,$chartType);
                return view('admin/statistics/index', $response);
                break;

            case 2:
                $response = $this->getStatisticsService()->getTotalProductByUser($orders,$chartType);
        
                return view('admin/statistics/index', $response);
                break;

            case 3:
                $response = $this->getStatisticsService()->getProductLiquidation($orders,$chartType);
        
                return view('admin/statistics/index', $response);
                break;
            case 4:
                $response = $this->getStatisticsService()->getTotalLiquidationByUser($orders,$chartType);
        
                return view('admin/statistics/index', $response);
                break;

            case 5:
                $response = $this->getStatisticsService()->getCountOrdersByUser($orders,$chartType);
            
                return view('admin/statistics/index', $response);
                break;
            case 6:
                $response = $this->getStatisticsService()->getproductsByCategoty($chartType);
            
                return view('admin/statistics/index', $response);
                break;
            case 7:
                $response = $this->getStatisticsService()->getSalesByCategory($orders,$chartType);
            
                return view('admin/statistics/index', $response);
                break;
           
            default:
                $response = $this->getStatisticsService()->getProductBestSellers($orders,$chartType);
            
                return view('admin/statistics/index', $response);
                break;
        }
    }
    public function getStatisticsService(){
        return new StatisticsService;
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
