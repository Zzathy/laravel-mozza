<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ItemController;

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

// Base
Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::prefix("admin")->group(function() {
    // Base
    Route::get('/', function () {
        return view('index');
    });

    // Item
    Route::prefix("barang")->group(function() {
        Route::controller(ItemController::class)->group(function() {
            Route::get("/", "index")->name("admin.item.index");
            Route::match(["get", "post"],"/buat", "create")->name("admin.item.create");
            Route::match(["get", "post"],"/ubah/{id}", "update")->name("admin.item.update");
            // Route::delete("/delete", "delete")->name("admin.item.delete");
        });
    });
});
// Item
