<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberRequest;
use App\Http\Services\Admin\TeamMemberService;

class TeamMemberController extends Controller
{

    public function __construct()
    {
        $this->service = new TeamMemberService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MemberRequest $request)
    {
        $service = $this->service->saveOrUpdateDetails($request);
        if ($service) {
            return redirect(route('team.edit',['service' => $service]))->with('success', 'Service has been created successfully!');
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
            $memberDetails = $this->service->getDetailsById($id);

            return view('admin.member.show', ['member' => $memberDetails]);
        }

        return redirect(route('team.list'));
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
            $memberDetails = $this->service->getDetailsById($id);

            return view('admin.member.edit', ['member' => $memberDetails]);
        }

        return redirect(route('team.list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MemberRequest $request, $id)
    {
        $member = $this->service->saveOrUpdateDetails($request, $id);
        if ($member) {
            return redirect(route('team.edit',['member' => $member]))->with('success', 'Member has been updated successfully!');
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
                return redirect(route('member.list'))->with('success', 'Member deleted successfully!');
            }
        }
        
        return redirect(route('member.list'))->with('error', 'Oops something went wrong !');
    }

}