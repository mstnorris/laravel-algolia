<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use App\Contracts\Search;
use Illuminate\Http\Request;

Route::get('/', function (Search $search, Request $request) {

$results = $search->index('test_drive_contacts')
                  ->get($request->name);

return view('results', compact('results'));
});