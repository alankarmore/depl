<?php

namespace App\Http\Controllers\Admin;

use Session;
use Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\SEOService;

class SEOManagementController extends Controller
{

    public function __construct()
    {
        $this->service = new SEOService();
    }

    public function edit()
    {
        $seoInformation = $this->service->getSEOInformation();

        return view('admin.seo.edit',['seo' => $seoInformation]);
    }

    /**
     * Updating the seo details.
     *
     * @param integer $id
     * @return mixed RedirectResponse
     */
    public function update(Request $request,$id)
    {
        $inputData = $request->all();
        $isUpdate = $this->service->updateDetails($inputData,$id);
        if ($isUpdate) {
            return Redirect::route('admin.seo')->with('success', 'SEO information has been updated successfully!');
        }

        return back()->withInput();
    }
}