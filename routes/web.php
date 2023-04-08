<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Spatie\TranslationLoader\LanguageLine;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('import-translations', function () {
    $locales = ['en', 'es'];

    $enTranslations = trans('validation');
    app()->setLocale('es');
    $esTranslations = trans('validation');
    app()->setLocale('en');

    $translationsMap = [];

    foreach ($enTranslations as $key => $value) {
        if (is_string($value)) {
            $translationsMap[] = [
                'group' => 'validation',
                'key' => $key,
                'text' => ['en' => $value, 'es' => $esTranslations[$key]],
            ];
        } else {
            foreach ($value as $subKey => $subValue) {
                $translationsMap[] = [
                    'group' => 'validation',
                    'key' => $key . '.' . $subKey,
                    'text' => ['en' => $subValue, 'es' => $esTranslations[$key][$subKey] ?? $subValue],
                ];
            }
        }
    }

    foreach ($translationsMap as $translation) {
        LanguageLine::create($translation);
    }

    dd($enTranslations, $esTranslations);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
