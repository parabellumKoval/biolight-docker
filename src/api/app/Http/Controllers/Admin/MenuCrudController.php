<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MenuRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MenuCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MenuCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Menu::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/menu');
        CRUD::setEntityNameStrings('menu', 'menus');
        
        $this->crud->set('reorder.label', 'title');
        $this->crud->set('reorder.max_level', 3);
        
        $this->crud->addFilter([
	        'name'  => 'position',
				  'type'  => 'dropdown',
				  'label' => 'Расположение'
        ],[
				  25        => 'MAIN',
				  24       => 'FOOTER',
				  26       => 'CROSSLINKS',
				],
				function($value) { // if the filter is active
				    $this->crud->addClause('where', 'parent_id', $value);
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
        
        CRUD::column('title')->label('Название');
        //CRUD::column('parent_id')->name('parent_id')->type('select')->entity('parent')->attribute('title')->model('App\Models\Menu')->label('URL');
				
				CRUD::column('position')->label('Расположение');
				
        CRUD::column('link')->label('URL');

				//$this->crud->removeColumn('parent');
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(MenuRequest::class);

        
				CRUD::field('title')->type('text')->label('Название');
// 				CRUD::field('link')->type('text')->label('Ссылка')->hint('Без доменного имени');
				
/*
				CRUD::field('parent_id')->name('parent_id')->type('select2_nested')->entity('parent')->attribute('title')->label('Родительская категория')->model('App\Models\Menu')->options((function ($query) {
			        return $query->orderBy('lft')->where('depth', 1)->get();
			    }));
*/
			  
			  CRUD::addField([
				  'name' => 'parent_id',
				  'type' => 'select2_nested',
				  'entity' => 'parent',
				  'attribute' => 'title',
				  'model' => 'App\Models\Menu',
				  'label' => 'Родительская категория',
				  'options' => (function ($query) {
			        return $query->orderBy('lft')->where('depth', 1)->get();
			    })
			  ]);  
			    
				
				CRUD::field(['type', 'link', 'page_id'])->type('page_or_link')->label('Ссылка')->page_model('\App\Models\Page');
				CRUD::field('is_active')->type('checkbox')->label('Активно?')->default(1);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
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
