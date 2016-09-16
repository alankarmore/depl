<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\NetworkService;

class NetworkController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service = new NetworkService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = $this->service->getAllStates();

        return view('network.index',array('states' => $states));
    }
    
    public function getMap(Request $request)
    {
        $state = $request->get('state');
        $network = $this->service->getRoutes($state);
        dd($network);
    }
}
