<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RequestIzinController;
use Illuminate\Support\Facades\Route;


Route::get('/greeting', function () {
    return 'Hello World';
});

Route::get('/', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);

Route::get('/app', function () {
    return view('layouts.app');
});

Route::get('/tes', function () {
    return view('tes/daftar');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
});

// Route::get('kelas', [KelasController::class, 'list']);

Route::group(['middleware'=>'kaprodi'], function() {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/daftar', [AdminController::class, 'daftarlist']);
    Route::get('admin/add', [AdminController::class, 'add']);
    Route::post('admin/add', [AdminController::class, 'insert']);
    Route::get('admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/destroy/{id}', [AdminController::class, 'destroy']);
    Route::get('admin/dosen/daftar', [AdminController::class, 'kelaslist']);
    Route::get('admin/dosen/add', [DosenController::class, 'add_dosen']);
    Route::post('admin/dosen/add', [DosenController::class, 'insert']);
    Route::get('admin/dosen/edit/{id}', [DosenController::class, 'edit']);
    Route::post('admin/dosen/edit/{id}', [DosenController::class, 'update']);
    Route::get('admin/dosen/edit/{id}', [AdminController::class, 'editDosen'])->name('dosen.edit');
    Route::put('admin/dosen/update/{id}', [AdminController::class, 'updateDosen'])->name('dosen.update');
    Route::get('admin/dosen/destroy/{id}', [DosenController::class, 'destroy']);
    Route::get('admin/mahasiswa/daftar', [MahasiswaController::class, 'daftarlist']);
    Route::get('admin/mahasiswa/add', [AdminController::class, 'createMahasiswa'])->name('kaprodi.mahasiswa.create');
    Route::post('admin/mahasiswa/store', [AdminController::class, 'storeMahasiswa'])->name('kaprodi.mahasiswa.store');
    Route::get('admin/mahasiswa/edit/{id}', [AdminController::class, 'editMahasiswa'])->name('mahasiswa.edit.admin');
    Route::put('/admin/mahasiswa/update/{id}', [AdminController::class, 'updateMahasiswa'])->name('mahasiswa.update.admin');
    Route::get('admin/mahasiswa/destroy/{id}', [MahasiswaController::class, 'destroy']);
    Route::get('admin/add_kelas', [KelasController::class, 'add_kelas']);
    Route::post('admin/add_kelas', [KelasController::class, 'insert']);
    Route::get('kelas/destroy/{id}', [KelasController::class, 'destroy']);
    Route::get('admin/editkelas/{id}', [KelasController::class, 'edit']);
    Route::post('admin/editkelas/{id}', [KelasController::class, 'update']);
});

Route::get('kelas', [KelasController::class, 'list']);

Route::group(['middleware'=>'dosen'], function() {
    Route::get('dosen/dashboard', [DashboardController::class, 'dashboard']);
    // Route::get('dosen/daftar', [DosenController::class, 'daftarlist']);
    // Route::get('dosen/daftar', [DosenController::class, 'kelaslist']);
    Route::get('dosen/add', [DosenController::class, 'add_dosen']);
    Route::get('/dosen/request', [DosenController::class, 'showRequests'])->name('dosen.request');
    Route::post('dosen/request/approve/{id}', [DosenController::class, 'approveRequest'])->name('dosen.approve');
    Route::post('dosen/request/denied/{id}', [DosenController::class, 'deniedRequest'])->name('dosen.denied');
    Route::get('mahasiswa/daftarmhs', [DosenController::class, 'showMahasiswa'])->name('dosen.mahasiswa');
    Route::get('mahasiswa/create', [DosenController::class, 'createMahasiswa'])->name('mahasiswa.create');
    Route::get('mahasiswa/store', [DosenController::class, 'storeMahasiswa'])->name('mahasiswa.store');
    Route::get('dosen/mahasiswa/edit/{id}', [DosenController::class, 'editMahasiswa'])->name('mahasiswa.edit');
    Route::put('/dosen/mahasiswa/update/{id}', [DosenController::class, 'updateMahasiswa'])->name('mahasiswa.update.dosen');
    Route::get('mahasiswa/destroy/{id}', [DosenController::class, 'destroyMhs']);
});

Route::group(['middleware'=>'mahasiswa'], function() {
    Route::get('mahasiswa/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('mahasiswa/show/{id}', [MahasiswaController::class, 'showMahasiswaData']);
    Route::post('/mahasiswa/request-edit', [MahasiswaController::class, 'requestEdit'])->name('request.edit');
    Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'updateMahasiswaData'])->middleware('check-edit-access')->name('mahasiswa.update');
    Route::get('mahasiswa/edit/{id}', [MahasiswaController::class, 'requestEdit']);
    Route::post('mahasiswa/edit/{id}', [MahasiswaController::class, 'showMahasiswaData']);
});

