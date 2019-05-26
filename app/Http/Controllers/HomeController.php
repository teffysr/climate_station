<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Station;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $stations = Station::all();
        $paginatedItems = $this->paginatedItems($request,$stations);


        return response()->view('home',[
            'stations' => $paginatedItems, 
            'title' => 'Empresas', 
            'active_stations' => 'active',
            'active_percentage' => '',
            'active_calculos' => ''
            ] );
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
