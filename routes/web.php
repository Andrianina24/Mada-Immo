<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ImportcsvController;
use App\Http\Controllers\ProprietaireController;
use Illuminate\Support\Facades\Route;

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

//Redirige vers la page de login client et proprietaire
Route::get('/', function () {
    return view('auth.loginClient');
});
Route::get('/login', function () {
    return view('auth.loginClient');
});

//Client
//aller a la page d'accueil, attérissage apres login
Route::get('/client/index', [ClientController::class, 'index'])->name('client.index');
//retourne un json pour les loyers payés et à payer du client
Route::post('/client/get-loyer', [ClientController::class, 'getLoyer'])->name('client.getLoyer');
//Se deconnecter de client
Route::post('/logout/client', [ClientController::class, 'logout'])
->name('logout.client');

//Proprietaire
//aller a la page d'accueil, attérissage apres login
Route::get('/proprietaire/index', [ProprietaireController::class, 'index'])->name('proprietaire.index');
//retourne un json pour les chiffres d'affaire en deux dates
Route::post('/proprietaire/getChiffre', [ProprietaireController::class, 'getChiffre'])->name('proprietaire.getChiffre');
//se deconnecter de proprietaire
Route::post('/logout/proprietaire', [ProprietaireController::class, 'logout'])
->name('logout.proprietaire');

//Admin
//aller à la page de liste de locations
Route::get('/admin/liste', [AdminController::class, 'liste'])->name('admin.liste');
//aller à la page de details de la location séléctionée
Route::get('/admin/liste/details', [AdminController::class, 'details'])->name('admin.details');
//aller a la page d'accueil, attérissage apres login
Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
// retoure un json pour les stats chiffre d'affaire et gain
Route::post('/admin/stat',[AdminController::class, 'getStat'])->name('admin.stat');
//aller a la page d'insertion de location
Route::get('/admin/insert',  [AdminController::class, 'location'])
->name('admin.location');
//soumission du formulaire d'insertion
Route::post('/admin/insert', [AdminController::class, 'insert']);
//aller a la page du bouton reinitialiser
Route::get('/admin/confirmation', [AdminController::class, 'reinitialiserform'])->name('admin.reinitialiserform');
//lien de reinitialisation
Route::get('/admin/reinitialiser', [AdminController::class, 'reinitialiser'])->name('admin.reinitialiser');
//déconnexion admin
Route::post('logout/admin', [AuthenticatedSessionController::class, 'destroy'])
->name('logout.admin');

//IMPORT
Route::post('/import/bien',[ImportcsvController::class,'importBien'])->name('import.bien');

Route::post('/import/location',[ImportcsvController::class,'importLocation'])->name('import.location');

Route::post('/import/commission',[ImportcsvController::class,'importCommission'])->name('import.commission');

Route::get('/import',[ImportcsvController::class,'create'])->name('import.create');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
