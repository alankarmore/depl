<?php

namespace App\Http\Services;

use Response;
use Illuminate\Http\Request;
use App\Http\Helpers\FileHelper;

abstract class BaseService
{

    /**
     * Abstract function to display records every service needs to define
     * its definition
     *
     * @param Illuminate\Http\Request $request
     */
    abstract public function getRecords(Request $request);

    /**
     * Changing status of the record according to the previous status
     *
     * @param array $data
     * @return json
     */
    public static function changeStatus($data)
    {
        $response = array('valid' => 0);
        if (!empty($data['id']) && !empty($data['object']) && isset($data['status'])) {
            $id = trim($data['id']);
            $status = (isset($data['status']) && $data['status'] > 0) ? 0 : 1;
            $record = $data['object']::find($id);
            $record->status = $status;
            if ($record->save()) {
                $response['message'] = "Record has been inactivated successfully";
                if ($record->status) {
                    $response['message'] = "Record has been activated successfully";
                }

                $response['valid'] = 1;
                $response['status'] = $record->status;
            }
        } else {
            $response['message'] = "Something went wrong. Try again later";
        }

        return Response::json($response);
    }

    /**
     * Uploading file to it's respective folder.
     *
     * @param string $tempFileName
     * @param string|null $imageContainer
     * @param string|null $imageName
     * @return string|bool
     */
    public function uploadFile($tempFileName,$imageContainer = null,$imageName = null)
    {
        if(isset($tempFileName) && !empty($tempFileName)) {
            if(!empty($imageName)) {
                $previousPath = public_path('uploads/' . $imageName);
                if(null != $imageContainer) {
                    $previousPath = public_path('uploads/'.$imageContainer.'/' . $imageName);
                }

                if(file_exists($previousPath)) {
                    @unlink($previousPath);
                }
            }

            $fileHelper = new FileHelper();
            $tempPath = public_path('uploads/temp/' . $tempFileName);
            if(file_exists($tempPath)) {
                $destination = public_path('uploads/'.$tempFileName);
                if(null != $imageContainer) {
                    $destination = public_path('uploads/'.$imageContainer.'/' . $tempFileName);
                }

                $fileHelper->moveFile($tempPath, $destination);

                return $tempFileName;
            }

            return  false;
        }

        return  false;
    }

}
