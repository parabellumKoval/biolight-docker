<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/url', function() {
	//$pages = \App\Models\Page::all();
	$pages = DB::table('pages')->get();
	
	foreach($pages as $page){
		//dd($page);
		$new_content =  str_replace('http:\/\/biolight.aimix.space', 'https:\/\/biolight.com.ua', $page->content);
		$content_array = json_decode($new_content, true);
		
		if($content_array) {
			$page_object = \App\Models\Page::findOrFail($page->id);
			
			//dd($page_object);
			$page_object->setTranslations('content', $content_array);
			
			$page_object->save();
			//dd($page_object);
		}
	}
	
});
*/

/*
use App\Mail\FeedbackCreated;
use Illuminate\Support\Facades\Mail;
use App\Models\Feedback;

Route::get('/mail', function () {
		$feedback = Feedback::first();
		
    Mail::to('office@biolight.com.ua')->send(new FeedbackCreated($feedback));
});
*/

Route::get('/', function () {
    return view('welcome');
});
