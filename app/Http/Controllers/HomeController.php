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
        $partners = $this->service->getPartners();
        //$projects =  $this->service->getMajorProjects();
        $news = $this->service->getNews();
        $projects = 0;

        return view('index',array('services' => $services,
            'whatWeAre' => $whatWeAre,
            'aboutus' => $aboutUs,
            'slogans' => $slogans,
            'partners' => $partners,
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

                $members = $this->service->getTeamMembers();
                if($members) {
                    $params['members'] = $members;
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
        $officesArray = array();
        if(Cache::has('offices') && Cache::has('officesArray')) {
            $offices = Cache::get('offices');
            $officesArray = Cache::get('officesArray');
        } else {
            $offices = $this->service->getAllOffices();
            if($offices) {
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
            }

            Cache::add('offices',$offices, 120);
            Cache::add('officesArray',$officesArray,120);
        }

        // Fetching data from cms_menu table related to services menu
        $contactCMSData = $this->service->getPageData(2);

        $metaInfo = array();
        $metaInfo['meta_title'] = !empty($contactCMSData['meta_title'])? $contactCMSData['meta_title'] : 'DEPL Pvt Ltd';
        $metaInfo['meta_keyword'] = !empty($contactCMSData['meta_keyword'])? $contactCMSData['meta_keyword'] : 'DEPL Pvt Ltd';
        $metaInfo['meta_description'] = !empty($contactCMSData['meta_description'])? $contactCMSData['meta_description'] : 'DEPL Pvt Ltd';

        $officeImages = $this->service->getOfficeImages();

        return view('contact',array('offices' => $offices,
            'officesArray' => $officesArray,
            'officeImages' => $officeImages,
            'pageContent' => $contactCMSData,
            'metaInfo' => $metaInfo));
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
        // Fetching data from cms_menu table related to careers menu
        $careersCMSData = $this->service->getPageData(8);

        $metaInfo = array();
        $metaInfo['meta_title'] = !empty($careersCMSData['meta_title'])? $careersCMSData['meta_title'] : 'DEPL Pvt Ltd';
        $metaInfo['meta_keyword'] = !empty($careersCMSData['meta_keyword'])? $careersCMSData['meta_keyword'] : 'DEPL Pvt Ltd';
        $metaInfo['meta_description'] = !empty($careersCMSData['meta_description'])? $careersCMSData['meta_description'] : 'DEPL Pvt Ltd';

        $currentOpenings = $this->service->getCurrentOpenings();

        return view('careers',array('currentOpenings' => $currentOpenings, 'pageContent' => $careersCMSData, 'metaInfo' => $metaInfo));
    }

    /**
     * Get job details according to the job id
     *
     * @param integer $jobId
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function jobDetails($jobId,$slug)
    {
        if(empty($jobId) && empty($slug)) {
            return redirect(route('careers'));
        }

        $jobDetails = $this->service->getJobDetails($jobId,$slug);
        if(empty($jobDetails)) {
            return redirect(route('careers'));
        }

        return view('job-details',array('job' => $jobDetails));
    }

    /**
     * @param string|null $albumName
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function gallery($albumName = null)
    {
        $albumTitle = null;
        $albums = $this->service->getAlbums($albumName);
        $albumImages = array();
        if($albums && !empty($albumName)) {
            if(Cache::has($albums[0]->id)) {
                $albumImages = Cache::get($albums[0]->id);
            } else {
                $albumImages = $albums[0]->albumImages;
                Cache::add($albums[0]->id,$albumImages,120);
            }

            $albumTitle = ucwords($albums[0]->name);
        }

        return view('gallery',array('albums' => $albums,'albumImages' => $albumImages,'albumName' => $albumTitle));
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
