<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationRequestController;
use App\Http\Controllers\ObjectionController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/galeri', [\App\Http\Controllers\PageController::class, 'galeri'])->name('galeri');

Route::get('/profil/ppid', [\App\Http\Controllers\PageController::class, 'profilPpid'])->name('profil.ppid');
Route::get('/profil/tugas-fungsi', [\App\Http\Controllers\PageController::class, 'tugasFungsi'])->name('profil.tugas_fungsi');
Route::get('/profil/visi-misi', [\App\Http\Controllers\PageController::class, 'visiMisi'])->name('profil.visi_misi');
Route::get('/profil/struktur', [\App\Http\Controllers\PageController::class, 'struktur'])->name('profil.struktur');
Route::get('/profil/sop', [\App\Http\Controllers\PageController::class, 'sop'])->name('profil.sop');
Route::get('/profil/maklumat', [\App\Http\Controllers\PageController::class, 'maklumat'])->name('profil.maklumat');
Route::get('/profil/dasar-hukum', [\App\Http\Controllers\PageController::class, 'dasarHukum'])->name('profil.dasar_hukum');
Route::get('/statistik', [\App\Http\Controllers\PageController::class, 'statistik'])->name('statistik');
Route::get('/laporan-ppid', [\App\Http\Controllers\PageController::class, 'laporanPpid'])->name('laporan.ppid');
Route::get('/laporan-survey', [\App\Http\Controllers\PageController::class, 'laporanSurvey'])->name('laporan.survey');
Route::get('/pilih-permohonan', [\App\Http\Controllers\PageController::class, 'pilihPermohonan'])->name('pilih_permohonan');
Route::get('/informasi/{kategori}/export', [\App\Http\Controllers\PageController::class, 'exportExcel'])->name('informasi.export');
Route::get('/informasi/{kategori}', [\App\Http\Controllers\PageController::class, 'informasi'])->name('informasi.kategori');
Route::get('/cek-status', [\App\Http\Controllers\PageController::class, 'cekStatus'])->name('cek_status');
Route::get('/standar-pelayanan/prosedur-pelayanan', [\App\Http\Controllers\PageController::class, 'prosedurPelayanan'])->name('standar.prosedur_pelayanan');
Route::get('/standar-pelayanan/prosedur-keberatan', [\App\Http\Controllers\PageController::class, 'prosedurKeberatan'])->name('standar.prosedur_keberatan');
Route::get('/standar-pelayanan/prosedur-sengketa', [\App\Http\Controllers\PageController::class, 'prosedurSengketa'])->name('standar.prosedur_sengketa');
Route::get('/standar-pelayanan/penanganan-sengketa', [\App\Http\Controllers\PageController::class, 'penangananSengketa'])->name('standar.penanganan_sengketa');
Route::get('/standar-pelayanan/kanal-layanan', [\App\Http\Controllers\PageController::class, 'kanalLayanan'])->name('standar.kanal_layanan');
Route::get('/standar-pelayanan/waktu-biaya', [\App\Http\Controllers\PageController::class, 'waktuBiaya'])->name('standar.waktu_biaya');

Route::get('/publikasi/kategori/{type}', [\App\Http\Controllers\PageController::class, 'indexPublication'])->name('publikasi.index');
Route::get('/publikasi/{slug}', [\App\Http\Controllers\PageController::class, 'showPublication'])->name('publikasi.show');
Route::get('/buku-tamu', [\App\Http\Controllers\GuestbookController::class, 'create'])->name('guestbook.create');
Route::post('/buku-tamu', [\App\Http\Controllers\GuestbookController::class, 'store'])->name('guestbook.store');

// Public comment submission (no auth required)
Route::post('/publikasi/{id}/komentar', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

Route::get('/survei-kepuasan', [\App\Http\Controllers\SurveyController::class, 'index'])->name('survey.index');
Route::post('/survei-kepuasan', [\App\Http\Controllers\SurveyController::class, 'store'])->name('survey.store');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->role !== 'user') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('requests.index');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/requests', [InformationRequestController::class, 'index'])->name('requests.index');
    Route::get('/requests/data', [InformationRequestController::class, 'historyData'])->name('requests.data');
    Route::get('/requests/create', [InformationRequestController::class, 'create'])->name('requests.create');
    Route::post('/requests', [InformationRequestController::class, 'store'])->name('requests.store');

    Route::get('/objections/create/{request_id}', [ObjectionController::class, 'create'])->name('objections.create');
    Route::post('/objections', [ObjectionController::class, 'store'])->name('objections.store');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.settings.update');
    Route::post('/admin/settings/logo', [AdminController::class, 'uploadLogo'])->name('admin.settings.logo');

    Route::get('/admin/pages', [AdminController::class, 'pages'])->name('admin.pages');
    Route::post('/admin/pages', [AdminController::class, 'updatePages'])->name('admin.pages.update');
    Route::post('/admin/editor/upload-image', [AdminController::class, 'uploadEditorImage'])->name('admin.editor.upload-image');
    Route::get('/admin/requests', [AdminController::class, 'requestsIndex'])->name('admin.requests.index');
    Route::get('/admin/requests/data', [AdminController::class, 'requestsData'])->name('admin.requests.data');
    Route::patch('/admin/requests/{id}', [AdminController::class, 'updateRequest'])->name('admin.requests.update');

    // Objections
    Route::get('/admin/objections', [AdminController::class, 'objectionsIndex'])->name('admin.objections.index');
    Route::get('/admin/objections/data', [AdminController::class, 'objectionsData'])->name('admin.objections.data');
    Route::patch('/admin/objections/{id}', [AdminController::class, 'updateObjection'])->name('admin.objections.update');

    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/data', [AdminController::class, 'usersData'])->name('admin.users.data');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    Route::get('/admin/guestbooks', [\App\Http\Controllers\GuestbookController::class, 'index'])->name('admin.guestbooks.index');
    Route::delete('/admin/guestbooks/{id}', [\App\Http\Controllers\GuestbookController::class, 'destroy'])->name('admin.guestbooks.destroy');

    // Laporan
    Route::get('/admin/laporan', [\App\Http\Controllers\ReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/admin/laporan/generate', [\App\Http\Controllers\ReportController::class, 'generate'])->name('admin.reports.generate');
    Route::delete('/admin/users/{id}', [AdminController::class, 'userDestroy'])->name('admin.users.destroy');

    Route::get('/admin/public-info', [AdminController::class, 'publicInfoIndex'])->name('admin.public-info.index');
    Route::post('/admin/public-info', [AdminController::class, 'storePublicInfo'])->name('admin.public-info.store');
    Route::put('/admin/public-info/{id}', [AdminController::class, 'updatePublicInfo'])->name('admin.public-info.update');
    Route::delete('/admin/public-info/{id}', [AdminController::class, 'destroyPublicInfo'])->name('admin.public-info.destroy');

    Route::post('/admin/public-info/upload-image', [AdminController::class, 'uploadImage'])->name('admin.public-info.upload-image');

    // Information Groups
    Route::get('/admin/information-groups', [\App\Http\Controllers\InformationGroupController::class, 'index'])->name('admin.information-groups.index');
    Route::post('/admin/information-groups', [\App\Http\Controllers\InformationGroupController::class, 'store'])->name('admin.information-groups.store');
    Route::put('/admin/information-groups/{group}', [\App\Http\Controllers\InformationGroupController::class, 'update'])->name('admin.information-groups.update');
    Route::delete('/admin/information-groups/{group}', [\App\Http\Controllers\InformationGroupController::class, 'destroy'])->name('admin.information-groups.destroy');

    Route::get('/admin/publications', [\App\Http\Controllers\PublicationController::class, 'index'])->name('admin.publications.index');
    Route::get('/admin/publications/data', [\App\Http\Controllers\PublicationController::class, 'data'])->name('admin.publications.data');
    Route::get('/admin/publications/create', [\App\Http\Controllers\PublicationController::class, 'create'])->name('admin.publications.create');
    Route::post('/admin/publications', [\App\Http\Controllers\PublicationController::class, 'store'])->name('admin.publications.store');
    Route::get('/admin/publications/{id}/edit', [\App\Http\Controllers\PublicationController::class, 'edit'])->name('admin.publications.edit');
    Route::put('/admin/publications/{id}', [\App\Http\Controllers\PublicationController::class, 'update'])->name('admin.publications.update');
    Route::delete('/admin/publications/{id}', [\App\Http\Controllers\PublicationController::class, 'destroy'])->name('admin.publications.destroy');

    // Survey Questions
    Route::get('/admin/survey', [\App\Http\Controllers\SurveyQuestionController::class, 'index'])->name('admin.survey.index');
    Route::get('/admin/survey/data', [\App\Http\Controllers\SurveyQuestionController::class, 'data'])->name('admin.survey.data');
    Route::post('/admin/survey', [\App\Http\Controllers\SurveyQuestionController::class, 'store'])->name('admin.survey.store');
    Route::get('/admin/survey/{id}/edit', [\App\Http\Controllers\SurveyQuestionController::class, 'edit'])->name('admin.survey.edit');
    Route::put('/admin/survey/{id}', [\App\Http\Controllers\SurveyQuestionController::class, 'update'])->name('admin.survey.update');
    Route::delete('/admin/survey/{id}', [\App\Http\Controllers\SurveyQuestionController::class, 'destroy'])->name('admin.survey.destroy');

    // Admin Survey Results
    Route::get('/admin/survey-results', [\App\Http\Controllers\Admin\SurveyResultController::class, 'index'])->name('admin.survey.results');
    Route::get('/admin/survey-results/data', [\App\Http\Controllers\Admin\SurveyResultController::class, 'data'])->name('admin.survey.results.data');
    Route::get('/admin/survey-results/{id}', [\App\Http\Controllers\Admin\SurveyResultController::class, 'show'])->name('admin.survey.results.show');

    // Admin Comment Moderation
    Route::get('/admin/komentar', [\App\Http\Controllers\CommentController::class, 'adminIndex'])->name('admin.comments.index');
    Route::patch('/admin/komentar/{id}/approve', [\App\Http\Controllers\CommentController::class, 'approve'])->name('admin.comments.approve');
    Route::delete('/admin/komentar/{id}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('admin.comments.destroy');

    // Home Content (Landing Page Dynamic Data)
    Route::get('/admin/home-content', [\App\Http\Controllers\Admin\HomeContentController::class, 'index'])->name('admin.home_content.index');
    Route::post('/admin/home-content/link', [\App\Http\Controllers\Admin\HomeContentController::class, 'storeLink'])->name('admin.home_content.store_link');
    Route::put('/admin/home-content/link/{link}', [\App\Http\Controllers\Admin\HomeContentController::class, 'updateLink'])->name('admin.home_content.update_link');
    Route::delete('/admin/home-content/link/{link}', [\App\Http\Controllers\Admin\HomeContentController::class, 'destroyLink'])->name('admin.home_content.destroy_link');
    Route::post('/admin/home-content/video', [\App\Http\Controllers\Admin\HomeContentController::class, 'storeVideo'])->name('admin.home_content.store_video');
    Route::put('/admin/home-content/video/{video}', [\App\Http\Controllers\Admin\HomeContentController::class, 'updateVideo'])->name('admin.home_content.update_video');
    Route::delete('/admin/home-content/video/{video}', [\App\Http\Controllers\Admin\HomeContentController::class, 'destroyVideo'])->name('admin.home_content.destroy_video');
});

require __DIR__ . '/auth.php';
