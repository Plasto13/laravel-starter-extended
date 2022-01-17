<?php
namespace Modules\Core\View\Component;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Nestable extends Component
{

    public $items;
    
    public $editRoute;

    public $bulkChangeRoute;

    private $user;

    public $acces;

    /**
     * [__construct description]
     * @param Eloquent $items  
     * @param string $editRoute Edit Route alias
     * @param string $bulkRoute BulkChange route alias
     * @param string $acces     Permission perfix -> module_model
     * @param Auth   $auth      Loged User
     */     
    public function __construct($items, $acces ='', $delBtn, $editRoute)
    {
        $delBtn = $this->getDeleteButton($acces);
        $this->items = $this->getHTML($items, $acces, $delBtn, $editRoute);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('core::components.nestable');
    }

     /**
     * Build Html
     *
     * @return string
     */
    protected static function build($items, $acces, $delBtn, $editRoute)
    {
        $result = null;
        if ($items) {
            $editBtn = null;
            foreach($items as $item) { 
                if (Auth::user()->isAbleTo($acces.'_update')) {
                    $editBtn = "<a href='".route($editRoute, $item->id)."' class='btn btn-sm btn-info' style='float: right;'>\n
                                    <i class='fas fa-pencil-alt'></i>\n</a>\n";
                }
                    
                    $result .="<li class='dd-item nested-list-item' data-order='{$item->position}' data-id='{$item->id}'>
                    <div role='group' aria-label='Action buttons' class='btn-group' style='display: inline;'> 
                    {$delBtn} 
                    {$editBtn}              
                        <button class='btn btn-sm btn-default detail' data-id='{$item->id}' data-toggle='modal' data-target='#modal-detail' data-action-target='' title='{{trans('core::core.detail')}}' style='float: right;'>
                            <i class='fa fa-eye'></i>
                        </button>
                    </div>
                    <div class='dd-handle nested-list-handle'>
                        <i class='fas fa-arrows-alt'></i> {$item->title}
                    </div>".self::build($item->childs()->orderBy('position')->get(), $acces, $delBtn, $editRoute) ."</li>"; 
            
            }
            return $result ?  "\n<ol class=\"dd-list\">\n$result</ol>\n" : null; 
        }
    }

    // Getter for the HTML menu builder
    protected function getHTML($items, $acces, $delBtn, $editRoute)
    {
        return self::build($items, $acces, $delBtn, $editRoute);
    }

    protected function getDeleteButton($acces)
    {
        if (Auth::user()->isAbleTo($acces.'_delete')) {
            return "<button class='btn btn-sm btn-danger' data-toggle='modal' data-target='#modal-delete-confirmation' data-action-target='' title='{{trans('base::halls.destroy resource')}}' style='float: right;'>
                            <i class='fa fa-trash'></i>
                </button>";
        }
        return null;
    }
}
