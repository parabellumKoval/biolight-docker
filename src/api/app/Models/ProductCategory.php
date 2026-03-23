<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/*
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\Sluggable;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\SluggableScopeHelpers;
*/

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class ProductCategory extends Model
{
    use CrudTrait;
    use HasTranslations;
    use Sluggable, SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'product_categories';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
/*
    protected $casts = [
	    'seo' => 'array'
    ];
*/
    
    protected $fakeColumns = ['meta_title','meta_desc','meta_text', 'seo'];
    
    public $translatable = ['name', 'description', 'seo'];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'slug_or_name',
            ],
        ];
    }

    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
		public function products() {
			return $this->belongsToMany('App\Models\Product');
		}

    public function parent()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\ProductCategory', 'parent_id');
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
    public function getSlugOrNameAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->name;
    }

    public function getNodeIdsAttribute($category){
			$category = $category? $category: $this;
			
			$start_carry = array($category->id);
			
			return $category->children->reduce(function ($carry, $item) {
				
				$carry[] = $item->id;
				
				if($item->children)
					$ids = $this->getNodeIdsAttribute($item);
				
			    return array_merge($carry, $ids);
			}, $start_carry);
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
}
