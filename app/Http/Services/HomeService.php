<?php

namespace App\Http\Services;

use Mail;
use App\Career;
use App\OurOffice;
use App\Project;
use App\CMSMenu;
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
        $projects = Project::select('id','title','description','state','project_type','image','company','length','completion_date')
                             ->where('status','=',\DB::raw(1))
                             ->take(5)
                             ->get();
        if($projects->count()) {
            return $projects;
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
