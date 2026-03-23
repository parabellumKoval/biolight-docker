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


use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class Product extends Model
{
    use CrudTrait;
    use HasTranslations;
    use Sluggable, SluggableScopeHelpers;


    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'products';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    //protected $fillable = ['name'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $casts = [
	    'images' => 'array'
    ];
    
    protected $fakeColumns = ['meta_title','meta_desc', 'seo'];
    
    public $translatable = ['name', 'description', 'ingredients', 'seo'];

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
    
    public function toArray() {
	    return [
	    	'id' => $this->id,
        'name' => $this->name,
        'slug' => $this->slug,
        'link' => $this->link,
        'code' => $this->code,
        'in_stock' => $this->in_stock,
        'price' => $this->price,
        'images' => $this->imagesArray,
        'category_link' => '/' . $this->category->slug,
        'category_name' => $this->category->name,
        'description' => $this->description,
        'ingredients' => $this->ingredients,
        'seo' => $this->seo? json_decode($this->seo): null
	    ];
    }
    
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function category()
    {
        return $this->belongsTo('App\Models\ProductCategory', 'category_id');
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
    
    public function getMainImageAttribute(){
	  	if(!empty($this->images) && isset($this->images[0]))
	  		return $this->images[0]->image;
	  	else
	  		return '/';
    }
    
    public function getLinkAttribute() {
	    if($this->category)
	    	return '/' . $this->category->slug . '/' . $this->slug;
	    else
	    	return '/' . $this->slug;
    } 
    
    public function getImagesArrayAttribute(){
	    if(empty($this->images))
	    	return [];
	    	
	    return array_map(function($item) {
		    	return $item->image;
		  },$this->images);
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
		public function getImagesAttribute($value) {
			if($value)
				return json_decode($value);
			else
				return null;
		}
		
		public function setImagesAttribute($values)
    {
			//dd($values);
	   	
      $attribute_name = "images";
      $images = [];
	   
	    foreach($values as $key => $value) {
		    
		    $value = $value->image;
		    
        // or use your own disk, defined in config/filesystems.php
        $disk = config('backpack.base.root_disk_name'); 
        // destination path relative to the disk above
        $destination_path = "public/uploads/products"; 

        // if the image was erased
        if ($value==null) {
	        
            // delete the image from disk
            if($this->images && count($this->images))
							foreach($this->{$attribute_name} as $image) {
				        $image = $image->image;
								\Storage::disk($disk)->delete($image);
            	}

            // set null in the database column
            //$this->attributes[$attribute_name] = null;
        }

				
        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5(time()).'.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
						
						
						if($this->{$attribute_name} && count($this->{$attribute_name})){
							
							foreach((array)$this->{$attribute_name} as $image) {
		            // 3. Delete the previous image, if there was one.
		            if(isset($image->image) && !empty($image->image))
		            	\Storage::disk($disk)->delete($image->image);
	            }
	          
	          }  

						
            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it 
            // from the root folder; that way, what gets saved in the db
            // is the public URL (everything that comes after the domain name)
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            
            $images[] = ['image' => '/'.$public_destination_path.'/'.$filename];
        }else {
	        $images[] = ['image' => $value];
        }
      }
      
      $this->attributes[$attribute_name] = json_encode($images);
    }    
}
