<?php

namespace App\Http\Services\Admin;

use URL;
use App\CurrentOpening;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class CurrentOpeningService extends BaseService
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
        $currentOpenings = CurrentOpening::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $currentOpenings->cnt;
        $query = CurrentOpening::select('id', 'title', 'location', 'qualification','created_at');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('first_name', 'LIKE', '%' . $request->get('search') . '%');
        }

        $sort = $request->get('sort');
        $order = $request->get('order');
        if($request->get('sort') == 'date') {
            $sort = 'created_at';
        }

        $currentOpenings = $query->orderBy($sort, $order)
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $currentOpenings->count();
        }

        foreach ($currentOpenings as $currentOpening) {
            $currentOpening->title = ucwords($currentOpening->title);
            $currentOpening->location = ucwords($currentOpening->location);
            $currentOpening->qualification = ucwords($currentOpening->qualification);
            $currentOpening->date = date("d M,Y",strtotime($currentOpening->created_at));
            $currentOpening->action = '
                             <a href="' . URL::route('current-opening.edit', ['id' => $currentOpening->id]) . '" title="Edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                             <a href="' . URL::route('current-opening.show', ['id' => $currentOpening->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('current-opening.destroy', ['id' => $currentOpening->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';

            $response['rows'][] = $currentOpening;
        }

        return json_encode($response);
    }

    public function saveOrUpdateDetails($request, $id = null)
    {
        $opening = new CurrentOpening();
        if(!empty($id)) {
            $opening = $this->getDetailsById($id);
            $opening->updated_at = date("Y-m-d H:i:s");
        } else {
            $opening->status = 1;
            $opening->created_at = date("Y-m-d H:i:s");
        }

        $opening->title = trim($request->get('title'));;
        $opening->slug = strtolower($this->clean($opening->title));
        $opening->description = $request->description;
        $opening->location = trim($request->location);
        $opening->experience = trim($request->from_experience)."-".trim($request->to_experience);
        $opening->qualification = trim($request->qualification);
        $opening->skills = trim($request->skills);
        $opening->meta_title = trim($request->meta_title);
        $opening->meta_keyword = trim($request->meta_keyword);
        $opening->meta_description = trim($request->meta_description);
        $opening->save();

        return $opening;
    }


    /**
     * Get opening details according to the id
     *
     * @param integer $id
     * @return \App\CurrentOpening
     */
    public function getDetailsById($id)
    {
        return CurrentOpening::find($id);
    }

    /**
     * Deleting menu according to the menu id
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $currentOpening = $this->getDetailsById($id);
        if ($currentOpening) {
            return $currentOpening->delete();
        }

        return false;
    }

}