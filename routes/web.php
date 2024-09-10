<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::controller(TaskController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::post('/task', 'store')->name('store.task');
    Route::delete('/task/{task}', 'delete')->name('delete.task');  
});
