<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CovidController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware(['auth:sanctum'])->group(function() {

    //! Yang bisa melakukan ini semua hanya lah admin / yang sudah mempunyai akun

    
    //* mengupdate data
    // method find & update
    Route::put('/patients/{id}',[CovidController::class, 'update']);
    
    //* menghapus data
    // method delete & find
    Route::delete('/patients/{id}',[CovidController::class, 'delete']);
});

//? user dapat melakukan ini semua 

//* get all resource student
// method get
Route::get('/patients',[CovidController::class, 'index']);

//* menambahkan data pasient
// method  store & create
Route::post('/patients',[CovidController::class, 'store'])->middleware('auth:sanctum');


//* Get Detail Resource
// method show & find
Route::get('/patients/{id}',[CovidController::class, 'show']);


//* mencari data sesuai nama
// method where & get
Route::get('/patients/search/{name}',[CovidController::class, 'search']);

//* mencari data yang positif
// method where & get
Route::get('/patients/status/positive',[CovidController::class, 'positive']);

//* mencari data yang sembuh
// method where & get
Route::get('/patients/status/recovered',[CovidController::class, 'recovered']);

//* mencari data yang mati
// method where & get
Route::get('/patients/status/dead',[CovidController::class, 'dead']);

//* membuat route untuk register dan login
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
