<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('web');
Route::middleware('guest')->group(function () {
    Route::post(
        'call-api',
        function (Request $request) {
            if (isset($request->type_api)) {
                if ($request->type_api == 'register') {
                    return RegisteredUserController::storeAPI($request);
                } else if ($request->type_api == 'login') {
                    return RegisteredUserController::storeAPI($request);
                } else {
                    return response()->json(["error" => "Lỗi không xác định"]);
                }
            } else {
                return response()->json(["error" => "Lỗi không xác định"]);
            }
        }
    );
});
// refresh token
Route::middleware('auth:sanctum')->post('/tokens/create', function (Request $request) {
    $token = $request->user()->createToken($request->token_name);
    return ['token' => $token->plainTextToken];
});
// logout
Route::post('/tokens/destroy', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    
});
// login
Route::post('/sanctum/token', function (Request $request) {

 
    $user = User::where('username', $request->username)->first();
 
    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'username' => ['Thông tin đăng nhập được cung cấp không chính xác.'],
        ]);
    }
    return $user->createToken($request->device_name)->plainTextToken;
});





// get data
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
