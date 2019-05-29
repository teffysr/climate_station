<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Station;
use App\Model\StationValue;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Service\Service;

//StationController
class HomeController extends Controller
{
    protected $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Service $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $stations = Station::all();
        $paginatedItems = $this->service->paginatedItems($request,$stations);


        return response()->view('home',[
            'stations' => $paginatedItems, 
            'title' => 'Empresas', 
            'active_stations' => 'active',
            'active_percentage' => '',
            'active_calculos' => ''
            ] );
    }

    public function showHistory($stationId, Request $request)
    {
        $station = Station::where('id',$stationId)->first();
        $stationValue = StationValue::where('station',$stationId)->get();

        $paginatedItems = $this->service->paginatedItems($request,$stationValue);

        return response()->view('historic',[
            'title' => 'Historial climatico de estacion: '. $station->name, 
            'active_stations' => 'active',
            'active_percentage' => '',
            'active_calculos' => '',
            'stationValue' => $paginatedItems
            ] );

    }

}
