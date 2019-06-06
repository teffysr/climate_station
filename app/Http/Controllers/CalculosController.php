<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Station;
use App\Model\Variable;

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
}