<?php

namespace App\Services;
class WeightedMovingAverageService
{
    public function countPeriode($params)
    {
        $total_month = (int)$params['total_month'];
        $label_periode = $this->periode()[$params['periode']];
        if ($params['total_month'] > 1){
            $label_periode = [];
            for ($i = $total_month; $i > 0; --$i) {
                if ($total_month != $i){
                    $label_periode[$i] = str_pad($params['periode'] - $i,2,"0",STR_PAD_LEFT) ;
                }else{
                    $label_periode[$i] = $params['periode'];
                }

            }
        }
        dd($label_periode);
        dd($params);
    }

    public function periode(){
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
