<?php

namespace App\Models;

use Backpack\NewsCRUD\app\Models\Article as BackpackArticle;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;


use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class Article extends BackpackArticle
{
    use CrudTrait;
    use HasTranslations;
    use Sluggable, SluggableScopeHelpers;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'articles';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['slug', 'title', 'content', 'image', 'date'];
    // protected $hidden = [];
    // protected $dates = [];
    
    protected $fakeColumns = ['seo'];
    
    protected $casts = [
        'featured'  => 'boolean',
        'date'      => 'date',
    ];

    public $translatable = ['title', 'content', 'seo'];


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

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



    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
