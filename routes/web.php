<?php

use App\Http\Controllers\BatuController;
use App\Http\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MyCourseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\CourseMemberController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardCourseController;
use App\Http\Controllers\DashboardMateriController;
use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardTugasController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DparkController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\IndexUserController;
use App\Http\Controllers\LegalitasController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\SinghasariController;
use App\Http\Controllers\VideoController;
use App\Models\Singhasari;

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


Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/user', [UserController::class, 'index']);
Route::get('/index/filter', [IndexController::class, 'filter'])->name('index.filter');

Route::get('/migration', function () {
    Artisan::call('migrate:fresh');
    Artisan::call('db:seed');
    Artisan::call('storage:link');
});

Route::get('/home', [IndexUserController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('checkRole');

// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/verify', [LoginController::class, 'verify']);

Route::get('/block', [LoginController::class, 'block']);

Route::get('/masuk_in', [LegalitasController::class, 'masuk_in']);

Route::get('/masuk_out', [LegalitasController::class, 'masuk_out']);

Route::get('/keluar_in', [LegalitasController::class, 'keluar_in']);

Route::get('/keluar_out', [LegalitasController::class, 'keluar_out']);

Route::get('/komplain_start', [FotoController::class, 'komplain_start']);

Route::get('/komplain_finish', [FotoController::class, 'komplain_finish']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


Route::resource('/admin/member', DashboardUserController::class)->middleware('checkRole:admin');
Route::resource('/admin/user', DashboardAdminController::class)->middleware('checkRole:admin');
Route::resource('/admin/petugas', PetugasController::class)->middleware('checkRole:admin');

Route::resource('/admin/kelas', DashboardCategoryController::class)->middleware('checkRole:admin');

Route::resource('/admin/course', DashboardCourseController::class)->middleware('checkRole:admin');
Route::resource('/admin/materi', DashboardMateriController::class)->middleware('checkRole:admin');
Route::resource('/admin/tugas', DashboardTugasController::class)->middleware('checkRole:admin');
Route::resource('/admin/data', DataController::class)->middleware('checkRole:admin');
Route::get('/data/{id}/ktp', [DataController::class, 'viewKtp'])->name('data.view_ktp');
Route::resource('/admin/promo', PromoController::class)->middleware('checkRole:admin');
Route::resource('/admin/stok-singhasari', SinghasariController::class)->middleware('checkRole:admin');
Route::get('/sold-singhasari', [SinghasariController::class, 'soldSinghasari']);

Route::get('/open-singhasari', [SinghasariController::class, 'openSinghasari']);

// Route::resource('/admin/foto', FotoController::class)->middleware('checkRole:admin');

Route::get('/komplain_start', [FotoController::class, 'komplain_start']);

Route::get('/komplain_finish', [FotoController::class, 'komplain_finish']);

Route::get('/admin/foto', [FotoController::class, 'index'])->name('foto.index');
Route::get('/admin/foto/filter', [FotoController::class, 'filter'])->name('foto.filter');
Route::resource('/admin/foto', FotoController::class)->except(['index', 'filter']);
Route::get('/data/search', [DataController::class, 'search'])->name('data.search');
Route::post('/delete-photo', [DataController::class, 'deletePhoto'])->name('delete.photo');




Route::post('/importexcel', [DataController::class, 'importExcel'])->name('import.excel');

Route::resource('/admin/legalitas', LegalitasController::class)->middleware('checkRole:admin');
Route::get('/get-kavlings', [FotoController::class, 'getKavlingsByLocation'])->name('get-kavlings');
// Route::get('/api/getKavlingsByLocation', [FotoController::class, 'getKavlingsByLocation']);
Route::get('/api/getFotosByLocation', 'FotoController@getFotosByLocation')->name('fotos.getByLocation');

Route::resource('/admin/stok-batu', BatuController::class)->middleware('checkRole:admin');
Route::get('/sold-batu', [BatuController::class, 'soldBatu']);
Route::get('/open-batu', [BatuController::class, 'openBatu']);

Route::resource('/admin/stok-dpark', DparkController::class)->middleware('checkRole:admin');
Route::get('/sold-dpark', [DparkController::class, 'soldDpark']);
Route::get('/open-dpark', [DparkController::class, 'openDpark']);


// INDEX
Route::get('/admin/video', [VideoController::class, 'index'])->name('video.index');

// FILTER (kalau nanti dibutuhkan)
Route::get('/admin/video/filter', [VideoController::class, 'filter'])->name('video.filter');

// RESOURCE (tanpa index & filter)
Route::resource('/admin/video', VideoController::class)->except(['index', 'filter']);

// AJAX GET KAVLING
Route::get('/get-kavlings-video', [VideoController::class, 'getKavlingsByLocation'])->name('video.get-kavlings');

// OPTIONAL: API GET VIDEO BY LOKASI (kalau kamu pakai juga kayak foto)
Route::get('/api/getVideosByLocation', [VideoController::class, 'getVideosByLocation'])->name('videos.getByLocation');



// Route::get('/materi/{id}', [DashboardMateriController::class, 'indexMateri']);

// Route::get('/course', [CourseController::class, 'index']);

// Route::get('/course/{id}', [courseController::class, 'show']);

// Route::resource('/transaksi', TransaksiController::class);

// Route::post('/bayar', [TransaksiController::class, 'bayar']);
// Route::get('/verifyTransaksi', [TransaksiController::class, 'verify']);

// Route::get('/courseMember', [CourseMemberController::class, 'index']);

// Route::get('/transaksiMember', [CourseMemberController::class, 'transaksi']);

// Route::get('/myCourse/{id}', [MyCourseController::class, 'show']);
// Route::get('/next/{id}', [MyCourseController::class, 'next']);
// Route::get('/reset/{id}', [MyCourseController::class, 'reset']);

// Route::get('/laporanTransaksi', [SertifikatController::class, '__invoke']);




