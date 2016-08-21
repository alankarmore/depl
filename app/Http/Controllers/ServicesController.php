<?php

namespace App\Http\Controllers;

use App\Http\Services\ServicesService;

class ServicesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service = new ServicesService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = $this->service->getAllServices();

        return view('services.index',array('services' => $services));
    }

    /**
     * Get details according to the name of service
     *
     * @param string $name
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getDetails($name)
    {
        $service = $this->service->getServiceDetails($name);
        if($service->count()) {
            $params  = array('service' => $service);
            $workFlows = $this->service->getServiceWorkFlows($service->id);
            if($workFlows->count()) {
                $params['workFlows'] = $workFlows;
            }

            return view('services.details',$params);
        }

        return redirect(route('services'));
    }
}
