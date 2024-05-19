<?php

namespace App\Http\Controllers;

use App\Charts\UsersChart;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function usersChart()
    {
        $chart = new UsersChart();
        return view('users_chart', ['chart' => $chart]);
    }
}
