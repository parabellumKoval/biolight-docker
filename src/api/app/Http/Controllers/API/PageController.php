<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use App\Models\ProductCategory;

use App\Http\Resources\CategoryResource;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $pages = Page::all()->pluck('slug');
       $categories = ProductCategory::all()->pluck('slug');
       
       return ['pages' => $pages, 'categories' => $categories];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
	    $page = Page::where('slug', $slug)->first();
	    
	    if(!$page) {
	    	$page = ProductCategory::where('slug', $slug)->firstOrFail();
	    	$page = new CategoryResource($page);
	    	
	    }
	    
      return response()->json($page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
