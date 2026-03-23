<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('Товар', 'Товары');
        
        $this->crud->addFilter([
				  'type'  => 'simple',
				  'name'  => 'is_active',
				  'label' => 'Активный'
				], 
				false, 
				function() { // if the filter is active
				   $this->crud->addClause('where', 'is_active', 1); // apply the "active" eloquent scope 
				} );

        $this->crud->addFilter([
				  'type'  => 'simple',
				  'name'  => 'in_stock',
				  'label' => 'В наличии'
				], 
				false, 
				function() { // if the filter is active
				   $this->crud->addClause('where', 'in_stock', 1); // apply the "active" eloquent scope 
				} );
        
        $this->crud->addFilter([
				  'name'        => 'category_id',
				  'type'        => 'select2',
				  'label'       => 'Категория товара',
				  'placeholder' => 'Выберите категорию'
				],
				function() {
				    return \App\Models\ProductCategory::all()->keyBy('id')->pluck('name', 'id')->toArray();
				},
				function($value) { // if the filter is active
				    $this->crud->addClause('where', 'category_id', $value);
				});
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        CRUD::column('name')->label('Название');
        CRUD::column('slug')->label('URL');
        CRUD::column('is_active')->label('Активный')->type('check');
        CRUD::column('category_id')->label('Категория')->type('select')->entity('category')->attribute('name')->model('App\Models\ProductCategory');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);

        

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
         
         
        CRUD::field('name')->type('text')->label('Название')->tab('Основное');
        CRUD::field('slug')->label('URL')->hint('Будет сгенерировано автоматически из названия если оставить пустым')->tab('Основное');
        CRUD::field('in_stock')->label('В наличии?')->type('checkbox')->default(1)->tab('Основное');
        CRUD::field('is_active')->label('Активный?')->type('checkbox')->default(1)->tab('Основное');
        CRUD::field('category_id')->label('Категория')->type('select2')->entity('category')->attribute('name')->model('App\Models\ProductCategory')->tab('Основное');
        
        CRUD::field('code')->label('Код товара')->type('text')->tab('Основное');
        CRUD::field('price')->label('Цена')->type('number')->prefix('грн.')->tab('Основное');
        
        
        CRUD::field('description')->type('ckeditor')->label('Описание')->tab('Описание');
        CRUD::field('ingredients')->type('ckeditor')->label('Состав')->tab('Описание');
        
        
        
        CRUD::field('images')->label('Изображения')->type('repeatable')->fields([
	        [
		        'label' => "Картинка",
				    'name' => "image",
				    'type' => 'image',
				    'crop' => true, // set to true to allow cropping, false to disable
				    'aspect_ratio' => 1,
			    ]
        ])->tab('Изображения'); 
        
        CRUD::field('meta_title')->fake(true)->store_in('seo')->type('text')->label('Meta title')->tab('SEO');
        CRUD::field('meta_desc')->fake(true)->store_in('seo')->type('textarea')->label('Meta description')->tab('SEO');
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
