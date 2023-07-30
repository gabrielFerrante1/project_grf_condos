<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResidentController;
use App\Models\Resident;

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

Route::get('/', function () {
    return  redirect('/login');
});

//Rotas da administração
    //Rota para o painel    
    Route::get('/painel', [HomeController::class, 'indexView']);

    Route::get('/towers', [AdminController::class, 'viewTowers']);
        Route::post('/towers', [AdminController::class, 'towerDb']);
        Route::get('/edit/cond', [AdminController::class, 'editBuilding']);
        Route::get('/del/building/{id}', [AdminController::class, 'delBuilding']);

    Route::get('/new-user', [AdminController::class, 'viewNewUser']);
        Route::post('/new-user', [AdminController::class, 'newUser']);
        Route::get('/users', [AdminController::class, 'allUsers']);
        Route::get('/edit/user/{id}', [AdminController::class, 'editUserView']);
        Route::post('/edit/user/{id}', [AdminController::class, 'editUserDb']);
        Route::get('/delet/user/{id}', [AdminController::class, 'delUser']);
        Route::get('/done/area/{id}', [AdminController::class, 'toogleAreaStatus']);
    
    Route::get('/areas', [AdminController::class, 'viewAreas']);
        Route::post('/areas', [AdminController::class, 'addArea']);
        Route::get('/edit/area/{id}', [AdminController::class, 'editAreaView']);
        Route::post('/edit/area/{id}', [AdminController::class, 'editAreaDb']);
        Route::get('/del/area/{id}', [AdminController::class, 'delArea']);

    Route::get('/documents', [AdminController::class, 'documents']);
        Route::post('/documents', [AdminController::class, 'addDocument']);
        Route::get('/edit/document/{id}', [AdminController::class, 'editDocument']);
        Route::get('/del/document/{id}', [AdminController::class, 'delDocument']);

    Route::get('/occurrences', [AdminController::class, 'occurrencesView']);
        Route::post('/occurrences', [AdminController::class, 'newOccurrence']);
        Route::get('/del/occurence/{id}', [AdminController::class, 'delOccurrence']);
    
    Route::get('/occurrences/residents', [ResidentController::class, 'allOccurrences']);

    Route::get('/documents/residents', [ResidentController::class, 'documentsResdientsAll']);

    Route::get('/reservations/residents', [ResidentController::class, 'viewReservation']);
        Route::post('/reservations/residents', [ResidentController::class, 'addReservation']);
        Route::get('/reservations/residents/all', [ResidentController::class, 'allReservations']);
        Route::get('/del/dl/{id}', [ResidentController::class, 'delReservation']);
    
    Route::get('/achados/residents', [ResidentController::class, 'achadosView']);
        Route::post('/achados/residents', [ResidentController::class, 'addAchadosAndPerdidos']);
        Route::get('/achados/residents/all', [ResidentController::class, 'allAchados']);
    
Auth::routes(); 
 
Route::post('/login', [HomeController::class, 'loginOwner']);

Route::get('/login-resident', [App\Http\Controllers\HomeController::class, 'loginResident']);
Route::post('/login-resident', [App\Http\Controllers\HomeController::class, 'loginResidentDB']);
Route::get('/logout', [HomeController::class, 'logOut']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
