<?php

use App\Livewire\Settings\CategoriesComponent;
use App\Livewire\TemplateExpensesComponent;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::view('Panel', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('Configuracion', 'settings/profile');

    Volt::route('Configuracion/Perfil', 'settings.profile')->name('settings.profile');
    Volt::route('Configuracion/Contrasena', 'settings.password')->name('settings.password');
    // Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('Gastos', TemplateExpensesComponent::class)->name('expenses');
    Route::get('Categorias', CategoriesComponent::class)->name('settings.categories');
});

require __DIR__.'/auth.php';
