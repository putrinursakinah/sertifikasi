<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// ======= FRONTEND ======= \\

Route::get('/', 'Frontend\IndexController@index');

///// MENU \\\\\
//// PROFILE SEKOLAH \\\\
Route::get('profile-sekolah', [App\Http\Controllers\Frontend\IndexController::class, 'profileSekolah'])->name('profile.sekolah');

//// VISI dan MISI
Route::get('visi-dan-misi', [App\Http\Controllers\Frontend\IndexController::class, 'visimisi'])->name('visimisi.sekolah');

//// PROGRAM STUDI \\\\
Route::get('program/{slug}', [App\Http\Controllers\Frontend\MenuController::class, 'programStudi']);
//// PROGRAM STUDI \\\\
Route::get('kegiatan/{slug}', [App\Http\Controllers\Frontend\MenuController::class, 'kegiatan']);

/// BERITA \\\
Route::get('berita', [App\Http\Controllers\Frontend\IndexController::class, 'berita'])->name('berita');
Route::get('berita/{slug}', [App\Http\Controllers\Frontend\IndexController::class, 'detailBerita'])->name('detail.berita');

/// EVENT \\\
Route::get('event/{slug}', [App\Http\Controllers\Frontend\IndexController::class, 'detailEvent'])->name('detail.event');
Route::get('event', [App\Http\Controllers\Frontend\IndexController::class, 'events'])->name('event');

Auth::routes(['register' => false]);


// ======= BACKEND ======= \\
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //ALUMNI
    Route::prefix('alumnis')->group(function () {
        Route::get('/view', [App\Http\Controllers\AlumniController::class, 'index'])->name('alumni.view');
        Route::get('/add', [App\Http\Controllers\AlumniController::class, 'create'])->name('alumni.add');
        Route::post('/store', [App\Http\Controllers\AlumniController::class, 'store'])->name('alumni.store');
        Route::get('/edit/{id}', [App\Http\Controllers\AlumniController::class, 'edit'])->name('alumni.edit');
        Route::post('/update/{id}', [App\Http\Controllers\AlumniController::class, 'update'])->name('alumni.update');
        Route::get('/delete/{id}', [App\Http\Controllers\AlumniController::class, 'destroy'])->name('alumni.delete');
    });

    //GALERI
    Route::prefix('galeris')->group(function () {
        Route::get('/view', [App\Http\Controllers\GaleriController::class, 'index'])->name('galeri.view');
        Route::get('/add', [App\Http\Controllers\GaleriController::class, 'create'])->name('galeri.add');
        Route::post('/store', [App\Http\Controllers\GaleriController::class, 'store'])->name('galeri.store');
        Route::get('/edit/{id}', [App\Http\Controllers\GaleriController::class, 'edit'])->name('galeri.edit');
        Route::post('/update/{id}', [App\Http\Controllers\GaleriController::class, 'update'])->name('galeri.update');
        Route::get('/delete/{id}', [App\Http\Controllers\GaleriController::class, 'destroy'])->name('galeri.delete');
    });
    // KERJASAMA
    Route::prefix('kerjasama')->group(function () {
        Route::get('/view', [App\Http\Controllers\KerjasamaController::class, 'index'])->name('kerjasama.view');
        Route::get('/add', [App\Http\Controllers\KerjasamaController::class, 'create'])->name('kerjasama.create');
        Route::post('/store', [App\Http\Controllers\KerjasamaController::class, 'store'])->name('kerjasama.store');
        Route::get('/edit/{id}', [App\Http\Controllers\KerjasamaController::class, 'edit'])->name('kerjasama.edit');
        Route::post('/update/{id}', [App\Http\Controllers\KerjasamaController::class, 'update'])->name('kerjasama.update');
        Route::delete('/kerjasama/{id}', [App\Http\Controllers\KerjasamaController::class, 'destroy'])->name('kerjasama.destroy');
    });



    // Sambutan
    Route::prefix('sambutan')->group(function () {
        Route::get('/view', [App\Http\Controllers\SambutanController::class, 'index'])->name('sambutan.view');
        Route::get('/add', [App\Http\Controllers\SambutanController::class, 'create'])->name('sambutan.add');
        Route::post('/store', [App\Http\Controllers\SambutanController::class, 'store'])->name('sambutan.store');
        Route::get('/edit/{id}', [App\Http\Controllers\SambutanController::class, 'edit'])->name('sambutan.edit');
        Route::post('/update/{id}', [App\Http\Controllers\SambutanController::class, 'update'])->name('sambutan.update'); // Gunakan POST
        Route::get('/delete/{id}', [App\Http\Controllers\SambutanController::class, 'destroy'])->name('sambutan.delete');
    });






    /// PROFILE \\\
    Route::resource('profile-settings', Backend\ProfileController::class);
    /// SETTINGS \\\
    Route::prefix('settings')->group(function () {
        // BANK
        Route::get('/', [App\Http\Controllers\Backend\SettingController::class, 'index'])->name('settings');
        // TAMBAH BANK
        Route::post('add-bank', [App\Http\Controllers\Backend\SettingController::class, 'addBank'])->name('settings.add.bank');
        // NOTIFICATIONS
        Route::put('notifications/{id}', [SettingController::class, 'notifications']);
    });


    /// CHANGE PASSWORD
    Route::put('profile-settings/change-password/{id}', [App\Http\Controllers\Backend\ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::prefix('/')->middleware('role:Admin')->group(function () {
        ///// WEBSITE \\\\\
        Route::resources([
            /// PROFILE SEKOLAH \\
            'backend-profile-sekolah'   => Backend\Website\ProfilSekolahController::class,
            /// VISI & MISI \\\
            'backend-visimisi'  => Backend\Website\VisidanMisiController::class,
            //// PROGRAM STUDI \\\\
            'program-studi' =>  Backend\Website\ProgramController::class,
            /// KEGIATAN \\\
            'backend-kegiatan' => Backend\Website\KegiatanController::class,
            /// IMAGE SLIDER \\\
            'backend-imageslider' => Backend\Website\ImageSliderController::class,
            /// ABOUT \\\
            'backend-about' => Backend\Website\AboutController::class,
            /// VIDEO \\\
            'backend-video' => Backend\Website\VideoController::class,
            /// KATEGORI BERITA \\\
            'backend-kategori-berita'   => Backend\Website\KategoriBeritaController::class,
            /// BERITA \\\
            'backend-berita' => Backend\Website\BeritaController::class,
            /// EVENT \\\
            'backend-event' => Backend\Website\EventsController::class,
            /// FOOTER \\\
            'backend-footer'    => Backend\Website\FooterController::class,
        ]);

        ///// PENGGUNA \\\\\
        Route::resources([
            /// PENGAJAR \\\
            'backend-pengguna-pengajar' => Backend\Pengguna\PengajarController::class,
            /// STAF \\\
            'backend-pengguna-staf' => Backend\Pengguna\StafController::class,
            /// MURID \\\
            'backend-pengguna-murid' => Backend\Pengguna\MuridController::class,
            /// PPDB \\\
            'backend-pengguna-ppdb' => Backend\Pengguna\PPDBController::class,
            /// PERPUSTAKAAN \\\
            'backend-pengguna-perpus' => Backend\Pengguna\PerpusController::class,
            /// BENDAHARA \\\
            'backend-pengguna-bendahara'  => Backend\Pengguna\BendaharaController::class
        ]);
    });
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::prefix('alumnis')->group(function(){
//         Route::get('/view', [AlumniController::class, 'index'])->name('alumni.view');
//     });
// });
