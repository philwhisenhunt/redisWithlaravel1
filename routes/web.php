<?php

use Illuminate\Support\Facades\Redis;

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
Route::get('videos/{id}', function ($id) {
    $downloads = Redis::get("videos.{$id}.downloads");
    return view('welcome')->withDownloads($downloads);
});

Route::get('videos/{id}/download', function ($id){

    //prepare the download
    Redis::incr("videos.{$id}.downloads");

    return back();
});
*/

Route::get('/', function (){

    $user3Stats = [
        'favorites' => 10,
        'watchLaters' => 20,
        'completions' => 35
    ];  

    Redis::hmset(
        "user.3.stats", $user3Stats);

    return Redis::hgetall('user.3.stats');
});

Route::get('/user/{id}/stats', function ($id){
    return Redis::hgetall("user.$id.stats");
});

