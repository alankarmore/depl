<?php

namespace App\Http\Services\Admin;

use URL;
use App\News;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class NewsService extends BaseService
{

    /**
     * Get all news
     * 
     * @param Request $request
     * @return json
     */
    public function getRecords(Request $request)
    {
        $response = array('total' => 0, 'rows' => '');
        $allNews = News::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allNews->cnt;
        $query = News::select('id', 'description','status');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('description', 'LIKE', '%' . $request->get('search') . '%');
        }

        $news = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $news->count();
        }

        foreach ($news as $news) {
            $news->description = ($news->description && strlen($news->description ) > 100) ? substr($news->description, 0, 100)." ..." : $news->description;
            $news->action = '<a href="' . URL::route('news.show', ['id' => $news->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('news.edit', ['id' => $news->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>';
            $news->action .= ' <a href="javascript:void(0);" title="Not allowed to remove"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            if($news->status) {
                $news->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="'.$news->status.'" data-id="'.$news->id.'" data-object="'.  get_class($news).'" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';   
            } else {
                $news->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="'.$news->status.'" data-id="'.$news->id.'" data-object="'.  get_class($news).'" class="change-status"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';     
            }
            
            $response['rows'][] = $news;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return \App\News
     */
    public function getDetailsById($id)
    {
        return News::find($id);
    }
    
    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\NewsRequest $request
     * @param integer $id
     * @return \App\News
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $news = new News();
        if(!empty($id)) {
            $news = $this->getDetailsById($id);
            $news->updated_at = date("Y-m-d H:i:s");
        } else {
            $news->status = 1;
            $news->created_at = date("Y-m-d H:i:s");
        }
        
        $news->description = trim($request->get('description'));

        $news->save();

        return $news;
    }
    
    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $news = $this->getDetailsById($id);
        if($news) {
            return $news->delete();
        }
        
        return false;
    }
}