<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\UsersTable;
use App\Http\Livewire\ConfigTable;
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


Route::middleware(['auth'])->group(function () {

    Route::get('/Usuarios', UsersTable::class)
        ->name('users');
    
    Route::get('/Configuraciones', ConfigTable::class)
        ->name('configs');
    
    Route::get('/modules/ventas/PDF/{id}', [ConfigTable::class, 'generatePDF'])
        ->name('generate-pdf');
});

Route::get('/', function () {
    return redirect()->route('configs');
});
