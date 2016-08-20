<?php

namespace App\Http\Services\Admin;

use URL;
use App\Inquiry;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class InquiriesService extends BaseService
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
        $inquiries = Inquiry::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $inquiries->cnt;
        $query = Inquiry::select('id', 'first_name', 'last_name', 'email', 'subject', 'message');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('subject', 'LIKE', '%' . $request->get('search') . '%');
        }

        $inquiries = $query->orderBy($request->get('sort'), $request->get('order'))
            ->skip($request->get('offset'))->take($request->get('limit'))
            ->get();
        if (!empty($search)) {
            $response['total'] = $inquiries->count();
        }

        foreach ($inquiries as $inquiry) {
            $inquiry->action = '<a href="' . URL::route('inquiry.show', ['id' => $inquiry->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('inquiry.destroy', ['id' => $inquiry->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            $response['rows'][] = $inquiry;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id
     *
     * @param integer $id
     * @return \App\Inquiry
     */
    public function getDetailsById($id)
    {
        return Inquiry::find($id);
    }


    /**
     * Deleting menu according to the menu id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $inquiry = $this->getDetailsById($id);
        if ($inquiry) {
            return $inquiry->delete();
        }

        return false;
    }
}
