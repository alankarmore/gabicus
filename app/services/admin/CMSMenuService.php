<?php

namespace App\Services\Admin;

use URL;
use Input;
use Validator;
use App\Models\CMSMenu;
use App\Helpers\FileHelper;

class CMSMenuService
{

    /**
     * Get parent menu list which can be used to include the other sub contents.
     * 
     * @return Collection App\CMSMenu
     */
    public function getParentMenus()
    {
        return CMSMenu::select('id', 'title')
                        ->whereNull('include_in')
                        ->orderBY('title', 'ASC')
                        ->get();
    }

    /**
     * Get all menus
     * 
     * @return json
     */
    public function getRecords()
    {
        $response = array('total' => 0, 'rows' => '');
        $allMenus = CMSMenu::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allMenus->cnt;
        $search = Input::get('search');
        $query = CMSMenu::select('id', 'title', 'description', 'status', 'meta_title', 'meta_description', 'meta_keyword');
        if (!empty($search)) {
            $query->where('title', 'LIKE', '%' . Input::get('search') . '%');
        }

        $menus = $query->orderBy(Input::get('sort'), Input::get('order'))
                ->skip(Input::get('offset'))->take(Input::get('limit'))
                ->get();
        if (!empty($search)) {
            $response['total'] = $menus->count();
        }

        foreach ($menus as $menu) {
            $menu->meta_title = ($menu->meta_title && strlen($menu->meta_title) > 50) ? substr($menu->meta_title, 0, 50) : ($menu->meta_title == null) ? 'NA' : $menu->meta_title;
            $menu->description = ($menu->description && strlen($menu->description) > 50) ? substr($menu->description, 0, 100) : $menu->description;
            $menu->meta_keyword = ($menu->meta_keyword && strlen($menu->meta_keyword) > 50) ? substr($menu->meta_keyword, 0, 50) : ($menu->meta_keyword == null) ? 'NA' : $menu->meta_keyword;
            $menu->meta_description = ($menu->meta_description && strlen($menu->meta_description) > 50) ? substr($menu->meta_description, 0, 50) : ($menu->meta_description == null) ? 'NA' : $menu->meta_description;
            $menu->action = '<a href="' . URL::route('admin.menu.show', ['id' => $menu->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('admin.menu.edit', ['id' => $menu->id]) . '" title="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>';
            if (!in_array($menu->id, [1, 2, 3, 4])) {
                $menu->action .= ' <a href="' . URL::route('admin.menu.destroy', ['id' => $menu->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            } else {
                $menu->action .= ' <a href="javascript:void(0);" title="Not allowed to remove"><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span></a>';
            }

            $response['rows'][] = $menu;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return App\CMSMenu
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
     * @return App\CMSMenu
     */
    public function saveOrUpdateDetails($id = null)
    {
        $menu = new CMSMenu();
        if (!empty($id)) {
            $menu = $this->getDetailsById($id);
            $menu->updated_at = date("Y-m-d H:i:s");
        } else {
            $menu->status = 1;
            $menu->created_at = date("Y-m-d H:i:s");
        }

        $menu->title = trim(Input::get('title'));
        $menu->include_in = (trim(Input::get('include_in'))) ? trim(Input::get('include_in')) : NULL;
        $menu->slug = strtolower(str_replace(' ', '-', $menu->title));
        $menu->description = trim(Input::get('description'));
        $menu->meta_title = trim(Input::get('meta_title'));
        $menu->meta_keyword = trim(Input::get('meta_keyword'));
        $menu->meta_description = trim(Input::get('meta_description'));
        
        $file = trim(Input::get('fileName'));
        if(isset($file) && !empty($file)) {
            if(!empty($id)) {
                $previousPath = public_path('uploads/course/' . $menu->image);
                if(file_exists($previousPath)) {
                    @unlink($previousPath);
                }
            }
            
            $fileHelper = new FileHelper();
            $tempPath = public_path('uploads/temp/' . $file);
            if(file_exists($tempPath)) {
                $destination = public_path('uploads/course/' . $file);
                $fileHelper->moveFile($tempPath, $destination);                
                $menu->image = $file;
            }
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
        if ($menu) {
            return $menu->delete();
        }

        return false;
    }

    public function validate($data, $id = null)
    {
        try {
            $rules = array('title' => 'required|max:150',
                'description' => 'required',
                'image' => 'mimes:jpeg,jpg,png');

            if ($data['include_in'] <= 0) {
                $rules['meta_title'] = 'sometimes|required|max:255';
                $rules['meta_keyword'] = 'sometimes|required|max:255';
                $rules['meta_description'] = 'sometimes|required|max:255';
            } else {
                unset($rules['image']);
            }
            
            $messages = array(
                'title.required' => 'Menu title is missing',
                'title.max' => 'Menu title must not be greater than 150 characters',
                'meta_title.required' => 'Meta title is missing',
                'meta_title.max' => 'Meta title must not be greater than 255 characters',
                'meta_keyword.required' => 'Meta Keyword is missing',
                'meta_keyword.max' => 'Meta Keyword must not be greater than 255 characters',
                'meta_description.required' => 'Meta description is missing',
                'meta_description.max' => 'Meta description must not be greater than 255 characters',
                //'title.alpha_spaces' => 'Menu title must contain letters and spaces',
                'description.required' => 'Menu description is missing',
                'image.required' => 'Menu Image is missing',
                'image.mimes' => 'Menu image must be of type jpeg,jpg,png',
            );
            
            return Validator::make($data, $rules, $messages);
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage(), $ex->getCode());
        }
    }

}
