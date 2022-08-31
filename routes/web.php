<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
|
|
*/

Route::get('/', fn () => view('welcome'))->name('home');

//-----------------------------------------------------
// Team Member Routes
//-----------------------------------------------------

// List all team members.
Route::get('/team-members', [\App\Http\Controllers\TeamMemberController::class, 'index'])->name('team-members.index');

// Team member detail page.
Route::get('/team-members/{teamMember}', [\App\Http\Controllers\TeamMemberController::class, 'show'])->name('team-members.show');

//-----------------------------------------------------
// Project Routes
//-----------------------------------------------------

// Creation page for guests.
Route::get('/projects/create', [\App\Http\Controllers\ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects/create', [\App\Http\Controllers\ProjectController::class, 'store'])->name('projects.store');

// Project detail page.
Route::get('/projects/{project}', [\App\Http\Controllers\ProjectController::class, 'show'])->name('projects.show');

/*
|--------------------------------------------------------------------------
| Administration Routes
|--------------------------------------------------------------------------
|
|
|
*/

//-----------------------------------------------------
// Team Member Routes
//-----------------------------------------------------

// Creation
// ================================

Route::get(
    \App\Helpers::getAdministrationUrl('/team-members/create'),
    [\App\Http\Controllers\TeamMemberController::class, 'create']
)->name('administration.team-members.create');

Route::post(
    \App\Helpers::getAdministrationUrl('/team-members/create'),
    [\App\Http\Controllers\TeamMemberController::class, 'store']
)->name('administration.team-members.store');

// List
// ================================

Route::get(
    \App\Helpers::getAdministrationUrl('/team-members'),
    [\App\Http\Controllers\TeamMemberController::class, 'administrationIndex']
)->name('administration.team-members.index');

// Update
// ================================

Route::get(
    \App\Helpers::getAdministrationUrl('/team-members/{id}/edit'),
    [\App\Http\Controllers\TeamMemberController::class, 'edit']
)->name('administration.team-members.edit');

// Delete
// ================================

Route::delete(
    \App\Helpers::getAdministrationUrl('/team-member/{id}'),
    [\App\Http\Controllers\TeamMemberController::class, 'destroy']
)->name('administration.team-members.delete');

//-----------------------------------------------------
// Project Routes
//-----------------------------------------------------

// Creation
// ================================

Route::get(
    \App\Helpers::getAdministrationUrl('/projects/create'),
    [\App\Http\Controllers\ProjectController::class, 'administrationCreate']
)->name('administration.projects.create');

Route::post(
    \App\Helpers::getAdministrationUrl('/projects/create'),
    [\App\Http\Controllers\ProjectController::class, 'administrationStore']
)->name('administration.projects.store');

// List
// ================================

Route::get(
    \App\Helpers::getAdministrationUrl('/projects'),
    [\App\Http\Controllers\ProjectController::class, 'index']
)->name('administration.projects.index');

// Update
// ================================

Route::get(
    \App\Helpers::getAdministrationUrl('/projects/{id}/edit'),
    [\App\Http\Controllers\ProjectController::class, 'edit']
)->name('administration.projects.edit');

// Delete
// ================================

Route::delete(
    \App\Helpers::getAdministrationUrl('/project/{id}'),
    [\App\Http\Controllers\ProjectController::class, 'destroy']
)->name('administration.projects.delete');
