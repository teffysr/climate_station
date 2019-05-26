<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\StationPercentage;
use App\Model\Station;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class PercentageController extends Controller
{
    public function index(Request $request)
    {
        $stations = Station::all();
        $paginatedItems = $this->paginatedItems($request,$stations);


        return response()->view('percentage',[
        	'stations' => $paginatedItems, 
        	'title' => 'Empresas', 
        	'active_stations' => '',
            'active_percentage' => 'active',
            'active_calculos' => ''] );
    }

    public function show($stationId, Request $request)
    {
    	$station = Station::where('id',$stationId)->first();
        $stationPercentage = StationPercentage::where('station',$stationId)->get();
        return response()->view('percentage_value',[
        	'station_percentage' => $stationPercentage, 
        	'title' => 'Valores por defecto de empresa: '. $station->name, 
        	'active_stations' => '',
            'active_percentage' => 'active',
            'active_calculos' => ''] );
    }




    public function paginatedItems($request,$data)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($data);
        $perPage = 15;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

        return $paginatedItems;
    }
}
