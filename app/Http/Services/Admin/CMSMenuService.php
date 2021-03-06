<?php

namespace App\Http\Services\Admin;

use URL;
use App\CMSMenu;
use Illuminate\Http\Request;
use App\Http\Services\BaseService;

class CMSMenuService extends BaseService
{
    /**
     * Get parent menu list which can be used to include the other sub contents.
     * 
     * @return Collection App\CMSMenu
     */
    public function getParentMenus()
    {
        return CMSMenu::select('id','title')
                       ->whereNull('include_in')
                       ->orderBY('title','ASC')
                       ->get();
    }

    /**
     * Get all menus
     * 
     * @param Request $request
     * @return json
     */
    public function getRecords(Request $request)
    {
        $response = array('total' => 0, 'rows' => '');
        $allMenus = CMSMenu::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allMenus->cnt;
        $query = CMSMenu::select('id', 'title','status','meta_title', 'meta_description','meta_keyword');
        $search = $request->get('search');
        if (!empty($search)) {
            $query->where('title', 'LIKE', '%' . $request->get('search') . '%');
        }

        $menus = $query->orderBy($request->get('sort'), $request->get('order'))
                ->skip($request->get('offset'))->take($request->get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $menus->count();
        }

        foreach ($menus as $menu) {
            $menu->meta_title = ($menu->meta_title && strlen($menu->meta_title) > 50) ? substr($menu->meta_title, 0, 50) : ($menu->meta_title == null) ? 'NA' : $menu->meta_title;
            $menu->meta_keyword = ($menu->meta_keyword && strlen($menu->meta_keyword) > 50) ? substr($menu->meta_keyword, 0, 50) : ($menu->meta_keyword == null) ? 'NA' : $menu->meta_keyword;
            $menu->meta_description = ($menu->meta_description && strlen($menu->meta_description) > 50) ? substr($menu->meta_description, 0, 50) : ($menu->meta_description == null) ? 'NA' : $menu->meta_description;
            $menu->action = '<a href="' . URL::route('menu.show', ['id' => $menu->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('menu.edit', ['id' => $menu->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>';
            if (!in_array($menu->id, [1, 2, 3, 4])) {
                $menu->action .= ' <a href="' . URL::route('menu.destroy', ['id' => $menu->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            } else {
                $menu->action .= ' <a href="javascript:void(0);" title="Not allowed to remove"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>';
            }
            
            if($menu->status) {
                $menu->action .= ' <a href="javascript:void(0);" title="Change To Inactive" data-status="'.$menu->status.'" data-id="'.$menu->id.'" data-object="'.  get_class($menu).'" class="change-status"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></a>';   
            } else {
                $menu->action .= ' <a href="javascript:void(0);" title="Change To Active" data-status="'.$menu->status.'" data-id="'.$menu->id.'" data-object="'.  get_class($menu).'" class="change-status"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';     
            }
            
            $response['rows'][] = $menu;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return \App\CMSMenu
     */
    public function getDetailsById($id)
    {
        return CMSMenu::find($id);
    }
    
    /**
     * Update record details according to the id 
     * 
     * @param App\Http\Requests\Admin\CMSMenuRequest $request
     * @param integer $id
     * @return \App\CMSMenu
     */
    public function saveOrUpdateDetails($request, $id = null)
    {
        $menu = new CMSMenu();
        if(!empty($id)) {
            $menu = $this->getDetailsById($id);
            $menu->updated_at = date("Y-m-d H:i:s");
        } else {
            $menu->status = 1;
            $menu->created_at = date("Y-m-d H:i:s");
        }
        
        $menu->title = trim($request->get('title'));
        $menu->include_in = (trim($request->get('include_in'))) ? trim($request->get('include_in')) : NULL;
        $menu->slug = strtolower(str_replace(' ', '-', $menu->title));
        $menu->description = trim($request->get('description'));
        $menu->meta_title = trim($request->get('meta_title'));
        $menu->meta_keyword = trim($request->get('meta_keyword'));
        $menu->meta_description = trim($request->get('meta_description'));

        $fileName = !empty($id) ? $menu->image : null;
        $file = trim($request->get('fileName'));
        if(!empty($file)) {
            $menu->image = $this->uploadFile($file,'cms',$fileName);
        }

        $menu->save();

        return $menu;
    }
    
    /**
     * Deleting menu according to the menu id 
     * 
     * @param integer $id
     * @return boolean
     */
    public function deleteById($id)
    {
        $menu = $this->getDetailsById($id);
        if($menu) {
            return $menu->delete();
        }
        
        return false;
    }
}