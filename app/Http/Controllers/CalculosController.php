<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculosController extends Controller
{
    public function index()
    {
    	return response()->view('calculos',[
        	'title' => 'Calculos', 
        	'active_stations' => '',
            'active_percentage' => '',
            'active_calculos' => 'active']);
    }
}