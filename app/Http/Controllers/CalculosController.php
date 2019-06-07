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
        	'f2' => $f2]);
    }

    public function store(Request $request)
    {
        $station = $request->get('station');
        /*calculo f1*/
        $f1 = $request->get('f1');
        $f1_us = $this->getValuesU($f1,$station);
        dump($f1_us);
       
        
        /*calculo f2*/
        $f1 = $request->get('f2');
        $f1_us = $this->getValuesU($f1,$station);
        dump($f1_us);

        //dump($f1_historic);
        //dump( $f1->value );
        //dump( $f2 );
        return 2;
    }

    public function getValuesU($f, $station) 
    {        
        $return = [];

        $f1 = StationPercentage::where('id',$f)->first();
        $f1_historic = StationValue::where('station',$station)->get();
        $f1_total = $f1_historic->count();

        if($f1->value > $f1->value2){
            /*obtengo todos los registros donde el valor del factor sea mayor a su valor base*/
            $f1_max = StationValue::where('station',$station)->where($f1->short_name,'>=',$f1->value)->get();

            $return['U1'] = $f1_max->count()/$f1_total;

            /*obtengo todos los registros donde el valor del factor sea menor a su valor base*/
            $f1_min = StationValue::where('station',$station)->where($f1->short_name,'<',$f1->value2)->get();

            $return['U2'] = $f1_min->count()/$f1_total;

        }else{

            $f1_u1 = StationValue::where('station',$station)->where($f1->short_name,'>',$f1->value2)->get();
            $return['U1'] = $f1_u1->count()/$f1_total;

            $f1_u2 = StationValue::where('station',$station)->where($f1->short_name,'<=',$f1->value2)->where($f1->short_name,'>',$f1->value)->get();
            $return['U2'] = $f1_u2->count()/$f1_total;

            $f1_u3 = StationValue::where('station',$station)->where($f1->short_name,'<',$f1->value)->get();
            $return['U3'] = $f1_u3->count()/$f1_total;
        }
        
        return $return;
    }
}