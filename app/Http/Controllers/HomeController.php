<?php

namespace App\Http\Controllers;

use App\Http\Services\HomeService;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->service = new HomeService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    public function getPage($pageName)
    {
        $pageContent = $this->service->getPageContent($pageName);
        if($pageContent) {
            $params = array('pageContent' => $pageContent);
            if(1 == $pageContent->id) {
                $subContent = $this->service->getPageSubSections($pageContent->id);
                if($subContent) {
                    $params['subcontent'] = $subContent;
                }

                $projects = $this->service->getMajorProjects();
                if($projects) {
                    $params['projects'] = $projects;
                }
            }

            return view('page',$params);
        }

        return redirect(route('/'));
    }

    public function contactus()
    {
        $offices = $this->service->getAllOffices();
        $officesArray = array();
        foreach($offices as $office) {
            $info = $office->title.'<br/>'.$office->address.',<br/>'.$office->city.',<br/>'.$office->state.',<br/>'.$office->pincode;
            if(!empty($office->phone)) {
                $info .= "<br/> Phone = ".$office->phone;
            }

            if(!empty($office->fax)) {
                $info .= "<br/> Fax = ".$office->fax;
            }

            $officesArray[] = array(
                'google_map' => array(
                    'lat' => $office->lat,
                    'lng' => $office->lng,
                ),
                'location_address' => trim($office->address),
                'location_name'    => $office->title,
                'info' => $info
            );
        }

        return view('contact',array('offices' => $offices,'officesArray' => $officesArray));
    }
}
