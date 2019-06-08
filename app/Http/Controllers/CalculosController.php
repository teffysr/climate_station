<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Station;
use App\Model\Variable;
use App\Model\StationPercentage;
use App\Model\StationValue;


class CalculosController extends Controller
{
    public function index()
    {
    	$stations = Station::all();
    	$f1 = Variable::all() ;
    	$f2 = $f1;
    	return response()->view('calculos',[
        	'title' => 'Calculos', 
        	'active_stations' => '',
            'active_percentage' => '',
            'active_calculos' => 'active',
        	'stations' => $stations,
        	'f1' => $f1,
        	'f2' => $f2
        ]);
    }

    public function store(Request $request)
    {
        $stations = Station::all();
        $f1_variables = Variable::all() ;
        $f2_variables = $f1_variables;

        $station = $request->get('station');
        /*calculo f1*/
        $f1 = $request->get('f1');
        $f1_us = $this->getValuesU($f1,$station,1);
        /*calculo f2*/
        $f2 = $request->get('f2');
        $f2_us = $this->getValuesU($f2,$station,2);

        foreach ($f1_us as $key1 => $value1) {
            $array[0][] = $key1;
        }

        foreach ($f2_us as $key2 => $value2) {
            foreach ($f1_us as $key1 => $value1) {
                /*var valor = (parseFloat($(u1[j]).val())+parseFloat($(u2[i]).val()))/2;
                    console.log(valor + $(u1[j]).attr('id'));*/

                $v = ($value1 + $value2)/2;
                $array[$key2][$key1] = $v;
            }
        }

        return response()->view('calculos_st',[
            'title' => 'Calculos', 
            'active_stations' => '',
            'active_percentage' => '',
            'active_calculos' => 'active',
            'request' => $request->all(),
            'stations' => $stations,
            'f1' => $f1_variables,
            'f2' => $f2_variables,
            'data' => [
                'f1' => $f1_us,
                'f2' => $f2_us,
                'tdp' => $array
            ]
        ]);
    }

    public function getValuesU($f, $station,$u) 
    {        
        $return = [];

        $f1 = StationPercentage::where('id',$f)->first();
        $f1_historic = StationValue::where('station',$station)->get();
        $f1_total = $f1_historic->count();

        if($f1->value > $f1->value2){
            /*obtengo todos los registros donde el valor del factor sea mayor a su valor base*/
            $f1_max = StationValue::where('station',$station)->where($f1->short_name,'>=',$f1->value)->get();

            $return['U&sup'.$u.';+'] = $f1_max->count()/$f1_total;

            /*obtengo todos los registros donde el valor del factor sea menor a su valor base*/
            $f1_min = StationValue::where('station',$station)->where($f1->short_name,'<',$f1->value2)->get();

            $return['U&sup'.$u.';-'] = $f1_min->count()/$f1_total;

        }else{

            $f1_u1 = StationValue::where('station',$station)->where($f1->short_name,'>',$f1->value2)->get();
            $return['U&sup'.$u.';+'] = $f1_u1->count()/$f1_total;

            $f1_u2 = StationValue::where('station',$station)->where($f1->short_name,'<=',$f1->value2)->where($f1->short_name,'>',$f1->value)->get();
            $return['U&sup'.$u.';°'] = $f1_u2->count()/$f1_total;

            $f1_u3 = StationValue::where('station',$station)->where($f1->short_name,'<',$f1->value)->get();
            $return['U&sup'.$u.';-'] = $f1_u3->count()/$f1_total;
        }

        return $return;
    }
}