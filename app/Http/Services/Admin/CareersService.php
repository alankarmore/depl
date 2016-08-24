<?php

namespace App\Http\Services\Admin;

use URL;
use App\Career;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class CareersService extends BaseService
{

    /**
     * Get all menus
     *
     * @param Request $request
     * @return json
     */
    public function getRecords(Request $request)
    {
        $response = array('total' => 0, 'rows' => '');
        $careers = Career::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $careers->cnt;
        $query = Career::select('id', 'first_name', 'last_name', 'email','message', 'file_name');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('first_name', 'LIKE', '%' . $request->get('search') . '%');
        }

        $careers = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $careers->count();
        }

        foreach ($careers as $career) {
            $career->first_name = ucfirst($career->first_name);
            $career->last_name = ucfirst($career->last_name);
            $career->subject = ucwords($career->subject);
            $career->action = '<a href="' . URL::route('career.show', ['id' => $career->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('career.destroy', ['id' => $career->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            $filePath = public_path('uploads/resume/') . $career->file_name;
            if (file_exists($filePath)) {
                $career->action .= '<a href="' . URL::route('career.download', ['file' => $career->file_name]) . '"><span class="glyphicon glyphicon-download" aria-hidden="true"></span></a>';
            }

            $response['rows'][] = $career;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id
     *
     * @param integer $id
     * @return \App\Career
     */
    public function getDetailsById($id)
    {
        return Career::find($id);
    }

    /**
     * Deleting menu according to the menu id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $career = $this->getDetailsById($id);
        if ($career) {
            return $career->delete();
        }

        return false;
    }

}