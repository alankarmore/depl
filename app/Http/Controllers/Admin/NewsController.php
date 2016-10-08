<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Http\Services\Admin\NewsService;

class NewsController extends Controller
{

    public function __construct()
    {
        $this->service = new NewsService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Saving news details
     *
     * @param NewsRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(NewsRequest $request)
    {
        $news = $this->service->saveOrUpdateDetails($request);
        if ($news) {
            return redirect(route('news.edit',['news' => $news]))->with('success', 'News has been added successfully!');
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
            $newsDetails = $this->service->getDetailsById($id);

            return view('admin.news.show', ['news' => $newsDetails]);
        }

        return redirect(route('news.list'));
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
            $newsDetails = $this->service->getDetailsById($id);

            return view('admin.news.edit', ['news' => $newsDetails]);
        }

        return redirect(route('news.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(NewsRequest $request, $id)
    {
        $news = $this->service->saveOrUpdateDetails($request, $id);
        if ($news) {
            return redirect(route('news.edit',['news' => $news]))->with('success', 'News has been updated!');
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
                return redirect(route('news.list'))->with('success', 'News deleted successfully!');
            }
        }

        return redirect(route('news.list'))->with('error', 'Oops something went wrong !');
    }

}