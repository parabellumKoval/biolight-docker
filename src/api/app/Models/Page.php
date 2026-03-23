<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Str;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;
use Backpack\PageManager\app\Models\Page as BackpackPage;

class Page extends BackpackPage
{
    use CrudTrait;
    use Sluggable;
    use SluggableScopeHelpers;
    use HasTranslations;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'pages';
    protected $primaryKey = 'id';
    public $timestamps = true;
    //protected $guarded = ['id'];
    protected $fillable = ['template', 'name', 'title', 'slug', 'content', 'extras', 'seo', 'image'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $fakeColumns = ['seo', 'extras'];
    protected $casts = [
        //'extras' => 'array',
    ];
    
    public $translatable = ['name', 'title', 'content', 'seo', 'extras'];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getPageLink()
    {
        return url($this->slug);
    }

		public function toArray(){
			return [
				'name' => $this->name,
				'title' => $this->title,
				'content' => $this->content,
				'extras' => $this->extras? json_decode($this->extras): null,
				'seo' => $this->seo? json_decode($this->seo): null,
				'image' => $this->image? url($this->image): null,
				'type' => $this->type
			];
		}
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
		
		public function getTypeAttribute(){
			if($this->template == 'services')
				return 'service';
			else
				return 'page';
		}
		
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
