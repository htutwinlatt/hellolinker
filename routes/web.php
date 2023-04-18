<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MovieController;
use App\Http\Controllers\User\ReportController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\PhoneBillController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\LuckyDrawController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSlideShowControlller;
use App\Http\Controllers\Admin\ReportController as AdminReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();
Route::get('dashboard', function () {
    return;
})->name('dashboard');

Route::get('/needvpn', function () {
    return view('errors.isneedvpn');
})->name('needvpn');

// Route::middleware('blockMyanmar')->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('user#home');

    Route::prefix('movies')->group(function () {
        Route::get('', [MovieController::class, 'index'])->name('user#movies');
        Route::get('{id}', [MovieController::class, 'info'])->name('user#movie_info');
        Route::get('comments/{id}', [CommentController::class, 'index'])->name('user#movie_comments');
        Route::get('get_link/{id}/{name}', [MovieController::class, 'get_link'])->name('user#movie_get_link');
        Route::get('get_comment_preview/{id}', [CommentController::class, 'get_comments_preview'])->name('user#comment_preview');
    });
    Route::prefix('category')->group(function () {
        Route::get('', [MovieController::class, 'category_page'])->name('user#category_page');
        Route::get('list', [MovieController::class, 'category_list'])->name('user#category_list');
        Route::get('search/{id}', [MovieController::class, 'search_by_category'])->name('user#category_search');
    });

    Route::prefix('report')->group(function(){
        Route::post('', [ReportController::class, 'insert'])->name('user#report');
    });
// });

Route::middleware(['auth'])->group(function () {

    Route::prefix('user')->group(function () {
        Route::post('update_profile', [ProfileController::class, 'update_profile'])->name('user#up_profile');
        Route::post('update_password', [ProfileController::class, 'update_password'])->name('user#up_password');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile.show');
    });

    //Comments Route
    Route::prefix('comment')->group(function () {
        Route::post('add/{id}', [CommentController::class, 'add'])->name('user#comment_add');
        Route::get('destroy/{id}', [CommentController::class, 'destroy'])->name('user#comment_del');
    });

    Route::prefix('phoneBill')->group(function () {
        Route::post('is_winner', [PhoneBillController::class, 'check_winner'])->name('user#is_winner'); //Api
        Route::get('phone_insert', [PhoneBillController::class, 'phone_insert_page'])->name('user#lucky_add_phone');
        Route::post('phone_insert', [PhoneBillController::class, 'phone_insert'])->name('user#lucky_add_phone');
    });
// ------------------------------------------------------------------------------------------------------------------------------------
    // Routes For Admins
    Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
        //Dashboard
        Route::prefix('dashboard')->group(function () {
            Route::get('', [AdminDashboardController::class, 'index'])->name('admin#dashboard');
            Route::post('view_count',[AdminDashboardController::class,'view_count'])->name('admin#view_count');
        });
        //Movies
        Route::prefix('movies')->group(function () {
            Route::get('', [AdminMovieController::class, 'index'])->name('admin#movie_list');
            Route::get('advance_search', [AdminMovieController::class, 'movies_advance_search'])->name('admin#mov_adv_search');
            Route::get('insert', [AdminMovieController::class, 'insertPage'])->name('admin#movie_insert');
            Route::post('insert', [AdminMovieController::class, 'insert'])->name('admin#movie_insert');
            Route::get('edit/{id}', [AdminMovieController::class, 'editPage'])->name('admin#movie_edit');
            Route::post('edit/{id}', [AdminMovieController::class, 'edit'])->name('admin#movie_edit');
            Route::get('new_arrives', [AdminMovieController::class, 'new_arrives'])->name('admin#movie_new_arrives');
            Route::get('delete/{id}', [AdminMovieController::class, 'destroy'])->name('admin#movie_delete');
            Route::get('new_arrives/remove/{id}', [AdminMovieController::class, 'new_arr_remove'])->name('admin#new_arrive_remove');
            Route::post('separate/category', [AdminMovieController::class, 'separate_category'])->name('admin#separate_category');
        });
        //Users
        Route::prefix('users')->group(function () {
            Route::get('', [AdminUserController::class, 'index'])->name('admin#user_list');
            Route::get('edit/{id}', [AdminUserController::class, 'editPage'])->name('admin#user_edit');
            Route::put('plan_change/{id}', [AdminUserController::class, 'plan_change'])->name('admin#user_plan_change');
            Route::put('update/{id}', [AdminUserController::class, 'update'])->name('admin#user_update');
            Route::post('destroy/{id}', [AdminUserController::class, 'destroy'])->name('admin#user_destroy');
            Route::get('remove_device/{id}', [AdminUserController::class, 'rm_device'])->name('admin#user_rm_device');
        });
        //SlideShows
        Route::prefix('slideShows')->group(function () {
            Route::get('', [AdminSlideShowControlller::class, 'index'])->name('admin#slideshow_list');
            Route::get('insert', [AdminSlideShowControlller::class, 'insertPage'])->name('admin#slideshow_insertPage');
            Route::post('insert', [AdminSlideShowControlller::class, 'insert'])->name('admin#slideshow_insert');
            Route::get('searchMovie', [AdminSlideShowControlller::class, 'searchMovie'])->name('admin#slideshow_searchMov');
            Route::get('destroy/{id}', [AdminSlideShowControlller::class, 'destroy'])->name('admin#slideshow_destroy');
            Route::get('edit/{id}', [AdminSlideShowControlller::class, 'editPage'])->name('admin#slideshow_edit');
            Route::post('edit/{id}', [AdminSlideShowControlller::class, 'update'])->name('admin#slideshow_edit');
            Route::post('sort',[AdminSlideShowControlller::class,'sort'])->name('admin#slideshow_sort');
        });

        Route::prefix('lucky_draw')->group(function () {
            Route::get('', [LuckyDrawController::class, 'index'])->name('admin#lucky');
            Route::get('complete/{id}', [LuckyDrawController::class, 'complete'])->name('admin#lucky_complete');
            Route::get('reset/table', [LuckyDrawController::class, 'reset'])->name('admin#lucky_reset');
        });


        Route::prefix('report')->group(function(){
            Route::get('',[AdminReportController::class,'index'])->name('admin#report');
            Route::post('more',[AdminReportController::class,'more'])->name('admin#report_more');
            Route::post('solved',[AdminReportController::class,'destroy'])->name('admin#report_solve');
        });
    });
});


Route::get('/clear',function(){
    Artisan::call("cache:clear");
    Artisan::call("config:cache");
    Artisan::call("route:clear");
    Artisan::call("view:clear");
    echo "<h3> Cache Cleared </h3>";
});

