<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard.master');
})->name('admin.dashboard');

//JADWAL MENGAJAR//
//jadwalmengajarindex//
Route::get('/admin/jadwalmengajar/index', function () {
    return view('admin.jadwalmengajar.index');
})->name('admin.jadwalmengajar.index');
//jadwalmengajartambah//
Route::get('/admin/jadwalmengajar/tambah', function () {
    return view('admin.jadwalmengajar.tambah');
})->name('admin.jadwalmengajar.tambah');
//jadwalmengajaredit//
// Route::get('/admin/jadwalmengajar/edit/{id}', function ($id) {
//     return view('admin.jadwalmengajar.edit', ['id' => $id]);
// })->name('admin.jadwalmengajar.edit');

//DATA GURU//
//dataguruindex//
Route::get('/admin/dataguru/index', function () {
    return view('admin.dataguru.index');
})->name('admin.dataguru.index');
//datagurutambah//
Route::get('/admin/dataguru/tambah', function () {
    return view('admin.dataguru.tambah');
})->name('admin.dataguru.tambah');

//DATA SANTRI//
//datasantriindex//
Route::get('/admin/datasantri/index', function () {
    return view('admin.datasantri.index');
})->name('admin.datasantri.index');
//datasantritambah//
Route::get('/admin/datasantri/tambah', function () {
    return view('admin.datasantri.tambah');
})->name('admin.datasantri.tambah');

//KELOLA PENGGUNA//
//kelolapenggunaindex//
Route::get('/admin/kelolapengguna/index', function () {
    return view('admin.kelolapengguna.index');
})->name('admin.kelolapengguna.index');
Route::get('/admin/kelolapengguna/tambah', function () {
    return view('admin.kelolapengguna.tambah');
})->name('admin.kelolapengguna.tambah');

//PERIODE//
//periodeindex//
Route::get('/admin/periode/index', function () {
    return view('admin.periode.index');
})->name('admin.periode.index');

//KATEGORI PENILAIAN//
//kategoripenilaianindex//
Route::get('/admin/kategoripenilaian/index', function () {
    return view('admin.kategoripenilaian.index');
})->name('admin.kategoripenilaian.index');

//KEHADIRAN ADMIN//
//kehadiranadminindex//
Route::get('/admin/kehadiranA/index', function () {
    return view('admin.kehadiranA.index');
})->name('admin.kehadiranA.index');
Route::get('/admin/kehadiranA/detail', function () {
    return view('admin.kehadiranA.detail');
})->name('admin.kehadiranA.detail');

//HAFALAN SANTRI//
//hafalanadminindex//
Route::get('/admin/hafalanadmin/index', function () {
    return view('admin.hafalanadmin.index');
})->name('admin.hafalanadmin.index');
Route::get('/admin/hafalanadmin/detail', function () {
    return view('admin.hafalanadmin.detail');
})->name('admin.hafalanadmin.detail');

//KINERJA GURU//
//kinerjaguruindex//
Route::get('/admin/kinerjaguru/index', function () {
    return view('admin.kinerjaguru.index');
})->name('admin.kinerjaguru.index');