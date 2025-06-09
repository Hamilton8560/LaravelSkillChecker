<?php

use App\Livewire\Counter;
use App\Livewire\CreateCategory;
use App\Livewire\CreateMethod;
use App\Livewire\CreateObjectives;
use App\Livewire\CreateTraining;
use App\Livewire\EditCategory;
use App\Livewire\EditMethod;
use App\Livewire\EditObjectives;
use App\Livewire\EditTraining;
use App\Livewire\ListCategories;
use App\Livewire\ListMethods;
use App\Livewire\ListObjectives;
use App\Livewire\ListTrainings;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth'])->group(function () {
    // 1. Show a list of all trainings for the current user
    Route::get('/trainings', ListTrainings::class)
        ->name('trainings.index');

    // 2. Show the “create new training” form
    Route::get('/trainings/create', CreateTraining::class)
        ->name('trainings.create');

    // 3. Show the “edit existing training” form, via route‐model binding
    Route::get('/trainings/{training}/edit', EditTraining::class)
        ->name('trainings.edit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/objectives', ListObjectives::class)
        ->name('objectives.index');
    Route::get('/objectives/create', CreateObjectives::class)
        ->name('objectives.create');
    Route::get('/objectives/{objective}/edit', EditObjectives::class)
        ->name('objectives.edit');
});

Route::get('/counter', Counter::class);

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // ===Training Categories===
    Route::get('/categories', ListCategories::class)
        ->name('categories.index');
    Route::get('/categories/create', CreateCategory::class)
        ->name('categories.create');
    Route::get('/categories/{category}/edit', EditCategory::class)
        ->name('categories.edit');

    // ===Methods====\
    Route::get('/methods', ListMethods::class)
        ->name('methods.index');
    Route::get('methods/create', CreateMethod::class)
        ->name('methods.create');
    Route::get('/methods/{method}/edit', EditMethod::class)
        ->name('methods.edit');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
