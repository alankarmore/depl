<?php

namespace App\Http\Controllers\Admin;

use App\Http\Services\Admin\PartnerService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AlbumsRequest;
use App\Http\Services\Admin\AlbumService;

class PartnersController extends Controller
{

    public function __construct()
    {
        $this->service = new PartnerService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(Request $request)
    {
        $partners = $this->service->getRecords($request);
        return view('admin.partners.index',array('partners' => $partners));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Request $request)
    {
        $partners = $this->service->getRecords($request);
        return view('admin.partners.create',array('partners' => $partners));
    }

    /**
     * Saving partner images
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function savePartners(Request $request)
    {
        $saved = $this->service->saveOrUpdateDetails($request);
        if($saved) {
            return redirect(route('partners.list'))->with('success', 'Partner images has been added successfully!');
        }

        return back()->withInput();
    }

    /**
     * Removing partner images according to the id
     *
     * @param Request $request
     * @return json
     */
    public function removePartnerImage(Request $request)
    {
        $response = array('valid' => false);
        $id = $request->get('id');
        $response['valid'] = $this->service->deleteById($id);

        return json_encode($response);
    }

}