<?php

namespace App\Http\Services\Admin;

use URL;
use App\SiteConfig;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class SiteConfigurationService extends BaseService
{

    const LOGO_WIDTH = 45;
    const LOGO_HEIGHT = 53;
    /**
     * Get all menus
     * 
     * @param Request $request
     * @return json
     */
    public function getRecords(Request $request)
    {
        $response = array('total' => 0, 'rows' => '');
        $allConfigs = SiteConfig::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allConfigs->cnt;
        $query = SiteConfig::select('id', 'config_name','config_value');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('config_name', 'LIKE', '%' . $request->get('search') . '%');
        }

        $configs = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $configs->count();
        }

        foreach ($configs as $config) {
            $config->config_name = ucwords(str_replace("_",' ',ucfirst(strtolower($config->config_name))));
            if($config->id == 2) {
                $config->config_value = '<img src="'.asset('uploads/logo.png').'"/>';
            }

            $config->action = '<a href="' . URL::route('config.edit', ['id' => $config->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>';
            $response['rows'][] = $config;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return \App\SiteConfig
     */
    public function getDetailsById($id)
    {
        return SiteConfig::find($id);
    }
    
    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\SiteConfigRequest $request
     * @param integer $id
     * @return bool | \App\SiteConfig
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $config = new SiteConfig();
        if(!empty($id)) {
            $config = $this->getDetailsById($id);
            $config->updated_at = date("Y-m-d H:i:s");
        } else {
            $config->created_at = date("Y-m-d H:i:s");
        }
        
        if(2 == $config->id || 2 == $request->get('config_id')) {
            $fileName = !empty($id) ? $config->config_value : null;
            $file = trim($request->get('fileName'));
            $logoTempPath = public_path('uploads/temp/' . $file);
            if(file_exists($logoTempPath)) {
                $imageDetails = getimagesize($logoTempPath);
                if(self::LOGO_WIDTH != $imageDetails[0] && self::LOGO_HEIGHT != $imageDetails[1]) {
                    return false;
                }

                $uploadFileName= $this->uploadFile($file,null,$fileName);
                rename(public_path('uploads/').$uploadFileName,public_path('uploads/logo.png'));

                $config->config_value = 'logo.png';
            }
        } else {
            $config->config_value = trim($request->get('config_value'));
        }

        $config->save();

        return $config;
    }
}