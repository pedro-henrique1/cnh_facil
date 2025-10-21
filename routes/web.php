<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\pratical\PracticalTestController;
use App\Http\Controllers\theorical\TheoreticalTestController;
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

Route::put('/update', [AuthController::class, 'update'])->name('account.update');


Route::middleware(['auth'])->group(function () {
    // ========================================
    // TESTE TEÓRICO
    // ========================================
    Route::prefix('theoretical')->name('theoretical.')->group(function () {
        Route::post('generate', [TheoreticalTestController::class, 'generate'])
            ->name('simulation.generate');

        Route::get('question/{questionNumber}', [TheoreticalTestController::class, 'showQuestion'])
            ->name('show');
        Route::get('finish', [TheoreticalTestController::class, 'finish'])
            ->name('simulated.finish');
    });
    Route::post('question/{questionNumber}/submit', [TheoreticalTestController::class, 'submitAnswer'])
        ->name('simulated.submit');


    // ========================================
    // TESTE PRÁTICO
    // ========================================
    Route::prefix('practical')->name('practical.')->group(function () {
        // Rota para INICIAR/GERAR o simulado
        Route::post('generate', [PracticalTestController::class, 'generate'])
            ->name('simulation.generate');

        Route::get('question/{questionNumber}', [PracticalTestController::class, 'showQuestion'])
            ->name('show');

        Route::post('question/{questionNumber}/submit', [PracticalTestController::class, 'submitAnswer'])
            ->name('submit');

        Route::get('finish', [PracticalTestController::class, 'finish'])
            ->name('finish');
    });

    Route::get('/theoretical/information', function () {
        return view('theoretical_test.theoreticalTestInformation');
    })->name('theoretical.information');

    Route::get('/theoretical/questions', function () {
        return view('theoretical_test.theoreticalTestQuestions');
    })->name('theoretical.questions');

    Route::get('/theoretical/simulation', function () {
        return view('theoretical_test.simulationTheoreticalTest');
    })->name('theoretical.simulation');

    /**
     * rotas referentes a geração de testes praticos e telas pra essa seção
     */

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
