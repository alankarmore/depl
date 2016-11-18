<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumsRequest;
use App\Http\Services\Admin\AlbumService;

class AlbumController extends Controller
{

    public function __construct()
    {
        $this->service = new AlbumService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.albums.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AlbumsRequest  $request
     * @return \Illuminate\Http\Redirect
     */
    public function store(AlbumsRequest $request)
    {
        $album = $this->service->saveOrUpdateDetails($request);
        if ($album) {
            return redirect(route('album.edit',['album' => $album]))->with('success', 'Album has been saved successfully!');
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Redirect
     */
    public function show($id)
    {
        if (!empty($id)) {
            $albumDetails = $this->service->getDetailsById($id);

            return view('admin.album.show', ['album' => $albumDetails]);
        }

        return redirect(route('album.list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Redirect
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $albumDetails = $this->service->getDetailsById($id);

            return view('admin.albums.edit', ['album' => $albumDetails]);
        }

        return redirect(route('album.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OuralbumsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Redirect
     */
    public function update(AlbumsRequest $request, $id)
    {
        $album = $this->service->saveOrUpdateDetails($request, $id);
        if ($album) {
            return redirect(route('album.edit',['album' => $album]))->with('success', 'album has been modified successfully!');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Redirect
     */
    public function destroy($id)
    {
        if(!empty($id)) {
            $deleted = $this->service->deleteById($id);
            if($deleted) {
                return redirect(route('albums.list'))->with('success', 'album deleted successfully!');
            }
        }

        return redirect(route('albums.list'))->with('error', 'Oops something went wrong !');
    }

    /**
     * Adding images for album.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addImages()
    {
        return view('admin.albums.addimages');
    }

    /**
     * Saving album images
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function saveAlbum(Request $request)
    {
        $saved = $this->service->saveOrUpdateDetails($request);
        if($saved) {
            return redirect(route('albums.list'))->with('success', 'Album has been added successfully!');
        }

        return back()->withInput();
    }

    /**
     * Showing added album images
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAlbumImages($albumId)
    {
        $album = $this->service->getDetailsById($albumId);

        return view('admin.albums.showimages',['album' => $album]);
    }

    /**
     * Removing album images according to the id
     *
     * @param Request $request
     * @return json
     */
    public function removeAlbumImage(Request $request)
    {
        $response = array('valid' => false);
        $id = $request->get('id');
        $response['valid'] = $this->service->removeAlbumImage($id);

        return json_encode($response);
    }

}