<?php

namespace App\Http\Services\Admin;

use URL;
use App\Seo;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class SEOService extends BaseService
{

    public function getRecords(Request $request) {}

    /**
     * Getting seo information from database
     *
     * @return \App\Seo
     */
    public function getSEOInformation()
    {
        return Seo::orderBy('id','DESC')->take(1)->first();
    }

    /**
     * Updating seo details.
     *
     * @param array $data
     * @param integer $id
     * @return boolean
     */
    public function updateDetails($data,$id)
    {
        $seo = Seo::find($id);
        $seo->meta_title = trim($data['meta_title']);
        $seo->meta_keyword = trim($data['meta_keyword']);
        $seo->meta_description = trim($data['meta_description']);

        return $seo->save();
    }
}
