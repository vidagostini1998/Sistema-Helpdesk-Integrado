<?php

use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\FilialController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PatrimoniosController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UserController;
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

//Login
Route::get('/', function () {return view('login');})->name('login');
//

//Auth Login/Logout
Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
//

//Rotas com acesso Autenticado
Route::middleware('auth')->group(function () {

    //Home
    Route::view('/home', 'home')->name('home');
    //

    //LOG
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
    //

    //Usuarios
    Route::get('/administracao/users', [UserController::class, 'index'])->name('adm.users');
    Route::get('/administracao/users/edit/{id}', [UserController::class, 'edit'])->name('adm.users.show');
    Route::post('/administracao/users/editar', [UserController::class, 'update'])->name('users.edit');
    Route::post('/administracao/users/adc', [UserController::class, 'store'])->name('users.adc');
    Route::get('/administracao/users/desabilitar/{id}', [UserController::class, 'desabilitar'])->name('users.desabilitar');
    Route::get('/administracao/users/habilitar/{id}', [UserController::class, 'habilitar'])->name('users.habilitar');
    //

    //Perfil
    Route::get('/meu_perfil', [PerfilController::class, 'index'])->name('users.meu_perfil');
    Route::post('/meu_perfil/editar', [PerfilController::class, 'update'])->name('perfil.edit');
    //

    //Filial
    Route::get('/cadastros/filiais', [FilialController::class, 'index'])->name('cadastros.filial');
    Route::post('/cadastros/filiais/adc_filial', [FilialController::class, 'store'])->name('filial.adc');
    Route::get('/cadastros/filiais/del_filial/{id}', [FilialController::class, 'destroy'])->name('filial.del');
    Route::get('/cadastros/filiais/edit/{id}', [FilialController::class, 'edit'])->name('filial.show');
    Route::post('/cadastros/filiais/editar', [FilialController::class, 'update'])->name('filial.edit');
    //

    //Local
    Route::get('/cadastros/locals', [LocalController::class, 'index'])->name('cadastros.local');
    Route::post('/cadastros/locals/adc_local', [LocalController::class, 'store'])->name('local.adc');
    Route::get('/cadastros/locals/del_local/{id}', [LocalController::class, 'destroy'])->name('local.del');
    Route::get('/cadastros/locals/edit/{id}', [LocalController::class, 'edit'])->name('local.show');
    Route::post('/cadastros/locals/editar', [LocalController::class, 'update'])->name('local.edit');
    //

    //Categorias
    Route::get('/cadastros/categorias',[CategoriasController::class,'index'])->name('cadastros.categorias');
    Route::post('/cadastros/categorias/adc_cate_patri',[CategoriasController::class,'storePatri'])->name('categorias.adc.patri');
    Route::get('/cadastros/categorias/edit_patri/{id}', [CategoriasController::class, 'editPatrimonio'])->name('categorias.show.patri');
    Route::post('/cadastros/categorias/patrimonio/editar',[CategoriasController::class,'updatePatrimonio'])->name('categorias.edit.patri');
    Route::get('/cadastros/categorias/patrimonio/del/{id}',[CategoriasController::class,'destroyPatrimonio'])->name('categorias.del.patri');
    Route::post('/cadastros/categorias/adc_cate_insu',[CategoriasController::class,'storeInsu'])->name('categorias.adc.insu');
    Route::get('/cadastros/categorias/edit_insu/{id}', [CategoriasController::class, 'editInsumo'])->name('categorias.show.insu');
    Route::post('/cadastros/categorias/insumo/editar',[CategoriasController::class,'updateInsumo'])->name('categorias.edit.insu');
    Route::get('/cadastros/categorias/insumo/del/{id}',[CategoriasController::class,'destroyInsumo'])->name('categorias.del.insu');
    //

    //Patrimonios
    Route::get('/cadastros/patrimonios',[PatrimoniosController::class,'index'])->name('cadastros.patrimonios');
    Route::post('/cadastros/patrimonios/adc_patrimonio',[PatrimoniosController::class,'store'])->name('patrimonio.adc');
    Route::get('/cadastros/patrimonios/edit_patrimonio/{id}',[PatrimoniosController::class,'edit'])->name('patrimonio.show');
    Route::post('/cadastros/patrimonios/editar',[PatrimoniosController::class,'update'])->name('patrimonio.edit');
    //

});
