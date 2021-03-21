<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\ProductController;

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});

Route::group(['middleware' => ['auth:sanctum']], function (){
    Route::resource('products', ProductController::class)->only('index', 'store', 'update', 'show', 'destroy');
    Route::get('products/{id}/historic', ['as' => 'products.historic', 'uses' => 'App\Http\Controllers\ProductController@historicByProduct']);
    Route::post('products/bulk', ['as' => 'products.bulk', 'uses' => 'App\Http\Controllers\ProductController@bulk']);
    Route::get('/profile', function (Request $request){
        return $request->user();
    });
    Route::delete('/logout', function (Request $request){
        $request->user()->currentAccessToken()->delete();
    });
});

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);


    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    return $user->createToken($request->device_name)->plainTextToken;
});
