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

//-----------------------------------------------------
// Team Member Routes
//-----------------------------------------------------

// List all team members.
Route::get('/team-members', [\App\Http\Controllers\TeamMemberController::class, 'index'])->name('team-members.index');

// Team member detail page.
Route::get('/team-members/{teamMember}', [\App\Http\Controllers\TeamMemberController::class, 'show'])->name('team-members.show');

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
