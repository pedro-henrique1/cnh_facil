<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.homePage');
})->name('home');

Route::get('/about', function () {
    return view('home.aboutLawPage');
});


// Login
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::controller(DashboardController::class)->group(function () {
    Route::get('/minha-conta', 'showMyAccount')->name('home.minhaconta')->middleware('auth');
});

Route::middleware(['auth'])->group(function () {

//* rotas da parte da prova teorica
    Route::get('/theoretical/information', function () {
        return view('theoretical_test.theoreticalTestInformation');
    })->name('theoretical.information');

    Route::get('/theoretical/questions', function () {
        return view('theoretical_test.theoreticalTestQuestions');
    })->name('theoretical.questions');

    Route::get('/theoretical/simulation', function () {
        return view('theoretical_test.simulationTheoreticalTest');
    })->name('theoretical.simulation');


//* rotas da parte da prova pratica
    Route::get('/practical/information', function () {
        return view('practical_test.informationTestPractical');
    })->name('practical.information');

    Route::get('/practical/questions', function () {
        return view('practical_test.gameSimulatedTest');
    })->name('practical.questions');

    Route::get('/practical/simulation/vehicle', function () {
        return view('practical_test.gameVehiclePractical');
    })->name('practical.vehicle');

    Route::get('/practical/simulation/video', function () {
        return view('practical_test.videoTestPractical');
    })->name('practical.video');


    Route::get('/materials', function () {
        return view('home.materials');
    })->name('home.materials');

    Route::get('/about/project', function () {
        return view('home.aboutProject');
    })->name('home.aboutProject');
});
