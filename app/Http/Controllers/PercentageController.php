<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\StationPercentage;
use App\Model\Station;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Service\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Routing\Redirector;


class PercentageController extends Controller
{
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $stations = Station::all();
        $paginatedItems = $this->service->paginatedItems($request,$stations);


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
            'station' => $stationId,
        	'station_percentage' => $stationPercentage, 
        	'title' => 'Valores por defecto de empresa: '. $station->name, 
        	'active_stations' => '',
            'active_percentage' => 'active',
            'active_calculos' => '',
            'save_ok' => $request->get('save_ok')] );
    }

    public function update($stationId, Request $request)
    {
        $station = Station::where('id',$stationId)->first();
        
        $data = $request->all();
        foreach ($data['id'] as $value) {
            StationPercentage::where('id', $value)
                ->update([
                    'value' => $data[$value.'_a'],
                    'value2' => $data[$value.'_b']
                ]);
        }

        $stationPercentage = StationPercentage::where('station',$stationId)->get();

        return redirect()->action(
            'PercentageController@show', ['station' => $stationId, 'save_ok' => true]
        );
    }

}
