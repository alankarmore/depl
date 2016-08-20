<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OurOfficesRequest;
use App\Http\Services\Admin\OurOfficesService;

class OurOfficesController extends Controller
{

    public function __construct()
    {
        $this->service = new OurOfficesService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.office.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('admin.office.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OurOfficesRequest  $request
     * @return \Illuminate\Http\Redirect
     */
    public function store(OurOfficesRequest $request)
    {
        $office = $this->service->saveOrUpdateDetails($request);
        if ($office) {
            return redirect(route('office.edit',['office' => $office]))->with('success', 'Office address has been saved successfully!');
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
            $officeDetails = $this->service->getDetailsById($id);

            return view('admin.office.show', ['office' => $officeDetails]);
        }

        return redirect(route('office.list'));
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
            $officeDetails = $this->service->getDetailsById($id);

            return view('admin.office.edit', ['office' => $officeDetails]);
        }

        return redirect(route('office.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OurOfficesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Redirect
     */
    public function update(OurOfficesRequest $request, $id)
    {
        $office = $this->service->saveOrUpdateDetails($request, $id);
        if ($office) {
            return redirect(route('office.edit',['office' => $office]))->with('success', 'Office has been modified successfully!');
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
                return redirect(route('office.list'))->with('success', 'Office deleted successfully!');
            }
        }

        return redirect(route('office.list'))->with('error', 'Oops something went wrong !');
    }

    /**
     * Adding images for office.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addImages()
    {
        $offices = $this->service->getOffices();

        return view('admin.office.addimages',['offices' => $offices]);
    }

    /**
     * Saving office images
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function saveOfficeImages(Request $request)
    {
        $saved = $this->service->uploadAndSaveOfficeImages($request);
        if($saved) {
            return redirect(route('office.images.show'))->with('success', 'Office Images has been added successfully!');
        }

        return back()->withInput();
    }

    /**
     * Showing added office images
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOfficeImages()
    {
        $officeImages = $this->service->getOfficeImages();

        return view('admin.office.showimages',['officeImages' => $officeImages]);
    }

    /**
     * Removing office images according to the id
     *
     * @param Request $request
     * @return json
     */
    public function removeOfficeImage(Request $request)
    {
        $response = array('valid' => false);
        $id = $request->get('id');
        $response['valid'] = $this->service->removeOfficeImage($id);

        return json_encode($response);
    }

}