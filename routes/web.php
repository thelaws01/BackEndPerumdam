<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/undangan', function(){
    return view('undangan');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/operator', 'AdminController');
Route::resource('/polsek', 'PolseController');
Route::resource('/agenda', 'AgendaController');
Route::resource('/berita', 'BeritaController');
Route::resource('/member', 'MemberController');
Route::resource('/kategori', 'KategoriController');
Route::resource('/pengaduan', 'PengaduanController');
Route::get('/pengaduan-buble', 'PengaduanController@indexBubble')->name('index.buble');
Route::get('pengaduan-aduan/selesai', 'PengaduanController@selesai')->name('pengaduan.selsai');
