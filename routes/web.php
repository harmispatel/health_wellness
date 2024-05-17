<?php

use App\Http\Controllers\Admin\{DashboardController,RoleController,AuthController,UserController,ForgotPasswordController};
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
// Cache Clear Route
Route::get('config-clear', function ()
{
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    return redirect()->route('dashboard');
});

// Frontend
Route::get('/', function ()
{
    // return view('frontend.welcome');
    return redirect()->route('admin.login');

});

// ADMIN ROUTES
// Auth::routes();
Route::group(['prefix' => 'admin'], function()
{
    Route::get('/', function ()
    {
        return redirect()->route('admin.login');
    });

    // Admin Auth Routes
    Route::get('/login', [AuthController::class,'showAdminLogin'])->name('admin.login');
    Route::post('/do/login', [AuthController::class,'Adminlogin'])->name('admin.do.login');
    Route::get('/forget-password', [ForgotPasswordController::class, 'showforgetpasswordform'])->name('forget.password.get');
    Route::post('/forget-password', [ForgotPasswordController::class, 'submitforgetpasswordform'])->name('forget.password.post');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showresetpasswordform'])->name('reset.password.get');
    Route::post('/reset-password', [ForgotPasswordController::class, 'submitresetpasswordform'])->name('reset.password.post');


    Route::group(['middleware' => 'is_admin'], function ()
    {
        // Dashboard
        Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

        // Roles
        Route::get('roles',[RoleController::class,'index'])->name('roles');
        Route::get('roles/create',[RoleController::class,'create'])->name('roles.create');
        Route::post('roles/store',[RoleController::class,'store'])->name('roles.store');
        Route::get('roles/edit/{id}',[RoleController::class,'edit'])->name('roles.edit');
        Route::post('roles/update',[RoleController::class,'update'])->name('roles.update');
        Route::post('roles/destroy',[RoleController::class,'destroy'])->name('roles.destroy');

        // User
        Route::get('users',[UserController::class,'index'])->name('users');
        Route::get('users/create',[UserController::class,'create'])->name('users.create');
        Route::post('users/store',[UserController::class,'store'])->name('users.store');
        Route::post('users/status',[UserController::class,'status'])->name('users.status');
        Route::post('users/update',[UserController::class,'update'])->name('users.update');
        Route::get('users/edit/{id}',[UserController::class,'edit'])->name('users.edit');
        Route::post('users/destroy',[UserController::class,'destroy'])->name('users.destroy');
        Route::get('profile/edit/{id}',[UserController::class,'profileEdit'])->name('profile.edit');
        Route::post('profile/update',[UserController::class,'profileUpdate'])->name('profile.update');

        // question
        Route::get('question',[QuestionController::class,'index'])->name('question.index');
        Route::get('question/create',[QuestionController::class,'create'])->name('question.create');
        Route::post('question/store',[QuestionController::class,'store'])->name('question.store');
        Route::get('question/edit/{id}',[QuestionController::class,'edit'])->name('question.edit');
        Route::post('question/update',[QuestionController::class,'update'])->name('question.update');
        Route::post('question/destroy',[QuestionController::class,'delete'])->name('question.destroy');
        Route::get('question/optionView/{id}',[QuestionController::class,'questionOptionView'])->name('question.optionView');

        // Logout Admin
        Route::get('/logout',[DashboardController::class,'adminLogout'])->name('admin.logout');


        //advertisement
        Route::any('/advertisement',[DashboardController::class,'advertisementView'])->name('advertisement.index');
      
    });
});
