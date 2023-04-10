<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('berita', 'v1Controller@tampilBerita');
Route::get('berita/{id}', 'v1Controller@detailBerita');
Route::get('kategori', 'v1Controller@tampilKategori');
Route::get('agenda', 'v1Controller@tampilAgenda');
Route::post('member', 'v1Controller@register');
Route::post('aduan/{email?}', 'v1Controller@addAduan');
Route::get('sendiri/{email?}', 'v1Controller@aduanSendiri');
Route::get('hasil/sendiri/{id?}', 'v1Controller@detailAduanSendiri');
Route::get('tampilMember', 'v1Controller@tampilMember');
Route::get('tampilSlider', 'v1Controller@tampilSlider');
Route::get('tampilPengaduan', 'v1Controller@tampilPengaduan');
Route::get('tampilPengaduan/{id?}', 'v1Controller@upadatView');
Route::get('login/{email?}/{password?}/{fcm_id}', 'v1Controller@login');
Route::get('cek/{lat}/{lng}', 'v1Controller@haversine');
Route::get('akun/hapus/{username?}', 'v1Controller@deleteAkun');
Route::get('masuk/{email?}/{password?}', 'v1Controller@masuk');
Route::post('foto/{id}', 'v1Controller@updateFoto');
Route::get('akun/foto/{id}', 'v1Controller@ambilFoto');

Route::post('loginRiswan', 'v1Controller@loginRiswan');
Route::post('registerBaru', 'v1Controller@registerRiswan');
Route::post('updaeFotoProfil', 'v1Controller@updateProfRiswan');
Route::post('updaeStringProfil', 'v1Controller@updateStringProf');
Route::post('updateProfString', 'v1Controller@updateProfString');
Route::post('updatePasswordRiswan', 'v1Controller@updatePasswordRiswan');
Route::post('postPostingRiswan', 'v1Controller@addPengaduanRiswan');
Route::get('historyRiswan/{username?}', 'v1Controller@riswanHistory');

//riswan
Route::group([
    'middleware' => 'jwt.verify',
    'prefix' => 'iwang'
], function ($router) {
    Route::get('/agenda','v2Controller@tampilAgenda');
});



