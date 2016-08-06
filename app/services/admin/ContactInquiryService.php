<?php

namespace App\Services\Admin;

use URL;
use Input;
use App\Models\ContactUs;
use Illuminate\Http\Request;
 
class ContactInquiryService
{
    /**
     * Get parent menu list which can be used to include the other sub contents.
     * 
     * @return Collection App\Models\ContactUs
     */
    public function getParentMenus()
    {
        return ContactUs::select('id','title')
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
    public function getRecords()
    {
        $response = array('total' => 0, 'rows' => '');
        $allMenus = ContactUs::select(\DB::raw('COUNT(*) as cnt'))->first();
        $response['total'] = $allMenus->cnt;
        $query = ContactUs::select('id', 'name','email', 'subject','message');
        if (!empty(Input::get('search'))) {
            $query->where('email', 'LIKE', '%' . Input::get('search') . '%');
        }

        $inquiries = $query->orderBy(Input::get('sort'), Input::get('order'))
                ->skip(Input::get('offset'))->take(Input::get('limit'))
                ->get();
        if (!empty(Input::get('search'))) {
            $response['total'] = $inquiries->count();
        }

        foreach ($inquiries as $inquiry) {
            $inquiry->subject = ($inquiry->subject && strlen($inquiry->subject) > 50) ? substr($inquiry->subject, 0, 50) : $inquiry->subject;
            $inquiry->message = ($inquiry->message && strlen($inquiry->message) > 50) ? substr($inquiry->message, 0, 50) : $inquiry->message;
            $inquiry->action = '<a href="' . URL::route('admin.inquiry.show', ['id' => $inquiry->id]) . '" title="view"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                             <a href="' . URL::route('admin.inquiry.destroy', ['id' => $inquiry->id]) . '" onClick="javascript: return confirm(\'Are You Sure\');" title="delete"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>';
            
            $response['rows'][] = $inquiry;
        }

        return json_encode($response);
    }

    /**
     * Get menu details according to the id 
     * 
     * @param integer $id
     * @return App\Models\ContactUs
     */
    public function getDetailsById($id)
    {
        return ContactUs::find($id);
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
        if($inquiry) {
            return $inquiry->delete();
        }
        
        return false;
    }
}