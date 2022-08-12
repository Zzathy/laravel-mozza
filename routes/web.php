<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\TynUnController;

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
        return view("admin.index");
    })->name("admin.index");

    // Item
    Route::prefix("barang")->group(function() {
        Route::controller(ItemController::class)->group(function() {
            Route::get("/", "index")->name("admin.item.index");
            Route::match(["get", "post"],"/buat", "create")->name("admin.item.create");
            Route::match(["get", "post"],"/ubah/{id}", "update")->name("admin.item.update");
            // Route::delete("/delete", "delete")->name("admin.item.delete");
        });
    });

    // Transaction
    Route::prefix("transaksi")->group(function() {
        Route::controller(TransactionController::class)->group(function() {
            Route::get("/", "index")->name("admin.transaction.index");
            Route::match(["get", "post"],"/buat", "create")->name("admin.transaction.create");
            Route::match(["get", "post"],"/ubah/{id}", "update")->name("admin.transaction.update");
            // Route::delete("/delete", "delete")->name("admin.transaction.delete");
        });
    });

    // Type and Unit
    Route::prefix("jenis-satuan")->group(function() {
        Route::controller(TynUnController::class)->group(function() {
            Route::get("/", "index")->name("admin.tynun.index");
            Route::post("/buat", "create")->name("admin.tynun.create");
            Route::post("/ubah/{id}", "update")->name("admin.tynun.update");
            Route::delete("/hapus/{id}", "delete")->name("admin.tynun.delete");
        });
    });
});
// Item
