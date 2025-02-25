<?php

namespace App\Services;
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
            for ($i = $total_month; $i > 0; --$i) {
                if ($total_month != $i) {
                    if (($params['periode'] - $i) < 1) {
                        $prev_periode = 12;
                        $prev_year = $params['year'] - 1;
                        if (($params['periode'] - $i) == 0) {
                            $periode[$i]['periode'] = $this->periode()[$prev_periode];
                            $periode[$i]['year'] = $prev_year;
                            $periode[$i]['index'] = $prev_periode;
                        } else {
                            $periode[$i]['periode'] = $this->periode()[str_pad($prev_periode - $count, 2, "0", STR_PAD_LEFT)];
                            $periode[$i]['year'] = $prev_year;
                            $periode[$i]['index'] = (int)str_pad($prev_periode - $i, 2, "0", STR_PAD_LEFT);
                            $count++;
                        }
                    } else {
                        $periode[$i]['periode'] = $this->periode()[str_pad($params['periode'] - $i, 2, "0", STR_PAD_LEFT)];
                        $periode[$i]['year'] = (int)$params['year'];
                        $periode[$i]['index'] = (int)str_pad($params['periode'] - $i, 2, "0", STR_PAD_LEFT);
                    }
                } else {
                    $periode[$i]['periode'] = $this->periode()[$params['periode']];
                    $periode[$i]['year'] = (int)$params['year'];
                    $periode[$i]['index'] = (int)$params['periode'];
                }
            }
        }

        return $periode;
    }

    public function searchActual($periode)
    {
        $actual = [];
        foreach ($periode as $ind => $item){
            $data_actual = DB::table('products_transaction')
                ->select(DB::raw('sum(total_price) as total_price'))
                ->where(['transaction_type'=>'out'])
                ->where(DB::raw('DATE_FORMAT(transaction_date,"%m")'),'=',$item['index'])->first();

            $actual[$ind]['periode']= $item['periode'];
            $actual[$ind]['year']= $item['year'];
            $actual[$ind]['actual']= ($data_actual->total_price != null) ? $data_actual->total_price : 0;
        }
        return $actual;
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
}
