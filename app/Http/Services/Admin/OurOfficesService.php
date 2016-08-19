<?php

namespace App\Http\Services\Admin;

use URL;
use App\OurOffice;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class OurOfficesService extends BaseService
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
        $allOffices = OurOffice::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allOffices->cnt;
        $query = OurOffice::select('id', 'state', 'city', 'type', 'address', 'pincode', 'phone', 'fax', 'status');
        if (!empty($request->get('search'))) {
            $query->where('address', 'LIKE', '%' . $request->get('search') . '%');
        }

        $offices = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($request->get('search'))) {
            $response['total'] = $offices->count();
        }

        foreach ($offices as $office) {
            $office->type = ($office->type == 2) ? 'Branch Office' : 'Head Office';
            $office->action = '<a href="' . URL::route('office.show', ['id' => $office->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('office.edit', ['id' => $office->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('office.destroy', ['id' => $office->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';

            if ($office->status) {
                $office->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="' . $office->status . '" data-id="' . $office->id . '" data-object="' . get_class($office) . '" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';
            } else {
                $office->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="' . $office->status . '" data-id="' . $office->id . '" data-object="' . get_class($office) . '" class="change-status"><span class="change-status glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';
            }

            $response['rows'][] = $office;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return App\OurOffice
     */
    public function getDetailsById($id)
    {
        return OurOffice::find($id);
    }

    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\OurOfficeRequest $request
     * @param integer $id
     * @return App\OurOffice
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $office = new OurOffice();
        if (!empty($id)) {
            $office = $this->getDetailsById($id);
            $office->updated_at = date("Y-m-d H:i:s");
        } else {
            $office->status = 1;
            $office->created_at = date("Y-m-d H:i:s");
        }

        $office->type = trim($request->get('type'));
        $office->state = trim($request->get('state'));
        $office->city = trim($request->get('city'));
        $office->address = trim($request->get('address'));
        $office->pincode = trim($request->get('pincode'));
        $office->phone = $request->get('phone') ? trim($request->get('phone')) : null;
        $office->fax = $request->get('fax') ? trim($request->get('fax')) : null;
        $office->save();

        return $office;
    }

    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $office = $this->getDetailsById($id);
        if ($office) {
            return $office->delete();
        }

        return false;
    }

}
