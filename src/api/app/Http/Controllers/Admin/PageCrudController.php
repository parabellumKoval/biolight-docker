<?php

namespace App\Http\Controllers\Admin;

use App\PageTemplates;
// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\PageManager\app\Http\Requests\PageRequest;
use Str;

use Backpack\PageManager\app\Http\Controllers\Admin\PageCrudController as BackpackPageCrudController;

class PageCrudController extends BackpackPageCrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { create as traitCreate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { edit as traitEdit; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use PageTemplates;

    public function setup()
    {
        $this->crud->setModel(config('backpack.pagemanager.page_model_class', 'Backpack\PageManager\app\Models\Page'));
        $this->crud->setRoute(config('backpack.base.route_prefix').'/page');
        $this->crud->setEntityNameStrings(trans('backpack::pagemanager.page'), trans('backpack::pagemanager.pages'));
    }


    // -----------------------------------------------
    // Overwrites of CrudController
    // -----------------------------------------------

    protected function setupCreateOperation()
    {
        // Note:
        // - default fields, that all templates are using, are set using $this->addDefaultPageFields();
        // - template-specific fields are set per-template, in the PageTemplates trait;

        $this->addDefaultPageFields(\Request::input('template'));
        $this->useTemplate(\Request::input('template'));
        
        $this->crud->setValidation(PageRequest::class);
    }

    protected function setupUpdateOperation()
    {
        // if the template in the GET parameter is missing, figure it out from the db
        $template = \Request::input('template') ?? $this->crud->getCurrentEntry()->template;

        $this->addDefaultPageFields($template);
        $this->useTemplate($template);

        $this->crud->setValidation(PageRequest::class);
    }

}
