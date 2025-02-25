<?php

namespace App\Http\Controllers\Admin\Wma;

use App\Http\Controllers\Controller;
use App\Models\WeightedMovingAverage;
use App\Services\WeightedMovingAverageService;
use Illuminate\Http\Request;

class WeightedMovingAverageController extends Controller
{
    public function index(WeightedMovingAverageService $weightedMovingAverageService)
    {
        $periode = $weightedMovingAverageService->periode();
        $year_now = date('Y');
        $year = [];
        for ($i = 3; $i >= 0; --$i) {
            $year[$i] = $year_now - $i;
        }
        return view('admin.weighted_moving_average.index', ['periode' => $periode, 'year' => $year]);
    }

    public function calculateWma(Request $request, WeightedMovingAverageService $weightedMovingAverageService){
        $total_month = $request->total_month;
        $count_periode = $weightedMovingAverageService->countPeriode($request->all());
        return view('admin.weighted_moving_average.partial.show_calculate_wma', ['total_month' => $total_month]);
    }
}
