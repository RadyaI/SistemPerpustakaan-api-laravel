<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\bukuController;
use App\Http\Controllers\peminjamanController;
use App\Http\Controllers\detailController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| API Routes
|-------------------------------------------------------------------------- 
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|yoi
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//JWT
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);
Route::post('/checkToken',[UserController::class,'getAuthenticatedUser']);

// 

// Route::group(['middleware' =>['jwt.verify']],function () {
    
      Route::post('/logout',[UserController::class,'logout']);
        // Route::group(['middleware' => ['api.admin']],function(){
            Route::post('/createsiswa',[siswaController::class,'createsiswa']);
            // Route::post('/addsiswa',[siswaController::class,'store']);
            Route::put('/updatesiswa/{id}',[siswaController::class,'updatesiswa']);
            Route::post('/createkelas',[kelasController::class,'createkelas']);
            Route::put('/updatekelas/{id}',[kelasController::class,'updatekelas']);
            Route::post('/createbuku',[bukuController::class,'createbuku']);
            Route::put('/updatebuku/{id}',[bukuController::class,'updatebuku']);
            Route::post('/createpeminjaman',[peminjamanController::class,'createpeminjaman']);
            // Route::put('/updatepeminjaman/{id}',[peminjamanController::class,'updatepeminjaman']);
        // });
        
        // Route::group(['middleware' => ['api.superadmin']],function(){
            Route::delete('/deletesiswa/{id}',[siswaController::class,'deletesiswa']);
            Route::delete('/deletekelas/{id}',[kelasController::class,'deletekelas']);
            Route::delete('/deletebuku/{id}',[bukuController::class,'deletebuku']);
            Route::delete('/deletepeminjaman/{id}',[peminjamanController::class,'deletepeminjaman']);
            Route::delete('/deletedetail/{id}',[detailController::class,'deletedetail']);
        // });
        

//SISWA
Route::get('/getsiswa/{id}',[siswaController::class,'getsiswa']);
Route::get('/getsiswa',[siswaController::class,'getsemuasiswa']);


//KELAS
Route::get('/getkelas',[kelasController::class,'getkelas']);
Route::get('/getkelas/{id}',[kelasController::class,'getdetailkelas']);


//BUKU
Route::get('/getbuku',[bukuController::class,'getbuku']);
Route::get('/getbuku/{id}',[bukuController::class,'getdetailbuku']);


//PEMINJAMAN
// Route::get('/getpeminjaman',[peminjamanController::class,'getsemuapeminjaman']);
Route::get('/peminjaman',[peminjamanController::class,'getpeminjaman1']);
Route::get('/peminjaman/{id}',[peminjamanController::class,'getpeminjaman']);
// Route::put('/editpeminjamaan/{id}',[peminjamanController::class,'editpeminjaman']);
Route::get('/getstatus/{status}',[peminjamanController::class,'getstatus']);


// HISTORY
Route::get('/gethistory',[peminjamanController::class,'history']);
// DENDA
Route::get('/getdenda',[peminjamanController::class,'denda']);



//DETAIL
Route::get('/getdetail',[detailController::class,'getdetail']);
Route::post('/createdetail',[detailController::class,'createdetail']);

// });

Route::put('/editpeminjaman/{id}', [peminjamanController::class,'editpeminjaman']);
Route::put('/bayardenda/{id}',[peminjamanController::class,'bayardenda']);
Route::put('/pengembalian/{id}',[peminjamanController::class,'kembali']); 

