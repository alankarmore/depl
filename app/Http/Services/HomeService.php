<?php

namespace App\Http\Services;

use App\OurOffice;
use App\Project;
use App\CMSMenu;

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
        $offices = OurOffice::select('id','title','state','city','address','pincode','phone','fax')
            ->where('status','=',\DB::raw(1))
            ->take(5)
            ->get();
        if($offices->count()) {
            return $offices;
        }

        return false;
    }
}
