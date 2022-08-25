<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\Admin\TynUnController;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;


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

// Test PDF
Route::get("/pdf", function () {
    // Get all Transactions data
    $transactions = Transaction::all();
    dd($transactions);

    // Get created_at that can't duplicated
    $created = DB::table("transactions")->distinct()->pluck("created_at");
    dd($created);

    // Get first data where the created_at is same
    $transaction = Transaction::where("created_at", "2022-08-16 15:05:15")->get();
    dd($transaction);

    $pdf = PDF::loadView("pdf");
    return $pdf->stream();
});

// Admin
// Route::prefix("admin")->group(function() {
    // Base
    Route::get('/', function () {
        return view("admin.index");
    })->name("admin.index");

    // Item
    Route::prefix("barang")->group(function() {
        Route::controller(ItemController::class)->group(function() {
            Route::get("/", "index")->name("admin.item.index");
            Route::post("/buat", "create")->name("admin.item.create");
            Route::post("/ubah/{id}", "update")->name("admin.item.update");
            Route::delete("/hapus/{id}", "delete")->name("admin.item.delete");
        });
    });

    // Transaction
    Route::prefix("transaksi")->group(function() {
        Route::controller(TransactionController::class)->group(function() {
            Route::get("/", "index")->name("admin.transaction.index");
            Route::post("/buat", "create")->name("admin.transaction.create");
            Route::match(["get", "post"],"update")->name("admin.transaction.update");
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
// });
