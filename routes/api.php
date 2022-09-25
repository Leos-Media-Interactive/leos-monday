<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/call', function (Request $request) {
    return response('Hello World', 200)
        ->header('Content-Type', 'text/plain');
});


Route::get('/call', function (Request $request){
    $token = config('app.api_token');
    $request_token = $request->token;
    $phone = $request->phone;
    $target = $request->target;

    return response()->json([
        'challenge' => $request->challenge,
    ]);

//    if($token !== $request_token){
//        return response('No No No', 401);
//    }else{
//
//
//
//        $response = Http::post('https://api.voicenter.com/ForwardDialer/click2call.aspx', [
//            'phone' => $phone,
//            'target' => $target,
//        ]);
//
//
//        return response()->json([
//            'app_token' => $token,
//            'you_token' => $request_token,
//        ]);
//    }


});
