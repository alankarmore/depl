<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SloganRequest;
use App\Http\Services\Admin\SloganService;

class SloganController extends Controller
{

    public function __construct()
    {
        $this->service = new SloganService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.slogan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slogan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SloganRequest $request)
    {
        $slogan = $this->service->saveOrUpdateDetails($request);
        if ($slogan) {
            return redirect(route('slogan.edit',['slogan' => $slogan]))->with('success', 'Slogan has been created successfully!');
        }

        return back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!empty($id)) {
            $sloganDetails = $this->service->getDetailsById($id);

            return view('admin.slogan.show', ['slogan' => $sloganDetails]);
        }

        return redirect(route('slogan.list'));
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
            $sloganDetails = $this->service->getDetailsById($id);

            return view('admin.slogan.edit', ['slogan' => $sloganDetails]);
        }

        return redirect(route('slogan.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SloganRequest $request, $id)
    {
        $slogan = $this->service->saveOrUpdateDetails($request, $id);
        if ($slogan) {
            return redirect(route('slogan.edit',['slogan' => $slogan]))->with('success', 'Slogan has been updated successfully!');
        }

        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!empty($id)) {
            $deleted = $this->service->deleteById($id);
            if($deleted) {
                return redirect(route('slogan.list'))->with('success', 'Slogan deleted successfully!');
            }
        }
        
        return redirect(route('slogan.list'))->with('error', 'Oops something went wrong !');
    }

}