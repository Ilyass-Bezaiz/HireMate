<?php

use App\Livewire\AccessDenied;
use App\Livewire\JobOfferNewPost;
use App\Livewire\JobSeekerPost;
use App\Livewire\JobSeekerNewPost;
use App\Livewire\Community;
use App\Livewire\UserProfile;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('home-page');
    })->name('home');
    Route::get('/jobseeker-posts', JobSeekerNewPost::class)->name('jobseekerposts.index')->middleware('role:job_seeker');
    //New route for the community page
    Route::get('/community', Community::class)->name('community.index')->middleware('role:job_seeker');

    Route::get('/joboffer-posts', JobOfferNewPost::class)->name('jobofferposts.index')->middleware('role:employer');
    Route::get('/profile/{userId}', UserProfile::class)->name('user.profile');
});


// Route::group(['middleware' => 'auth'],function(){
// });