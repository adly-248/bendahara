<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoryController;
//use App\Http\Controllers\UserMenu;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\UserMenuController;
use App\Http\Controllers\PemasukkanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PanduanController;
use App\Http\Controllers\DeveloperController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Data Kategory
    Route::get('kategory', [KategoryController::class, 'index'])->name('kategory.index');
    Route::get('kategory/create', [KategoryController::class, 'create'])->name('kategory.create');
    Route::post('kategory', [KategoryController::class, 'store'])->name('kategory.store');
    Route::delete('kategory/{id}', [KategoryController::class, 'destroy'])->name('kategory.destroy');
    Route::get('kategory/{id}/edit', [KategoryController::class, 'edit'])->name('kategory.edit');
    Route::put('kategory/{id}', [KategoryController::class, 'update'])->name('kategory.update');
    // data user
    // Route::get('usermenu', function () {
    //     return view('usermenu.edit');
    // Add the missing index route at the top
    // Use resource routes when possible
    // Route::resource('usermenu', UserMenuController::class);

    // // Or individual routes with consistent naming
    Route::get('usermenu', [UserMenuController::class, 'index'])->name('usermenu.index');
    Route::get('usermenu/create', [UserMenuController::class, 'create'])->name('usermenu.create');
    Route::post('usermenu', [UserMenuController::class, 'store'])->name('usermenu.store');
    Route::get('usermenu/{user}/edit', [UserMenuController::class, 'edit'])->name('usermenu.edit');
    Route::put('usermenu/{user}', [UserMenuController::class, 'update'])->name('usermenu.update');
    Route::delete('usermenu/{user}', [UserMenuController::class, 'destroy'])->name('usermenu.destroy');


    // data pengumuman
    Route::get('pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('pengumuman/create', [PengumumanController::class, 'create'])->name('pengumuman.create');
    Route::post('pengumuman', [PengumumanController::class, 'store'])->name('pengumuman.store');
    Route::get('pengumuman/{id_pengumuman}/edit', [PengumumanController::class, 'edit'])->name('pengumuman.edit');
    Route::put('pengumuman/{id_pengumuman}', [PengumumanController::class, 'update'])->name('pengumuman.update');
    Route::delete('/pengumuman/{id_pengumuman}', [PengumumanController::class, 'destroy'])->name('pengumuman.destroy');

    // data pemasukkan
    Route::get('pemasukkan', [PemasukkanController::class, 'index'])->name('pemasukkan.index');
    Route::get('pemasukkan/create', [PemasukkanController::class, 'create'])->name('pemasukkan.create');
    Route::post('pemasukkan', [PemasukkanController::class, 'store'])->name('pemasukkan.store');
    Route::get('pemasukkan/{id_pemasukkan}/edit', [PemasukkanController::class, 'edit'])->name('pemasukkan.edit');
    Route::put('pemasukkan/{id_pemasukkan}', [PemasukkanController::class, 'update'])->name('pemasukkan.update');
    Route::delete('/pemasukkan/{id_pemasukkan}', [PemasukkanController::class, 'destroy'])->name('pemasukkan.destroy');

    // data pengeluaran
    Route::get('pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::get('pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('pengeluaran/{id_pengeluaran}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('pengeluaran/{id_pengeluaran}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{id_pengeluaran}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');

    //data laporan
    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/print', [LaporanController::class, 'print'])->name('laporan.print');
    Route::get('/laporan/pemasukkan', [LaporanController::class, 'pemasukkan'])->name('laporan.pemasukkan');
    Route::get('/laporan/pengeluaran', [LaporanController::class, 'pengeluaran'])->name('laporan.pengeluaran');

    //home
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    //panduan
    Route::get('panduan', [PanduanController::class, 'index'])->name('panduan');

    //developer
    Route::get('/developers', [DeveloperController::class, 'index'])->name('developers');
});


require __DIR__ . '/auth.php';
