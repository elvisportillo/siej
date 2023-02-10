<?php

use App\Http\Controllers\InformesGestionController;
use App\Http\Controllers\ReporteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get("/evaluacion", [ReporteController::class, 'evaluacion']);
Route::post("/guardarCriterioEPA1", [ReporteController::class, 'guardarCriterioEPA1']);

Route::get("informes", [InformesGestionController::class, 'mostrarInformes'])->name("informes-de-gestion");
Route::get("buscar-funcionario/{buscar}", [InformesGestionController::class, 'buscarFuncionario']);
Route::get("buscar-judicatura/{buscar}", [InformesGestionController::class, 'buscarJudicatura']);

Route::get("/cargar/{tribunal}/{funcionario}/{mes_evaluado}", [InformesGestionController::class, 'cargarFormularioPorEspecialidad']);

Route::post("/g", [InformesGestionController::class, 'guardar']);

Route::post("/guardarIG", [InformesGestionController::class, 'guardarInformeGestion']);

Auth::routes();


Route::post('/subir',[UserController::class, 'subir'])->name('subir');
Route::group(['middleware' => ['auth']], function(){
    Route::view("home", "home")->name("home");
    Route::resource('roles', RoleController::class);
    Route::resource('usuarios', UserController::class);

    Route::post('usuarios/change_password', [UserController::class, 'change_password'])->name('change_password');

    Route::view('change_password_form', 'usuarios.change_password')->name('change_password_form');

});