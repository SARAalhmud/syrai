<?php

use App\Http\Controllers\BeginnerController;
use App\Http\Controllers\companycontroller;
use App\Http\Controllers\Controller;
use App\Http\Controllers\forumController;
use App\Http\Controllers\jopController;
use App\Http\Controllers\masejController;
use App\Http\Controllers\PesonalFiles;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileexpertController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\studentController;
use Illuminate\Support\Facades\Route;

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
Route::get( '/profile/{id}', [RatingController::class, 'show']);

Route::get('/', [Controller::class, 'dashboard'])->name('welcome');
Route::get('/companyprofile/{id}', [Controller::class, 'showByCompany'])->name('showByCompany.show');
Route::get('/companyprofile/{id}', [companycontroller::class, 'showByCompany'])->name('companyprofile.show');
Route::post('/companyprofile', [companycontroller::class, 'store'])->name('companycontroller.store');
Route::get('/expert/{id}', [Controller::class, 'showByexpert'])->name('experts.show');

Route::post('/profile/{id}', [masejController::class, 'send'])->name('send.message');

Route::middleware(['auth', 'expert'])->group(function(){
  //   Route::get('/dashboard', [ProfileexpertController::class, 'index'])->name('dashboard');
   Route::post('/edite',[ProfileexpertController::class,'update'])->name('expert.update');
Route::get('/dashboard/{id}',[ProfileexpertController::class,'show'])->name('profile');
Route::get('/expertsjop/{experts_id}', [jopController::class, 'showExpertJobs'])->name('expertsjop');

Route::get('/edite', [ProfileexpertController::class, 'edit'])->name('edite');
Route::patch('/jobs/{experts_id}/toggle-status', [jopController::class, 'toggleStatus'])->name('jobs.toggleStatus');


});
Route::middleware(['auth', 'beginner'])->group(function(){
 Route::get('/beginner/profile/{id}', [BeginnerController::class, 'show'])->name('beginner');
Route::get('/editebeginner', [BeginnerController::class, 'edit'])->name('editeB');
 Route::post('/editebeginner',[BeginnerController::class,'update'])->name('beginner.update');

});
Route::middleware(['auth', 'student'])->group(function(){
 Route::get('/student/profile/{id}', [studentController::class, 'show'])->name('student');
Route::get('/editestudent', [studentController::class, 'edit'])->name('edites');
 Route::post('/editestudent',[studentController::class,'update'])->name('student.update');

});
Route::middleware(['auth', 'company'])->group(function(){
 Route::get('/company/profile/{id}', [companycontroller::class, 'show'])->name('company');
Route::get('/editecompan', [companycontroller::class, 'edit'])->name('editecompan');
 Route::post('/editebcompan',[companycontroller::class,'update'])->name('compan.update');
Route::patch('/jobs/{companies_id}/compan-status', [jopController::class, 'toggleCompaany'])->name('jobs.toggleCompaany');

Route::get('/compansjop/{companies_id}', [jopController::class, 'showcompanies'])->name('companytsjop');

});

Route::post('/jop', [jopController::class, 'store'])->name('jop');
Route::get('/jop', [jopController::class, 'index'])->name('jop');
// Route::get('/profilecompan/{id}', [companycontroller::class, 'showcompan'])->name('showcompan.show');
 Route::post('/forum', [forumController::class, 'store'])->name('forum');
Route::get('/forum', [forumController::class, 'index'])->name('forum');
Route::post('/profile', [PesonalFiles::class, 'store'])->name('profile.store');
Route::get('/profile/{id}', [PesonalFiles::class, 'show'])->name('profile.show');
Route::get('PersonalFiles',[PesonalFiles::class,'index'])->name('PersonalFiles');
Route::get('companies',[companycontroller::class,'index'])->name('companies');
Route::middleware(['auth'])->group(function () {
    Route::get('/messages/inbox', [masejController::class, 'inbox'])->name('messages.inbox');


});
require __DIR__.'/auth.php';
