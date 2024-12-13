<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Bbsnly\ChartJs\Chart;
use Bbsnly\ChartJs\Config\Data;
use Bbsnly\ChartJs\Config\Dataset;
use Bbsnly\ChartJs\Config\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        $catigories_count = Category::count();
        $products_count = Product::count();
        $clients_count = Client::count();
        $users_count = User::role('admin')->count();

        $sales_data = Order::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_price) as total_price')
        )->groupBy('month','year')->get();

        $chart = new Chart;
        $chart->type = 'line';
        
        $data = new Data();
        $data->labels = ['Red', 'Green', 'Blue'];

        $dataset = new Dataset();
        $dataset->data = [14, 19, 3, 5, 2, 3];
        $data->datasets[] = $dataset->data;

        $chart->data($data);

        $options = new Options();
        $options->responsive = true;
        $chart->options($options);

        $chart->get();
        $chart->toJson();
        $chart->toHtml('my_chart');

        $sales_data_values = $sales_data->pluck('total_price')->toArray();
        $sales_labels = $sales_data->map(function ($item) {
            return $item->month . '-' . $item->year;
        })->toArray();

        return view('dashboard.home', compact(
            'catigories_count', 
            'products_count', 
            'clients_count',
            'users_count',
            'sales_data',
            'chart',
            'sales_labels',
            'sales_data_values'
        ));
    }
}
