<?php

namespace App\Http\Controllers;

use Cache;
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
        $news = $this->service->getNews();
        $projects = 0;

        return view('index',array('services' => $services,
            'whatWeAre' => $whatWeAre,
            'aboutus' => $aboutUs,
            'slogans' => $slogans,
            'newsCollection' => $news,
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
        if(Cache::has('offices') && Cache::has('officesArray')) {
            $offices = Cache::get('offices');
            $officesArray = Cache::get('officesArray');
        } else {
            $offices = $this->service->getAllOffices();
            $officesArray = array();
            foreach($offices as $office) {
                $temp = new \stdClass();
                $temp->title = $office->title;
                $temp->lat = $office->lat;
                $temp->lng = $office->lng;
                $temp->address = trim(preg_replace('/\s+/', ' ', $office->address));
                $temp->address.= ",<br/>".ucfirst($office->state).",<br/>".ucfirst($office->city).",<br/>".$office->pincode;
                if(!empty($office->phone)) {
                    $temp->address .= "<br/> Phone : ".$office->phone;
                }

                if(!empty($office->fax)) {
                    $temp->address .= "<br/> Fax : ".$office->fax;
                }

                $officesArray[] = $temp;
            }

            Cache::add('offices',$offices, 120);
            Cache::add('officesArray',$officesArray,120);
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
