<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class Menu extends Model
{
    use CrudTrait;
    use HasTranslations;

    public $translatable = ['title'];
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'menu';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
		public function toArray() {
			return [
				'id' => $this->id,
				'title' => $this->title,
				'link' => $this->url(),
				'children' => $this->children()->orderBy('lft')->get()
			];
		}
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id');
    }
    
    public function page()
    {
        return $this->belongsTo('App\Models\Page', 'page_id');
    }    
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
		
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
    public function getPositionAttribute(){
	    $parent = $this->parent;
	    
	    if($parent && !$parent->parent)
	    	return $parent->title;
	    elseif($parent && $parent->parent)
	    	return $parent->parent->title;
	    else
	    	return $this->title;
	    
    }
    
    
    public function url()
    {
        switch ($this->type) {
            case 'external_link':
                return $this->link;
                break;

            case 'internal_link':
                return is_null($this->link) ? '#' : $this->link;
                break;
						
						case 'page_link':
							if ($this->page) {
								return '/' . $this->page->slug;
							}
							break;
						
            default: //page_link
                return $this->link;
                break;
        }
    }
}
