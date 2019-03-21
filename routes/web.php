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

Route::get('videos/{id}', function ($id) {
    $downloads = Redis::get("videos.{$id}.downloads");
    return view('welcome')->withDownloads($downloads);
});