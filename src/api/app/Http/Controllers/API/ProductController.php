<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductController extends Controller
{
	
	
    public function all() {
	    $products = Product::all();
	    
	    $products = ProductResource::collection($products);
	    
	    return response()->json($products);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    	$node_ids = [];
	    	
	    	try{
		    	if(request('category_id')){
			    	$node_ids = ProductCategory::find(request('category_id'))->nodeIds;
			    }elseif(request('category_slug')){
			    	$category = ProductCategory::where('slug', request('category_slug'))->firstOrFail();
			    	$node_ids = $category->nodeIds;
			    }
		    }catch(\Exception $e){
			    $node_ids = [];
		    }
	    
        $products = Product::query()
                  ->select('products.*')
                  ->distinct('products.id')
                  ->where('is_active', 1)
                  ->when(request('category_id'), function($query) use($node_ids){
                  	$query->whereIn('products.category_id', $node_ids);
                  })
                  ->when(request('category_slug'), function($query) use($node_ids){
                  	$query->whereIn('products.category_id', $node_ids);
                  });
        
        $per_page = request('per_page', 12);
        
        $products = $products->paginate($per_page);
        $products = new ProductCollection($products);
        
        return $products;
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
	    return Product::where('slug', $slug)->firstOrFail();
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
