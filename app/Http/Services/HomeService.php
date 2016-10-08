<?php

namespace App\Http\Services;

use App\OurService;
use App\Slogan;
use Mail;
use App\Career;
use App\OfficeImage;
use App\OurOffice;
use App\Project;
use App\CMSMenu;
use App\News;
use App\Inquiry;

class HomeService
{

    /**
     * Get page content according to the page name
     *
     * @param string $pageName
     * @return bool|Array
     */
    public function getPageContent($pageName)
    {
        $pageContent = CMSMenu::select('id','title','description','image','meta_title','meta_keyword','meta_description')
                               ->where('slug','=',strtolower($pageName))
                               ->first();
        if($pageContent->count()) {
            return $pageContent;
        }

        return false;
    }

    /**
     * Get page sub contents
     *
     * @param integer $id
     * @return \App\CMSMenu | bool
     */
    public function getPageSubSections($id)
    {
        $subContent = CMSMenu::select('id','title','description')
            ->where('include_in','=',$id)
            ->first();
        if($subContent->count()) {
            return $subContent;
        }

        return false;
    }

    /**
     * Get all major projects done
     *
     * @return Project | bool
     */
    public function getMajorProjects()
    {
        $projects = Project::select('id','title','slug','description','state','project_type','image','company','length','completion_date')
                             ->where('status','=',\DB::raw(1))
                             ->take(4)
                             ->get();
        if($projects->count()) {
            return $projects;
        }

        return false;
    }

    /**
     * Get latest top services for home page
     *
     * @return mixed \App\OurService|boolean
     */
    public function getServices()
    {
        $services = OurService::select('id','title','slug','description','image')
            ->where('status','=',\DB::raw(1))
            ->take(4)
            ->get();
        if($services->count()) {
            return $services;
        }

        return false;
    }

    /**
     * Get all offices
     *
     * @return OurOffice | bool
     */
    public function getAllOffices()
    {
        $offices = OurOffice::select('id','title','state','city','address','pincode','phone','fax','lat','lng')
            ->where('status','=',\DB::raw(1))
            ->take(5)
            ->get();
        if($offices->count()) {
            return $offices;
        }

        return false;
    }

    /**
     * Get all office images
     *
     * @return bool
     */
    public function getOfficeImages()
    {
        $officeImages = OfficeImage::select('image')->inRandomOrder()->take(5)->get();
        if($officeImages->count()) {
            return $officeImages;
        }

        return false;
    }

    /**
     * Get what we are content for home page
     *
     * @return \App\CMSMenu|bool
     */
    public function getWhatWeAreContent()
    {
        $whatWeAreContent = CMSMenu::select('description')->where('id','=',\DB::raw(5))->first();
        if($whatWeAreContent->count()) {
           return $whatWeAreContent;
        }

        return false;
    }

    /**
     * Get slogans for home page slider
     *
     * @return mixed App\Slogan|bool
     */
    public function getSlogans()
    {
        $slogans = Slogan::where('status','=',\DB::raw(1))->get();
        if($slogans->count()) {
            return $slogans;
        }

        return false;
    }

    /**
     * Get news
     *
     * @return bool
     */
    public function getNews()
    {
        $news = News::select('description')->where('status','=',\DB::raw(1))->orderBy('id','DESC')->take(5)->get();
        if($news->count()) {
            return $news;
        }

        return false;
    }

    /**
     * Saving inquiry in database and sending mail notification to admin as well as user
     *
     * @param array $data
     * @return bool
     */
    public function saveInquiry($data)
    {
        $inquiry = new Inquiry();
        $inquiry->first_name = trim($data['first_name']);
        $inquiry->last_name = trim($data['last_name']);
        $inquiry->email = trim($data['email']);
        $inquiry->subject = trim($data['subject']);
        $inquiry->message= trim($data['message']);

        $isSaved = $inquiry->save();
        if($isSaved) {
            $params = $inquiry;
            Mail::send('emails.inquiry', ['inquiry' => $inquiry], function ($message) use ($params) {
                $message->from('alankar.more@gmail.com', 'DEPL Team');
                $message->to('alankar.more@gmail.com', 'Alankar More')->subject('New inquiry!');
            });

            Mail::send('emails.customer', ['inquiry' => $inquiry], function ($message) use ($params) {
                $message->from('alankar.more@gmail.com', 'DEPL Team');
                $message->to($params->email, ucfirst($params->first_name))->subject('No Reply!. We will get you very soon');
            });
        }

        return $isSaved;
    }

    /**
     * Saving career request and sending email to admin as well as customer
     *
     * @param array $data
     * @return bool
     */
    public function saveCareersRequest($data)
    {
        $career = new Career();
        $career->first_name = trim($data['first_name']);
        $career->last_name = trim($data['last_name']);
        $career->email = trim($data['email']);
        if ($data['file']->isValid()) {
            $extension =  $data['file']->getClientOriginalExtension();
            $fileName = time().".".$extension;
            $data['file']->move(public_path('uploads/resume/'), $fileName);
            $career->file_name = $fileName;
        }

        $career->message= trim($data['message']);
        $isSaved = $career->save();
        if($isSaved) {
            $params = $career;
            Mail::send('emails.career', ['inquiry' => $career], function ($message) use ($params) {
                $message->from('alankar.more@gmail.com', 'DEPL Team');
                $message->to('alankar.more@gmail.com', 'Alankar More')->subject('New Career Request!');
            });

            Mail::send('emails.customer', ['inquiry' => $career], function ($message) use ($params) {
                $message->from('alankar.more@gmail.com', 'DEPL Team');
                $message->to($params->email, ucfirst($params->first_name))->subject('No Reply!. We will get you very soon');
            });
        }

        return $isSaved;
    }
}