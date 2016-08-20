<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OurOfficesRequest;
use App\Http\Services\Admin\InquiriesService;

class InquiriesController extends Controller
{

    public function __construct()
    {
        $this->service = new InquiriesService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.inquiry.index');
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
            $inquiryDetails = $this->service->getDetailsById($id);

            return view('admin.inquiry.show', ['inquiry' => $inquiryDetails]);
        }

        return redirect(route('inquiry.list'));
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
                return redirect(route('inquiry.list'))->with('success', 'Inquiry deleted successfully!');
            }
        }

        return redirect(route('inquiry.list'))->with('error', 'Oops something went wrong !');
    }
}