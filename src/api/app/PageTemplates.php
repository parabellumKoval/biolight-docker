<?php

namespace App;

trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each page template has its own method, that define what fields should show up using the Backpack\CRUD API.
    | Use snake_case for naming and PageManager will make sure it looks pretty in the create/update form
    | template dropdown.
    |
    | Any fields defined here will show up after the standard page fields:
    | - select template
    | - page name (only seen by admins)
    | - page title
    | - page slug
    */

		private function common()
    {
	    
	    $this->crud->addField([
                        'name' => 'image',
												'type'  => 'browse',
                        'label' => 'Изображение'
                    ]);
                    
        $this->crud->addField([   // CustomHTML
                        'name' => 'metas_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>'.trans('backpack::pagemanager.metas').'</h2><hr>',
                    ]);
                    
        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'seo',
                    ]);
        $this->crud->addField([
                        'name' => 'meta_description',
                        'type' => 'textarea',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'seo',
                    ]);
                    
        $this->crud->addField([   // CustomHTML
                        'name' => 'content_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>'.trans('backpack::pagemanager.content').'</h2><hr>',
                    ]);
                    
        $this->crud->addField([
                        'name' => 'content',
                        'label' => trans('backpack::pagemanager.content'),
                        'type' => 'wysiwyg',
                        'placeholder' => trans('backpack::pagemanager.content_placeholder'),
                    ]);
    }
    
    private function services()
    {
	    
	    $this->crud->addField([
                        'name' => 'image',
												'type'  => 'browse',
                        'label' => 'Изображение'
                    ]);
                    
        $this->crud->addField([   // CustomHTML
                        'name' => 'metas_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>'.trans('backpack::pagemanager.metas').'</h2><hr>',
                    ]);
                    
        $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'seo',
                    ]);
        $this->crud->addField([
                        'name' => 'meta_description',
                        'type' => 'textarea',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'seo',
                    ]);
                    
        $this->crud->addField([   // CustomHTML
                        'name' => 'content_separator',
                        'type' => 'custom_html',
                        'value' => '<br><h2>'.trans('backpack::pagemanager.content').'</h2><hr>',
                    ]);
                    
        $this->crud->addField([
                        'name' => 'short_content',
                        'label' => 'Преамбула',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);
                    
        $this->crud->addField([
                        'name' => 'content',
                        'label' => trans('backpack::pagemanager.content'),
                        'type' => 'wysiwyg',
                        'placeholder' => trans('backpack::pagemanager.content_placeholder'),
                    ]);
    }

    private function home()
    {

// 			SECTION 1

      $this->crud->addField([   // CustomHTML
                      'name' => 'metas_separator_2',
                      'type' => 'custom_html',
                      'value' => '<br><h2>Секция 1</h2><hr>',
                      'tab' => 'Содержание'
                  ]);
      $this->crud->addField([
                        'name' => 'section_1_title',
                        'label' =>'Секция 1 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
      $this->crud->addField([
                        'name' => 'section_1_text',
                        'label' =>'Секция 1 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);

// 			SECTION 2
      $this->crud->addField([   // CustomHTML
                      'name' => 'metas_separator_3',
                      'type' => 'custom_html',
                      'value' => '<br><h2>Секция 2</h2><hr>',
                      'tab' => 'Содержание'
                  ]);
                  
      $this->crud->addField([
                        'name' => 'section_2_title',
                        'label' =>'Секция 2 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_2_desc',
                        'label' =>'Секция 2 (описание)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_2_title-1',
                        'label' =>'Секция 2, блок 1 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
      $this->crud->addField([
                        'name' => 'section_2_text-1',
                        'label' =>'Секция 2, блок 1 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
      $this->crud->addField([
                        'name' => 'section_2_title-2',
                        'label' =>'Секция 2, блок 2 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
      $this->crud->addField([
                        'name' => 'section_2_text-2',
                        'label' =>'Секция 2, блок 2 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
      $this->crud->addField([
                        'name' => 'section_2_title-3',
                        'label' =>'Секция 2, блок 3 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
      $this->crud->addField([
                        'name' => 'section_2_text-3',
                        'label' =>'Секция 2, блок 3 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
// 			SECTION 3
      $this->crud->addField([   // CustomHTML
                      'name' => 'metas_separator_4',
                      'type' => 'custom_html',
                      'value' => '<br><h2>Секция 3</h2><hr>',
                      'tab' => 'Содержание'
                  ]);
      $this->crud->addField([
                        'name' => 'section_3_title',
                        'label' =>'Секция 3 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_3_desc',
                        'label' =>'Секция 3 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
// 			SECTION 4
      $this->crud->addField([   // CustomHTML
                      'name' => 'metas_separator_5',
                      'type' => 'custom_html',
                      'value' => '<br><h2>Секция 4</h2><hr>',
                      'tab' => 'Содержание'
                  ]);
      $this->crud->addField([
                        'name' => 'section_4_title',
                        'label' =>'Секция 4 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_4_desc',
                        'label' =>'Секция 4 (описание)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 
                    
      $this->crud->addField([
                        'name' => 'section_4_text',
                        'label' =>'Секция 4 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 

// 			SECTION 5
      $this->crud->addField([   // CustomHTML
                      'name' => 'metas_separator_6',
                      'type' => 'custom_html',
                      'value' => '<br><h2>Секция 5</h2><hr>',
                      'tab' => 'Содержание'
                  ]);
      $this->crud->addField([
                        'name' => 'section_5_title',
                        'label' =>'Секция 5 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_5_desc',
                        'label' =>'Секция 5 (описание)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 
                    
      $this->crud->addField([
                        'name' => 'section_5_text',
                        'label' =>'Секция 5 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 

// 			SECTION 6
      $this->crud->addField([   // CustomHTML
                      'name' => 'metas_separator_7',
                      'type' => 'custom_html',
                      'value' => '<br><h2>Секция 6</h2><hr>',
                      'tab' => 'Содержание'
                  ]);
      $this->crud->addField([
                        'name' => 'section_6_title',
                        'label' =>'Секция 6 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_6_desc',
                        'label' =>'Секция 6 (описание)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 
                    
      $this->crud->addField([
                        'name' => 'section_6_text',
                        'label' =>'Секция 6 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);                     

// 			SECTION 7
      $this->crud->addField([   // CustomHTML
                      'name' => 'metas_separator_8',
                      'type' => 'custom_html',
                      'value' => '<br><h2>Секция 7</h2><hr>',
                      'tab' => 'Содержание'
                  ]);
      $this->crud->addField([
                        'name' => 'section_7_title',
                        'label' =>'Секция 7 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_7_desc',
                        'label' =>'Секция 7 (описание)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 
                    
      $this->crud->addField([
                        'name' => 'section_7_text',
                        'label' =>'Секция 7 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);                                         

// 			SECTION 7
      $this->crud->addField([   // CustomHTML
                      'name' => 'metas_separator_9',
                      'type' => 'custom_html',
                      'value' => '<br><h2>Секция 8</h2><hr>',
                      'tab' => 'Содержание'
                  ]);
      $this->crud->addField([
                        'name' => 'section_8_title',
                        'label' =>'Секция 8 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_8_title-1',
                        'label' =>'Секция 8, блок 1 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 
                    
      $this->crud->addField([
                        'name' => 'section_8_text-1',
                        'label' =>'Секция 8, блок 1 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_8_title-2',
                        'label' =>'Секция 8, блок 2 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 
                    
      $this->crud->addField([
                        'name' => 'section_8_text-2',
                        'label' =>'Секция 8, блок 2 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_8_title-3',
                        'label' =>'Секция 8, блок 3 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 
                    
      $this->crud->addField([
                        'name' => 'section_8_text-3',
                        'label' =>'Секция 8, блок 3 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
                    
                    
                    
                                                           
                                        
                                        
      $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'seo',
                    ]);
                    
      $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'seo',
                    ]);
    }

    private function advantages()
    {
	    
     $this->crud->addField([
                        'name' => 'section_8_title-1',
                        'label' =>'Блок 1 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 
                    
      $this->crud->addField([
                        'name' => 'section_8_text-1',
                        'label' =>'Блок 1 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_8_title-2',
                        'label' =>'Блок 2 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 
                    
      $this->crud->addField([
                        'name' => 'section_8_text-2',
                        'label' =>'Блок 2 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'section_8_title-3',
                        'label' =>'Блок 3 (заголовок)',
                        'type' => 'text',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]); 
                    
      $this->crud->addField([
                        'name' => 'section_8_text-3',
                        'label' =>'Блок 3 (текст)',
                        'type' => 'wysiwyg',
                        'fake' => true,
                        'store_in' => 'extras',
                        'tab' => 'Содержание'
                    ]);
                    
      $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'seo',
                    ]);
                    
      $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'seo',
                    ]);	    
	  }
	  
	      
    private function contacts()
    {
	    
      $this->crud->addField([
                        'name' => 'map',
                        'label' => 'Карта',
                        'fake' => true,
                        'store_in' => 'extras',
                    ]);
                    
      $this->crud->addField([
                        'name' => 'meta_title',
                        'label' => trans('backpack::pagemanager.meta_title'),
                        'fake' => true,
                        'store_in' => 'seo',
                    ]);
                    
      $this->crud->addField([
                        'name' => 'meta_description',
                        'label' => trans('backpack::pagemanager.meta_description'),
                        'fake' => true,
                        'store_in' => 'seo',
                    ]);	    
	  }
}