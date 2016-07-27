<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use App\Http\Services\BaseService;

class Controller extends BaseController
{   
    /**
     *
     * @var mixed null | App\Services\Admin\BaseService
     */
    protected $service = null;

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    /**
     * Get all menu related data.
     * 
     * @param Request $request
     * @return json
     */
    public function getData(Request $request)
    {
        return $this->service->getRecords($request);
    }
    
    public function changeStatus(Request $request)
    {
        return BaseService::changeStatus($request->all());
    }
}