<?php

namespace App\Http\Services\Admin;

use App\CMSMenu;
use Illuminate\Http\Request;

class CMSMenuService
{

    
    /**
     * Get all menus
     * 
     * @param Request $request
     * @return json
     */
    public function getMenus(Request $request)
    {  
        $response = array('total' => 0,'rows' => '');
        $allMenus = CMSMenu::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allMenus->cnt;
        $query = CMSMenu::select('id', 'title', 'description');
        if(!empty($request->get('search'))) {
            $query->where('title', 'LIKE', '%' . $request->get('search') . '%');
        }
        
        $menus = $query->orderBy($request->get('sort'), $request->get('order'))
                       ->skip($request->get('offset'))->take($request->get('limit'))
                       ->get();
        if(!empty($request->get('search'))) {
            $response['total'] = $menus->count();
        }
        
        foreach($menus as $menu) {
            $menu->description = ($menu->description && strlen($menu->description) > 150) ? substr($menu->description, 0, 150) : $menu->description;
            $menu->action = '<a href="#" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                            <a href="#" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>';
            if (!in_array($menu->id,[1,2,3,4])) {
                $menu->action .= '<a href="#" title="delete"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a>';
            }
            
            $response['rows'][] = $menu;
        }
        
        return json_encode($response);
    }
}