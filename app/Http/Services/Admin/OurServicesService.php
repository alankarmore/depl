<?php

namespace App\Http\Services\Admin;

use URL;
use App\OurService;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class OurServicesService extends BaseService
{

    /**
     * Get all menus
     * 
     * @param Request $request
     * @return json
     */
    public function getRecords(Request $request)
    {
        $response = array('total' => 0, 'rows' => '');
        $allMenus = OurService::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allMenus->cnt;
        $query = OurService::select('id', 'title','status','description','image','status');
        if (!empty($request->get('search'))) {
            $query->where('title', 'LIKE', '%' . $request->get('search') . '%');
        }

        $services = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($request->get('search'))) {
            $response['total'] = $services->count();
        }

        foreach ($services as $service) {
            $service->description = ($service->description && strlen($service->description) > 50) ? substr($service->description, 0, 50) : $service->description;
            $service->action = '<a href="' . URL::route('service.show', ['id' => $service->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('service.edit', ['id' => $service->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('service.destroy', ['id' => $service->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            
            if($service->status) {
                $service->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="'.$service->status.'" data-id="'.$service->id.'" data-object="'.  get_class($service).'" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';   
            } else {
                $service->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="'.$service->status.'" data-id="'.$service->id.'" data-object="'.  get_class($service).'" class="change-status"><span class="change-status glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';     
            }
            
            $response['rows'][] = $service;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return App\OurService
     */
    public function getDetailsById($id)
    {
        return OurService::find($id);
    }
    
    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\OurServiceRequest $request
     * @param integer $id
     * @return App\OurService
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $service = new OurService();
        if(!empty($id)) {
            $service = $this->getDetailsById($id);
            $service->updated_at = date("Y-m-d H:i:s");
        } else {
            $service->status = 1;
            $service->created_at = date("Y-m-d H:i:s");
        }
        
        $service->title = trim($request->get('title'));
        $service->slug = strtolower(str_replace(' ', '-', $service->title));
        $service->description = trim($request->get('description'));
        $fileName = !empty($id) ? $service->image : null;
        $file = trim($request->get('fileName'));
        $service->image = $this->uploadFile($file,'service',$fileName);
        $service->save();

        return $service;
    }
    
    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $service = $this->getDetailsById($id);
        if($service) {
            return $service->delete();
        }
        
        return false;
    }
}