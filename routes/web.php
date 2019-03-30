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
        //API requests could go here? 
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

Route::get('favorite-video', function(){
    Redis::hincrby('user.1.stats', 'favorites', 1);

    return redirect('/');

});


Route::get('/test1/{id}', function ($id){
    return $id;
});

Route::get('/redis', function(){

   return Redis::hgetall('user.1.stats'); 
});

Route::get('/{user}/views', function(){

    return Redis::hgetall("user.$user.stats");
});


Route::redirect('/firstplace', 'secondplace');

Route::get('/secondplace', function(){
    return Redis::hgetall('user.1.stats');
});


Route::view('/welcome', 'welcome');

Route::get('/welcome2', function(){
    return view('welcome');
});

Route::get('foo', function(){
    return "Hello world";
});

//set it up so that going to /weather/{zipcode} allows you to see the cached version
//set a cached version with a single word for now.

// Route::get('/weather/{zipcode}', function($coordinates){
//     // return Redis::get("location.$zipcode.climate");

//     //but next change needs to make this conditional

//     if(Redis::exists("zip.weather")){
//         // return Redis::get('zip.weather');
//         // $store = Redis::get('zip.weather');
//         $store = Redis::get('zip.weather');

//         // return view('weather', ['store' => $store]);
//         return view('weather', ['store' => $store]);
        


//     }

//     else{
//         $store = view('getWeather');
//         // $store = view('getWeather')->withCoordinates(['coordinates' => '37.8267,-122.4233']);

//         Redis::setex("zip.weather", 3600, $store);
//         return view('weather', ['store' => $store]);
//     }

    
// });

Route::get('weather/{coordinates}', function($coordinates){
  
    if(Redis::EXISTS("weather.$coordinates")){
        $weather = Redis::get("weather.$coordinates");
            // return $weather;
    }

    else{
        $weather = weatherFunction($coordinates);

        Redis::setex("weather.$coordinates", 3600, $weather);
        $answer = Redis::get("weather.$coordinates");
    //    return $answer;
    }
   

    return view('coordWeather', ['answer' => $weather]);
});     

Route::get('/about/{id}', function($id){
    Redis::setex("id", "200", $id);
    return $id;
});

Route::get('/push/{id}', function($id){
    Redis::incrby("nowpush.$id", "1");
    return Redis::get("nowpush.$id");
});

Route::get('/dropcount/{amount}', function($amount){
    Redis::incrby('theCount', $amount);
    $returnedValue = Redis::get('theCount');
    return $returnedValue;
});