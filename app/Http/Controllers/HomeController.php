<?php

namespace App\Http\Controllers;

use App\Http\Services\HomeService;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\CareersRequest;

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
        $services = $this->service->getServices();
        $whatWeAre = $this->service->getWhatWeAreContent();
        $aboutUs = $this->service->getPageContent('about-us');
        $slogans = $this->service->getSlogans();
        //$projects =  $this->service->getMajorProjects();
        $projects = 0;

        return view('index',array('services' => $services,
            'whatWeAre' => $whatWeAre,
            'aboutus' => $aboutUs,
            'slogans' => $slogans,
            'projects' => $projects,));
    }

    /**
     * Showing cms content for the page
     *
     * @param string $pageName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function getPage($pageName)
    {
        $pageContent = $this->service->getPageContent($pageName);
        if($pageContent) {
            $metaInfo = array('meta_title' => $pageContent->meta_title,'meta_keyword' => $pageContent->meta_keyword,'meta_description' => $pageContent->meta_keyword);
            $params = array('pageContent' => $pageContent,'metaInfo' => $metaInfo);
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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactus()
    {
        $offices = $this->service->getAllOffices();
        $officesArray = array();
        foreach($offices as $office) {
            $office->address = str_replace(array("\r\n","<br/>","<br>"),array(" "),trim($office->address));
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
                'location_address' => $office->address,
                'location_name'    => $office->title,
                'info' => $info
            );
        }

        return view('contact',array('offices' => $offices,'officesArray' => $officesArray));
    }

    /**
     * Posting contact information and sending mail to customer and admin team
     *
     * @param ContactRequest $request
     * @return RedirectResponse
     */
    public function postContactUs(ContactRequest $request)
    {
        $inputData = $request->all();
        $posted = $this->service->saveInquiry($inputData);
        if($posted) {
            return redirect(route('contactus'))->with('success','Thank you for sending message to us. We will get back to you very soon');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Showing careers form to user
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function careers()
    {
        return view('careers');
    }

    /**
     * Posting careers form and sending mail to admin as well as to customer
     *
     * @param CareersRequest $request
     * @return RedirectResponse
     */
    public function postCareers(CareersRequest $request)
    {
        $inputData = $request->all();
        $posted = $this->service->saveCareersRequest($inputData);
        if($posted) {
            return redirect(route('careers'))->with('success','Thank you for sending message to us. We will get back to you very soon');
        }

        return redirect()->back()->withInput();
    }
}
