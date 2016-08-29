<?php

namespace App\Http\Controllers\Admin;

use Cache;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SiteConfigurationRequest;
use App\Http\Services\Admin\SiteConfigurationService;

class SiteConfigurationController extends Controller
{

    public function __construct()
    {
        $this->service = new SiteConfigurationService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.config.index');
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
            $configDetails = $this->service->getDetailsById($id);

            return view('admin.config.show', ['config' => $configDetails]);
        }

        return redirect(route('config.list'));
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
            $configDetails = $this->service->getDetailsById($id);

            return view('admin.config.edit', ['config' => $configDetails]);
        }

        return redirect(route('config.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteConfigurationRequest $request, $id)
    {
        $config = $this->service->saveOrUpdateDetails($request, $id);
        if(2 == $id || 2 == $request->get('config_id')) {
            if(false == $config) {
                return back()->with('error', 'Image width and height dimension not matched!');;
            }
        }

        if ($config) {
            Cache::flush();
            return redirect(route('config.edit', ['id' => $config->id]))->with('success', 'Config updated!');
        }

        return back()->withInput();
    }

}