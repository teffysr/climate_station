<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Station;

class CalculosController extends Controller
{
    public function index()
    {
    	$stations = Station::all();
    	return response()->view('calculos',[
        	'title' => 'Calculos', 
        	'active_stations' => '',
            'active_percentage' => '',
            'active_calculos' => 'active',
        	'stations' => $stations]);
    }
}