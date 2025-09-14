<?php

use Illuminate\Support\Facades\Route;
use Laravel\WorkOS\Http\Middleware\ValidateSessionWithWorkOS;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth',
    ValidateSessionWithWorkOS::class,
])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    
    // Study Materials Routes
    Route::prefix('study-materials')->name('study-materials.')->group(function () {
        Route::get('/', 'App\Http\Controllers\StudyMaterialController@index')->name('index');
        Route::get('/create', 'App\Http\Controllers\StudyMaterialController@create')->name('create');
        Route::post('/', 'App\Http\Controllers\StudyMaterialController@store')->name('store');
        Route::get('/{studyMaterial}', 'App\Http\Controllers\StudyMaterialController@show')->name('show');
        Route::get('/{studyMaterial}/download', 'App\Http\Controllers\StudyMaterialController@download')->name('download');
        Route::post('/{studyMaterial}/rate', 'App\Http\Controllers\StudyMaterialController@rate')->name('rate');
    });
    
    // Tutors Routes
    Route::prefix('tutors')->name('tutors.')->group(function () {
        Route::get('/', 'App\Http\Controllers\TutorController@index')->name('index');
        Route::get('/create', 'App\Http\Controllers\TutorController@create')->name('create');
        Route::post('/', 'App\Http\Controllers\TutorController@store')->name('store');
        Route::get('/{tutor}', 'App\Http\Controllers\TutorController@show')->name('show');
        Route::get('/{tutor}/book', 'App\Http\Controllers\TutorController@book')->name('book');
        Route::post('/{tutor}/book', 'App\Http\Controllers\TutorController@storeBooking')->name('store-booking');
    });
    
    // Textbooks Routes
    Route::prefix('textbooks')->name('textbooks.')->group(function () {
        Route::get('/', 'App\Http\Controllers\TextbookController@index')->name('index');
        Route::get('/create', 'App\Http\Controllers\TextbookController@create')->name('create');
        Route::post('/', 'App\Http\Controllers\TextbookController@store')->name('store');
        Route::get('/{textbook}', 'App\Http\Controllers\TextbookController@show')->name('show');
        Route::get('/{textbook}/contact', 'App\Http\Controllers\TextbookController@contact')->name('contact');
    });
    
    // Events Routes
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/', 'App\Http\Controllers\CampusEventController@index')->name('index');
        Route::get('/create', 'App\Http\Controllers\CampusEventController@create')->name('create');
        Route::post('/', 'App\Http\Controllers\CampusEventController@store')->name('store');
        Route::get('/{event}', 'App\Http\Controllers\CampusEventController@show')->name('show');
        Route::get('/{event}/edit', 'App\Http\Controllers\CampusEventController@edit')->name('edit');
        Route::put('/{event}', 'App\Http\Controllers\CampusEventController@update')->name('update');
        Route::delete('/{event}', 'App\Http\Controllers\CampusEventController@destroy')->name('destroy');
        Route::post('/{event}/rsvp', 'App\Http\Controllers\CampusEventController@rsvp')->name('rsvp');
        Route::delete('/{event}/rsvp', 'App\Http\Controllers\CampusEventController@cancelRsvp')->name('cancel-rsvp');
    });
    
    // Forum Routes
    Route::prefix('forum')->name('forum.')->group(function () {
        Route::get('/', 'App\Http\Controllers\ForumPostController@index')->name('index');
        Route::get('/create', 'App\Http\Controllers\ForumPostController@create')->name('create');
        Route::post('/', 'App\Http\Controllers\ForumPostController@store')->name('store');
        Route::get('/{post}', 'App\Http\Controllers\ForumPostController@show')->name('show');
        Route::post('/{post}/reply', 'App\Http\Controllers\ForumPostController@reply')->name('reply');
        Route::post('/{post}/vote', 'App\Http\Controllers\ForumPostController@vote')->name('vote');
    });

    // Library Routes
    Route::prefix('library')->name('library.')->group(function () {
        Route::get('/my-documents', 'App\Http\Controllers\LibraryController@myDocuments')->name('my-documents');
        Route::get('/saved-materials', 'App\Http\Controllers\LibraryController@savedMaterials')->name('saved-materials');
        Route::get('/bookmarks', 'App\Http\Controllers\LibraryController@bookmarks')->name('bookmarks');
        Route::get('/recent-activity', 'App\Http\Controllers\LibraryController@recentActivity')->name('recent-activity');
    });

    // Community Routes
    Route::prefix('community')->name('community.')->group(function () {
        Route::get('/top-uploads', 'App\Http\Controllers\CommunityController@topUploads')->name('top-uploads');
        Route::get('/most-liked', 'App\Http\Controllers\CommunityController@mostLiked')->name('most-liked');
        Route::get('/top-rated', 'App\Http\Controllers\CommunityController@topRated')->name('top-rated');
        Route::get('/trending', 'App\Http\Controllers\CommunityController@trending')->name('trending');
    });
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
