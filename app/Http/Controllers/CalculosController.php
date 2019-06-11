<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Station;
use App\Model\Variable;
use App\Model\StationPercentage;
use App\Model\StationValue;
use App\Model\AreaCurvaNormal;
use DB;


class CalculosController extends Controller
{
    public function index()
    {
    	$stations = Station::all();
    	$f1 = Variable::all() ;
    	$f2 = $f1;
    	return response()->view('calculos_st',[
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

        /*CALCULO TABLA PROBABILIDAD*/
        foreach ($f1_us as $key1 => $value1) {
            $array[0][] = $key1;
        }

        foreach ($f2_us as $key2 => $value2) {
            foreach ($f1_us as $key1 => $value1) {
                $v = ($value1 + $value2)/2;
                $array[$key2][$key1] = $v;
            }
        }

        /*CALCULO Y1--Y2*/
        $calculo_y = $this->getCalculoY($request,$f1,$f2,$station);
        

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
                'tdp' => $array,
                'calculo_y' => $calculo_y
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

    public function getCalculoY($request,$f1,$f2,$station)
    {
        $calculo_y = [];
        if($request->get('y1')&&$request->get('y2')) {
            $calculo_y['f1']['model'] = Variable::where('id',$f1)->first();
            $calculo_y['f2']['model'] = Variable::where('id',$f2)->first();

            $calculo_y['f1']['v'] = StationValue::where('station',$station)->select(DB::raw('AVG('.$calculo_y['f1']['model']->name.') as media'),DB::raw('STD('.$calculo_y['f1']['model']->name.') as desviacion'))->first();
            
            $calculo_y['f2']['v'] = StationValue::where('station',$station)->select(DB::raw('AVG('.$calculo_y['f2']['model']->name.') as media'), DB::raw('STD('.$calculo_y['f2']['model']->name.') as desviacion'))->first();

            $calculo_y['f1']['z'] = ($request->get('y1')-($calculo_y['f1']['v']->media/$calculo_y['f1']['v']->desviacion));
            $calculo_y['f2']['z'] = ($request->get('y2')-($calculo_y['f2']['v']->media/$calculo_y['f2']['v']->desviacion));

            /*area curva normal*/
            if($calculo_y['f1']['z'] < 0 && $calculo_y['f2']['z'] < 0){
                $z1 = $calculo_y['f1']['z']*(-1);
                $z2 = $calculo_y['f2']['z']*(-1);
            }else{
                $z1 = $calculo_y['f1']['z'];
                $z2 = $calculo_y['f2']['z'];
            }

            $x1 = explode('.', $z1);

            $zeta1 = $x1[0].'.'.$x1[1][0];
            $zeta1_= $x1[1][1];

            $x2 = explode('.', $z2);

            $zeta2 = $x2[0].'.'.$x2[1][0];
            $zeta2_= $x2[1][1];

            $Q_z2 = DB::table('area_curva_normal')
                ->select($zeta2_.' as zeta')
                ->whereRaw('z = '.$zeta2)
                ->first();
                
            $Q_z1 = DB::table('area_curva_normal')
                ->select($zeta1_.' as zeta')
                ->whereRaw('z = '.$zeta1)
                ->first();

            $calculo_y['Q_z1'] = $Q_z1?$Q_z1->zeta:0;
            $calculo_y['Q_z2'] = $Q_z2?$Q_z2->zeta:0;

            $calculo_y['porcentaje'] = ($calculo_y['Q_z1']+$calculo_y['Q_z2'])*100;
        }

        return $calculo_y;
    }
}