<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Helpers\FileHelper;
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
    
    /**
     * Changing status of the element. 
     * 
     * @param Request $request
     * @return JSON
     */
    public function changeStatus(Request $request)
    {
        return BaseService::changeStatus($request->all());
    }

    public function uploadToTemp(Request $request)
    {
        $fileInputName = $request->get('mediatype');
        $params = $request->file($fileInputName);
        $result = $this->validateMedia($fileInputName, $params);
        $response = array('valid' => 0, 'fileName' => null, 'error' => null);
        if ($result) {
            $response['error'] = $result;
        } else {
            $fileHelper = new FileHelper($params);
            $fileHelper->setFileName(time() . rand(1, 50));
            $isUpload = $fileHelper->upload('temp');
            if ($isUpload) {
                $response['valid'] = 1;
                $response['fileName'] = $fileHelper->getFileName();
            }
        }

        return json_encode($response);
    }

    /**
     * Removing temp file by given file name
     *
     * @return json
     */
    public function removeTempImage(Request $request)
    {
        $response = array('valid' => false);
        $fileName = $request->get('file');
        $container = ($request->get('container'))? $request->get('container'):'temp';
        if (!empty($fileName)) {
            $filePath = public_path('uploads/'.$container.'/').$fileName;
            if(file_exists($filePath)) {
                unlink($filePath);
                $response['valid'] = true;
            }
        }

        return json_encode($response);
    }

    /**
     * Validating uploaded file.
     *
     * @param string $fileType
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $fileInput
     * @return mixed (string|bull)
     */
    public function validateMedia($fileType, $fileInput)
    {
        $mimeType = $fileInput->getMimeType();
        if ($fileType == 'image') {
            return (!FileHelper::isItImage($mimeType)) ? 'Upload Valid image' : false;
        }
    }

}