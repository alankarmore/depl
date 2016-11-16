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
        // Fetching data from cms_menu table related to services menu
        $serviceCMSData = $this->service->getServiceCMSData();

        $metaInfo = array();
        $metaInfo['meta_title'] = !empty($serviceCMSData['meta_title'])? $serviceCMSData['meta_title'] : 'DEPL Pvt Ltd';
        $metaInfo['meta_keyword'] = !empty($serviceCMSData['meta_keyword'])? $serviceCMSData['meta_keyword'] : 'DEPL Pvt Ltd';
        $metaInfo['meta_description'] = !empty($serviceCMSData['meta_description'])? $serviceCMSData['meta_description'] : 'DEPL Pvt Ltd';

        return view('services.index',array('services' => $services,'pageContent' => $serviceCMSData,'metaInfo' => $metaInfo));
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
