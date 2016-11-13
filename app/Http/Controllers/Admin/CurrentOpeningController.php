<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CurrentOpeningRequest;
use App\Http\Services\Admin\CurrentOpeningService;

class CurrentOpeningController extends Controller
{

    public function __construct()
    {
        $this->service = new CurrentOpeningService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('admin.openings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.openings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrentOpeningRequest $request)
    {
        $opening = $this->service->saveOrUpdateDetails($request);
        if ($opening) {
            return redirect(route('current-opening.edit',['opening' => $opening]))->with('success', 'Opening has been created successfully!');
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
            $openingDetails = $this->service->getDetailsById($id);

            return view('admin.openings.show', ['opening' => $openingDetails]);
        }

        return redirect(route('current-opening.list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $openingDetails = $this->service->getDetailsById($id);
            if($openingDetails) {
                $experience = explode("-",$openingDetails->experience);
                if(isset($experience[0]) && isset($experience[1])) {
                    $openingDetails->from_experience = $experience[0];
                    $openingDetails->to_experience = $experience[1];
                }
            }
            return view('admin.openings.edit', ['opening' => $openingDetails]);
        }

        return redirect(route('current-opening.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrentOpeningRequest $request, $id)
    {
        $opening = $this->service->saveOrUpdateDetails($request, $id);
        if ($opening) {
            return redirect(route('current-opening.edit',['opening' => $opening]))->with('success', 'Opening has been updated successfully!');
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
                return redirect(route('current-opening.list'))->with('success', 'Record has been deleted successfully!');
            }
        }

        return redirect(route('current-opening.list'))->with('error', 'Oops something went wrong !');
    }
}