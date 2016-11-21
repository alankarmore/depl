<?php

namespace App\Http\Services\Admin;

use App\AlbumImages;
use App\Http\Services\Illuminate;
use URL;
use Cache;
use App\Album;
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
        $album->slug = $this->clean(strtolower($album->name));
        $album->save();

        $files = trim($request->get('fileName'));
        if(!empty($files)) {
            $fileNames = explode(",",$files);
            if(is_array($fileNames) && count($fileNames) > 0) {
                $albumImages = array();
                foreach ($fileNames as $file) {
                    $uploadedFile = $this->uploadFile($file, 'albums');
                    if (!empty($uploadedFile)) {
                        $temp = array();
                        $temp['album_id'] = $album->id;
                        $temp['image'] = $uploadedFile;
                        $temp['created_at'] = date("Y-m-d H:i:s");
                        $temp['updated_at'] = date("Y-m-d H:i:s");
                        $albumImages[] = $temp;
                    }
                }

                if($albumImages) {
                    AlbumImages::insert($albumImages);
                }

                Cache::forget($album->id);
            }
        }

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
            $albumImages = $album->albumImages;
            if($albumImages && $albumImages->count() > 0) {
                foreach($albumImages as $albumImage) {
                    $filePath = public_path('uploads/albums/').$albumImage->image;
                    if(file_exists($filePath)) {
                        unlink($filePath);
                        $albumImage->delete();
                    }
                }
            }

            $deleted = $album->delete();
            if(Cache::has('albums')) {
                Cache::forget('albums');
            }

            return $deleted;
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
     * Get all album images
     *
     * @return collection AlbumImages
     */
    public function getAlbumImages($albumId)
    {
        return AlbumImages::where('album_id','=',$albumId)->orderBy('id','desc')->get();
    }

    /**
     * Removing office image according to the id and removing image from folder.
     *
     * @param $id
     * @return bool
     */
    public function removeAlbumImage($id)
    {
        $albumImage = AlbumImages::find($id);
        if(!empty($albumImage)){
            $filePath = public_path('uploads/albums/').$albumImage->image;
            if(file_exists($filePath)) {
                unlink($filePath);
                $albumImage->delete();
                return true;
            }
        }

        return false;
    }

    /**
     * Get all albuum images
     *
     * @param Request $request
     * @return json
     */
    public function getRecords(Request $request)
    {
        $response = array('total' => 0, 'rows' => '');
        $allAlbums = Album::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allAlbums->cnt;
        $query = Album::select('*');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('name', 'LIKE', '%' . $request->get('search') . '%');
        }

        $albums = $query->orderBy($request->get('sort'), $request->get('order'))
            ->skip($request->get('offset'))->take($request->get('limit'))
            ->get();
        if (!empty($search)) {
            $response['total'] = $albums->count();
        }

        foreach ($albums as $album) {
            $album->name = ucwords($album->name);
            $album->action = '<a href="' . URL::route('album.images.show', ['id' => $album->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('album.edit', ['id' => $album->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('album.destroy', ['id' => $album->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';

            if ($album->status) {
                $album->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="' . $album->status . '" data-id="' . $album->id . '" data-object="' . get_class($album) . '" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';
            } else {
                $album->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="' . $album->status . '" data-id="' . $album->id . '" data-object="' . get_class($album) . '" class="change-status"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';
            }

            $response['rows'][] = $album;
        }

        return json_encode($response);
    }
}
