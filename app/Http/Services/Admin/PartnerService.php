<?php

namespace App\Http\Services\Admin;

use App\PartnerImages;
use App\Http\Services\Illuminate;
use URL;
use Cache;
use App\Partner;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class PartnerService extends BaseService
{

    /**
     * Get menu details according to the id
     *
     * @param integer $id
     * @return \App\Partner
     */
    public function getDetailsById($id)
    {
        return Partner::find($id);
    }

    /**
     * Saving partner images
     *
     * @param Request $request
     * @return bool
     *
     */
    public function saveOrUpdateDetails($request)
    {
        $files = trim($request->get('fileName'));
        if(!empty($files)) {
            $fileNames = explode(",",$files);
            if(is_array($fileNames) && count($fileNames) > 0) {
                $partnerImages = array();
                foreach ($fileNames as $file) {
                    $uploadedFile = $this->uploadFile($file, 'partners');
                    if (!empty($uploadedFile)) {
                        $temp = array();
                        $temp['image'] = $uploadedFile;
                        $temp['created_at'] = date('Y-m-d H:i:s');
                        $partnerImages[] = $temp;
                    }
                }

                if($partnerImages) {
                    Cache::forget('partners');
                    return Partner::insert($partnerImages);
                }
            }
        }

        return false;
    }

    /**
     * Deleting menu according to the menu id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $partner = $this->getDetailsById($id);
        if ($partner) {
            $filePath = public_path('uploads/partners/').$partner->image;
            if(file_exists($filePath)) {
                unlink($filePath);
                $deleted = $partner->delete();
                if(Cache::has('partners')) {
                    Cache::forget('partners');
                }

                return $deleted;
            }
        }

        return false;
    }

    /**
     * Abstract function to display records every service needs to define
     * its definition
     *
     * @param Illuminate\Http\Request $request
     */
    public function getRecords(Request $request)
    {
        return Partner::all();
    }
}
