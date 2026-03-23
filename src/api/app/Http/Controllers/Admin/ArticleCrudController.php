<?php

namespace App\Http\Controllers\Admin;


use Backpack\NewsCRUD\app\Http\Controllers\Admin\ArticleCrudController as BackpackArticleCrudController;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\ArticleRequest;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ArticleCrudController extends BackpackArticleCrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(\App\Models\Article::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/article');
        $this->crud->setEntityNameStrings('запись', 'записи');

        /*
        |--------------------------------------------------------------------------
        | LIST OPERATION
        |--------------------------------------------------------------------------
        */
        $this->crud->operation('list', function () {
            $this->crud->addColumn([
            	'name' => 'title',
							'label' => 'Заголовок'
            ]);
            $this->crud->addColumn([
                'name' => 'date',
                'label' => 'Дата публикации',
                'type' => 'date',
            ]);
            
        });

        /*
        |--------------------------------------------------------------------------
        | CREATE & UPDATE OPERATIONS
        |--------------------------------------------------------------------------
        */
        $this->crud->operation(['create', 'update'], function () {
            $this->crud->setValidation(ArticleRequest::class);

            $this->crud->addField([
                'name' => 'title',
                'label' => 'Заголовок',
                'type' => 'text',
                'placeholder' => 'Your title here',
            ]);
            $this->crud->addField([
                'name' => 'slug',
                'label' => 'Slug (URL)',
                'type' => 'text',
                'hint' => 'Сгенерируется автоматически если оставить пустым.',
                // 'disabled' => 'disabled'
            ]);
            $this->crud->addField([
                'name' => 'date',
                'label' => 'Дата публикации',
                'type' => 'date',
                'default' => date('Y-m-d'),
            ]);
            $this->crud->addField([
                'name' => 'content',
                'label' => 'Содержание',
                'type' => 'ckeditor',
            ]);
            $this->crud->addField([
                'name' => 'image',
                'label' => 'Изображение',
                'type' => 'browse',
            ]);
            
						CRUD::field('meta_title')->fake(true)->store_in('seo')->type('text')->label('Meta title');
						CRUD::field('meta_desc')->fake(true)->store_in('seo')->type('textarea')->label('Meta description');
            
/*
            $this->crud->addField([
                'label' => 'Category',
                'type' => 'relationship',
                'name' => 'category_id',
                'entity' => 'category',
                'attribute' => 'name',
                'inline_create' => true,
                'ajax' => true,
            ]);
            $this->crud->addField([
                'label' => 'Tags',
                'type' => 'relationship',
                'name' => 'tags', // the method that defines the relationship in your Model
                'entity' => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'inline_create' => ['entity' => 'tag'],
                'ajax' => true,
            ]);
            $this->crud->addField([
                'name' => 'status',
                'label' => 'Status',
                'type' => 'select_from_array',
                'options' => ['PUBLISHED', 'DRAFT'],
            ]);
            $this->crud->addField([
                'name' => 'featured',
                'label' => 'Featured item',
                'type' => 'checkbox',
            ]);
*/
        });
    }

}
