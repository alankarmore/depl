<?php

namespace App\Http\Services\Admin;

use App\Http\Services\Illuminate;
use URL;
use Cache;
use App\Album;
use App\OfficeImage;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class AlbumService extends BaseService
{

    /**
     * Get menu details according to the id
     *
     * @param integer $id
     * @return \App\Album
     */
    public function getDetailsById($id)
    {
        return Album::find($id);
    }

    /**
     * Update record details according to the id
     *
     * @param App\Http\Requests\Admin\AlbumRequest $request
     * @param integer $id
     * @return \App\Album
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $album = new Album();
        if (!empty($id)) {
            $album = $this->getDetailsById($id);
            $album->updated_at = date("Y-m-d H:i:s");
        } else {
            $album->status = 1;
            $album->created_at = date("Y-m-d H:i:s");
        }

        $album->name = trim($request->get('title'));
        $album->slug = $this->clean($album->name);
        $fileName = !empty($id) ? $album->cover_image : null;
        $file = trim($request->get('fileName'));
        if(!empty($file)) {
            $album->cover_image = $this->uploadFile($file,'gallery',$fileName);
        }

        $album->save();

        return $album;
    }

    /**
     * Deleting menu according to the menu id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $album = $this->getDetailsById($id);
        if ($album) {
            if(Cache::has('offices')) {
                Cache::forget('offices');
            }

            return $album->delete();
        }

        return false;
    }


    /**
     * Getting all added offices.
     *
     * @return collection Album
     */
    public function getOffices()
    {
        return Album::select('id', 'title')->orderBy('title', 'ASC')->get();
    }

    /**
     * Uploading and saving office images in the database
     *
     * @param Request $request
     * @return bool
     */
    public function uploadAndSavealbumImages(Request $request)
    {
        $album = $request->get('name');
        $fileNames = $request->get('fileName');
        if (!empty($album) && !empty($fileNames)) {
            $files = explode(",", $fileNames);
            foreach ($files as $file) {
                $uploadedFile = $this->uploadFile($file, 'gallery');
                if (!empty($uploadedFile)) {
                    $albumImage = new OfficeImage();
                    $albumImage->offices_id = $album;
                    $albumImage->image = $uploadedFile;
                    $albumImage->save();
                }
            }

            return true;
        }

        return false;
    }

    /**
     * Get all office images
     *
     * @return collection OfficeImage
     */
    public function getOfficeImages()
    {
        return OfficeImage::orderBy('id','desc')->get();
    }

    /**
     * Removing office image according to the id and removing image from folder.
     *
     * @param $id
     * @return bool
     */
    public function removeOfficeImage($id)
    {
        $albumImage = OfficeImage::find($id);
        if(!empty($albumImage)){
            $filePath = public_path('uploads/office/').$albumImage->image;
            if(file_exists($filePath)) {
                unlink($filePath);
                $albumImage->delete();
                return true;
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
        // TODO: Implement getRecords() method.
    }
}
