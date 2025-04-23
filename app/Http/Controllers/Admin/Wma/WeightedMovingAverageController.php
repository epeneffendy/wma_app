<?php

namespace App\Http\Controllers\Admin\Wma;

use App\Http\Controllers\Controller;
use App\Models\WeightedMovingAverage;
use App\Services\WeightedMovingAverageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function calculateWma(Request $request, WeightedMovingAverageService $weightedMovingAverageService)
    {
        $total_month = $request->total_month;
        $count_periode = $weightedMovingAverageService->countPeriode($request->all());
        $search_actual = $weightedMovingAverageService->searchActual($count_periode);
        return view('admin.weighted_moving_average.partial.show_calculate_wma', [
            'total_month' => $total_month,
            'count_periode' => $count_periode,
            'actual' => $search_actual,
            'count' => count($search_actual)
        ]);
    }

    public function countWma(Request $request, WeightedMovingAverageService $weightedMovingAverageService)
    {
        DB::beginTransaction();
        try {
            $arr_filter = [
                'count' => $request->count,
                'periode' => $request->periode,
                'year' => $request->year,
                'total_month' => $request->total_month
            ];

            $form = $request->all()['form'];
            $arr_data = [];
            for ($i = 0; $i < $request->count; $i++) {
                $arr_data[$i]['year'] = $form['year_' . $i];
                $arr_data[$i]['periode'] = $form['periode_' . $i];
                $arr_data[$i]['actual'] = $form['actual_' . $i];
                $arr_data[$i]['weight'] = $form['weight_' . $i];
            }

            $prosesWma = $weightedMovingAverageService->prosesWma($arr_data, $arr_filter);
            if ($prosesWma['success']) {
                DB::commit();
                return redirect()->route('admin.weighted_moving_average.list')->with('message', 'Proses Moving Weighted Average Success');
            } else {
                dd("failed");
                DB::rollBack();
            }
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            return back()->with('errors', $th->getMessage());
        } catch (\Exception  $e) {
            dd($e);
            DB::rollBack();
            return back()->with('errors', $e->getMessage());
        }
    }

    public function list(WeightedMovingAverageService $weightedMovingAverageService)
    {
        $data = $weightedMovingAverageService->get();
        return view('admin.weighted_moving_average.list', ['data' => $data]);
    }

    public function details(Request $request, WeightedMovingAverageService $weightedMovingAverageService){
        $data = $weightedMovingAverageService->getById($request->id);
        $details = $weightedMovingAverageService->getDetails($request->id);
        return view('admin.weighted_moving_average.details', ['data' => $data,'details'=>$details]);
    }
}
