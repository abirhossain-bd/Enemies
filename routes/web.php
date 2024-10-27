<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\CatBlogController;
use App\Http\Controllers\Frontend\GuestAuthenticationController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SocialiteProviderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Auth::routes(['register'=> false]);

// frontend

Route::get('/',[FrontendHomeController::class,'index'])->name('frontend');
Route::get('/category/{slug}',[CatBlogController::class,'show'])->name('frontend.cat.blog');
Route::get('/blogs',[FrontendBlogController::class,'index'])->name('frontend.blogs');
Route::get('/blog/single/{slug}',[FrontendBlogController::class,'single'])->name('frontend.blog.single');
Route::post('/blog/comment/{id}',[FrontendBlogController::class,'comment'])->name('frontend.blog.comment');


Route::get('/guest/login',[GuestAuthenticationController::class,'login'])->name('guest.login');
Route::post('/guest/login',[GuestAuthenticationController::class,'login_post'])->name('guest.login');
Route::get('/guest/register',[GuestAuthenticationController::class,'register'])->name('guest.register');
Route::post('/guest/register',[GuestAuthenticationController::class,'register_post'])->name('guest.register');


Route::get('/request/sent',[RequestController::class,'index'])->name('request.show');
Route::get('/request/sent/accept/{id}',[RequestController::class,'accept'])->name('request.accept');
Route::get('/request/sent/cancel/{id}',[RequestController::class,'cancel'])->name('request.cancel');
Route::post('/request/sent/{id}',[RequestController::class,'request_sent'])->name('request.sent');


Route::middleware(['auth','verified'])->group(function(){
// dashboard

Route::get('/home',[HomeController::class, 'index'])->name('dashboard');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// profile update
Route::get('/profile',[ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/username/update', [ProfileController::class, 'name_update'])->name('profile.name.update');
Route::post('/profile/password/update', [ProfileController::class, 'password_update'])->name('profile.password.update');
Route::post('/profile/email/update', [ProfileController::class, 'email_update'])->name('profile.email.update');
Route::post('/profile/image/update', [ProfileController::class, 'image_update'])->name('profile.image.update');


// management
Route::middleware('authRole')->group(function(){

    Route::get('/user/authenticate', [ManagementController::class, 'index'])->name('management.index');
    Route::post('/user/authenticate', [ManagementController::class, 'user_register'])->name('management.user.register');
    Route::post('/user/authenticate/role/undo/{id}', [ManagementController::class, 'role_undo'])->name('management.user.role.undo');

    Route::get('/user/authenticate/edit/{id}', [ManagementController::class, 'edit'])->name('management.user.edit');
    Route::post('/user/authenticate/update/{id}', [ManagementController::class, 'update'])->name('management.user.update');
    Route::post('/user/authenticate/delete/{id}', [ManagementController::class, 'destroy'])->name('management.user.destroy');



    Route::get('/user/role/assign', [ManagementController::class, 'role_assign'])->name('role.index');
    Route::post('/user/role/assign', [ManagementController::class, 'role_assign_post'])->name('role.index');
    Route::post('/user/authenticate/role/undo/blogger/{id}', [ManagementController::class, 'role_undo_blogger'])->name('management.user.role.undo.blogger');

    Route::post('/user/authenticate/delete/blogger/{id}', [ManagementController::class, 'destroy_blogger'])->name('management.user.delete.blogger');

    Route::post('/user/authenticate/role/undo/user/{id}', [ManagementController::class, 'role_undo_user'])->name('management.user.role.undo.user');
    Route::post('/user/authenticate/delete/user/{id}', [ManagementController::class, 'destroy_user'])->name('management.user.delete.user');
});



Route::middleware('excess')->group(function(){
//Category
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::post('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::post('/category/status/{id}', [CategoryController::class, 'status'])->name('category.status');




// blog

Route::resource('blog', BlogController::class);
Route::post('/blog.status/{id}',[BlogController::class,'statusUpdate'])->name('blog.status');
Route::post('/blog/feature/{id}',[BlogController::class,'featureUpdate'])->name('blog.feature');
});

});


// email verification


Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



// socialite

Route::get('/auth/{provider}/redirect',[SocialiteProviderController::class,'redirect']);
Route::get('/auth/{provider}/callback',[SocialiteProviderController::class,'callback']);


