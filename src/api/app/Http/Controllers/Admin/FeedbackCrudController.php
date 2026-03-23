<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FeedbackRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class FeedbackCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class FeedbackCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
//     use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\Feedback::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/feedback');
        CRUD::setEntityNameStrings('Заявка', 'Заявки');
        
        $this->crud->addFilter([
				  'type'  => 'simple',
				  'name'  => 'product_name',
				  'label' => 'Заказ товара'
				], 
				false, 
				function() { // if the filter is active
				   $this->crud->addClause('where', 'product_name', '!=', null); // apply the "active" eloquent scope 
				} );
				
        $this->crud->addFilter([
				  'type'  => 'simple',
				  'name'  => 'product_name_null',
				  'label' => 'Обратная связь'
				], 
				false, 
				function() { // if the filter is active
				   $this->crud->addClause('where', 'product_name', '=', null); // apply the "active" eloquent scope 
				} );				
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
        CRUD::column('created_at')->label('Когда?');
        CRUD::column('name')->label('Имя');
        CRUD::column('email')->label('Email');
        CRUD::column('phone')->label('Телефон');
        CRUD::column('product_name')->label('Товар');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(FeedbackRequest::class);

        
        CRUD::field('name')->label('Имя');
        CRUD::field('email')->label('Email');
        CRUD::field('phone')->label('Телефон');
        CRUD::field('product_name')->label('Товар');

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
