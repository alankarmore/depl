<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CMSMenuRequest;
use App\Http\Services\Admin\CMSMenuService;

class CMSMenuController extends Controller
{

    public function __construct()
    {
        $this->service = new CMSMenuService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CMSMenuRequest $request)
    {
        $menu = $this->service->saveOrUpdateDetails($request);
        if ($menu) {
            return redirect(route('menu.edit',['menu' => $menu]))->with('success', 'Menu updated!');
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
            $menuDetails = $this->service->getDetailsById($id);

            return view('admin.menu.show', ['menu' => $menuDetails]);
        }

        return redirect(route('menu.list'));
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
            $menuDetails = $this->service->getDetailsById($id);

            return view('admin.menu.edit', ['menu' => $menuDetails]);
        }

        return redirect(route('menu.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CMSMenuRequest $request, $id)
    {
        $menu = $this->service->saveOrUpdateDetails($request, $id);
        if ($menu) {
            return redirect(route('menu.edit',['menu' => $menu]))->with('success', 'Menu updated!');
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
                return redirect(route('menu.list'))->with('success', 'Menu deleted successfully!');
            }
        }
        
        return redirect(route('menu.list'))->with('error', 'Oops something went wrong !');
    }

}