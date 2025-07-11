<?php

namespace App\Services;

use App\Models\WeightedMovingAverage;
use App\Models\WeightedMovingAverageDetail;
use Illuminate\Support\Facades\DB;

class WeightedMovingAverageService
{
    public function countPeriode($params)
    {
        $total_month = (int)$params['total_month'];
        $periode[0]['periode'] = $this->periode()[$params['periode']];
        $periode[0]['year'] = (int)$params['year'];
        $periode[0]['index'] = (int)$params['periode'];
        if ($params['total_month'] > 1) {
            $periode = [];
            $count = 1;
            for ($i = 0; $i < $total_month; $i++) {
                if ($i == 0) {
                    $periode[$i]['periode'] = $this->periode()[$params['periode']];
                    $periode[$i]['year'] = (int)$params['year'];
                    $periode[$i]['index'] = (int)$params['periode'];
                } else {
                    if (($params['periode'] - $i) > 0) {
                        $periode[$i]['periode'] = $this->periode()[str_pad($params['periode'] - $i, 2, "0", STR_PAD_LEFT)];
                        $periode[$i]['year'] = (int)$params['year'];
                        $periode[$i]['index'] = (int)$params['periode'] - $i;
                    } else {
                        $prev_periode = 12;
                        $prev_year = $params['year'] - 1;
                        if (str_pad($params['periode'] - $i, 2, "0", STR_PAD_LEFT) == "00") {
                            $periode[$i]['periode'] = $this->periode()[$prev_periode];
                            $periode[$i]['year'] = $prev_year;
                            $periode[$i]['index'] = $prev_periode;
                        } else {
                            $periode[$i]['periode'] = $this->periode()[str_pad($prev_periode - $count, 2, "0", STR_PAD_LEFT)];
                            $periode[$i]['year'] = $prev_year;
                            $periode[$i]['index'] = (int)str_pad($prev_periode - $count, 2, "0", STR_PAD_LEFT);
                            $count++;
                        }
                    }
                }
            }
        }
        return $periode;
    }

    public function searchActual($periode)
    {
        $actual = [];
        foreach ($periode as $ind => $item) {
            $period = str_pad($item['index'], 2, "0", STR_PAD_LEFT);

            $data_actual = DB::table('products_transaction')
                ->select(DB::raw('sum(total_price) as total_price'))
                ->where(['transaction_type' => 'out'])
                ->where(DB::raw('DATE_FORMAT(transaction_date,"%m")'), '=', $period)->first();

            $actual[$ind]['index'] = $item['index'];
            $actual[$ind]['periode'] = $item['periode'];
            $actual[$ind]['year'] = $item['year'];
            $actual[$ind]['actual'] = ($data_actual->total_price != null) ? $data_actual->total_price : 0;
        }
        return $actual;
    }

    public function prosesWma($arr_data, $arr_filter)
    {
        $message = '';
        $success = true;
        $wma_id = $this->insertWma($arr_filter);
        $total_weight = 0;
        $actual = 0;
        if ($wma_id) {
            foreach ($arr_data as $ind => $item) {
                $total_actual = $item['actual'] * $item['weight'];
                $total_weight += $item['weight'];
                $arr_detail = [
                    'weighted_moving_average_id' => $wma_id,
                    'year' => $item['year'],
                    'periode' => $item['periode'],
                    'actual_periode' => $item['actual'],
                    'weight' => $item['weight'],
                    'total' => $total_actual
                ];
                $detail = WeightedMovingAverageDetail::insert($arr_detail);
                $actual += $total_actual;
                if (!$detail) {
                    $success = false;
                    $message = 'Add WMA Detail failed!';
                }
            }
        } else {
            $success = false;
            $message = 'Add WMA failed!';
        }

        if ($success) {

            $updateActual = $this->updateTotalActual($wma_id, $actual, $total_weight);
            if (!$updateActual) {
                $success = false;
                $message = 'Update Actual failed!';
            }
        }

        return ['success' => $success, 'message' => $message];
    }

    public function updateTotalActual($wma_id, $actual, $weight)
    {
        $payload['actual_wma'] = $actual / $weight;
        $payload['weighted_average'] = $weight;
        $data = WeightedMovingAverage::where(['id' => $wma_id])->update($payload);
        return $data;
    }

    public function insertWma($payload)
    {
        $arr_data['periode'] = $payload['periode'];
        $arr_data['year'] = $payload['year'];
        $arr_data['number_of_month'] = $payload['total_month'];
        $arr_data['actual_wma'] = 0;
        $arr_data['weighted_average'] = 0;
        $arr_data['created_by'] = 0;
        $wma = WeightedMovingAverage::insertGetId($arr_data);
        return $wma;
    }

    public function periode()
    {
        $periode = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return $periode;
    }

    public function get()
    {
        $data = WeightedMovingAverage::get();
        return $data;
    }

    public function getDetails($id)
    {
        $data = WeightedMovingAverageDetail::where(['weighted_moving_average_id' => $id])->get();
        return $data;
    }

    public function getById($id)
    {
        $data = WeightedMovingAverage::where(['id' => $id])->first();
        return $data;
    }

    public function getByMonth($month)
    {
        $data = WeightedMovingAverage::where(DB::raw('DATE_FORMAT(updated_at,"%Y-%m")'), '=', $month)->get();
        return $data;
    }

    public function countDays($params)
    {
        $total_days = (int)$params['total_days'];

        $arr_weight = [];
        $total_item_weight = 0;
        if ($params['total_days'] > 1) {
            for ($i = 0; $i < $total_days; $i++) {
                if ($total_item_weight == 0) {
                    for ($x = 0; $x < ($total_days - $i); $x++) {
                        $total_item_weight += ($total_days - $i) - $x;
                    }
                }
                $arr_weight[$i] = ($total_days - $i) / $total_item_weight;
            }
        }
        return $arr_weight;
    }

    public function searchActualStock($date_periode, $total_days, $count_days)
    {

        $arr_date = [];
        $new_date = '';
        for ($i = 1; $i <= $total_days; $i++) {
            $new_date = date('Y-m-d', strtotime('-' . $total_days - $i . ' days', strtotime($date_periode)));
            $arr_date[$new_date] = $new_date;
            $arr_date[$new_date] = $count_days[$i - 1];
        }
dd(ksort($count_days));
        $actual = [];
        foreach ($arr_date as $ind => $item) {
            $data_actual = DB::table('products_transaction')
                ->select(DB::raw('sum(qty) as total_qty'))
                ->where(['transaction_type' => 'out'])
                ->where(DB::raw('DATE_FORMAT(transaction_date,"%Y-%m-%d")'), '=', $item)->first();

            $actual[$ind]['date'] = $arr_date[$item];
            $actual[$ind]['actual'] = ($data_actual->total_qty != null) ? $data_actual->total_qty : 0;
        }
        return $actual;
    }
}
