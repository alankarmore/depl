<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Services\Admin\CareersService;

class CareersController extends Controller
{

    public function __construct()
    {
        $this->service = new CareersService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.careers.index');
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
            $careerDetails = $this->service->getDetailsById($id);

            return view('admin.careers.show', ['career' => $careerDetails]);
        }

        return redirect(route('careers.list'));
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
                return redirect(route('career.list'))->with('success', 'Record has been deleted successfully!');
            }
        }

        return redirect(route('career.list'))->with('error', 'Oops something went wrong !');
    }
    
    /**
     * Download uploaded resume by the candidate.
     * 
     * @param string $file
     * @return Response
     */
    public function downloadResume($file)
    {
        $filePath = public_path('uploads/resume/') . $file;
        if(file_exists($filePath)) {
            return response()->download($filePath);
        }
    }    
}