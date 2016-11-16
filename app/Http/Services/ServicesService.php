<?php

namespace App\Http\Services;

use App\CMSMenu;
use App\WorkFlow;
use App\OurService;

class ServicesService
{
    /**
     * Get all active services
     *
     * @return mixed
     */
    public function getAllServices()
    {
        return OurService::select('id','slug','title','description','image')
            ->where('status','=',\DB::raw(1))
            ->get();
    }


    /**
     * Get service CMS data according to the id
     *
     * @return mixed
     */
    public function getServiceCMSData()
    {
        return CMSMenu::find(7);
    }

    /**
     * Get service details according to name
     *
     * @param string $name
     * @return null | \App\OurService mixed
     */
    public function getServiceDetails($name)
    {
        return OurService::select('id','slug','title','description','image')
            ->where('slug','=',$name)
            ->where('status','=',\DB::raw(1))
            ->first();
    }

    /**
     * Get work flows according to the service id
     *
     * @param integer $serviceId
     * @return mixed
     */
    public function getServiceWorkFlows($serviceId)
    {
        return WorkFlow::select('id','title','description')
            ->where('services_id','=',$serviceId)
            ->where('status','=',\DB::raw(1))
            ->get();
    }
}
