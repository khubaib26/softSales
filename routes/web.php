<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    ProfileController,
    MailSettingController,
    CategoryController,
    LeadController,
    UserController,
    DashboardController,
    PaymentGatewayController   
};

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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/test-mail',function(){

    $message = "Testing mail";

    \Mail::raw('Hi, welcome!', function ($message) {
      $message->to('ajayydavex@gmail.com')
        ->subject('Testing mail');
    });

    dd('sent');

});


Route::get('/dashboard', function () {
    return view('front.dashboard');
})->middleware(['front'])->name('dashboard');


require __DIR__.'/front_auth.php';



// Admin routes
// Route::get('/admin/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('admin.dashboard');

Route::get('/admin/dashboard',[DashboardController::class, 'index'])->middleware(['auth'])->name('admin.dashboard');

require __DIR__.'/auth.php';

//Admin Routes 
Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')->group(function(){
        Route::resource('roles','RoleController');
        Route::resource('permissions','PermissionController');
        
        //User Routes
        Route::resource('users','UserController');
        Route::get('/changeUserStatus', [UserController::class, 'changeUserStatus'])->name('userStatus');
        Route::post('/createcredit',[UserController::class, 'createUserCredit'])->name('UsersCredit');
        Route::post('/assingbrand',[UserController::class, 'assingBrandUser'])->name('AssingBrandUser');
        Route::post('/unassingbrand',[UserController::class, 'unassigneBrand'])->name('UnAssingBrandUser');


        Route::resource('posts','PostController');
        Route::resource('categories','CategoryController');
        Route::resource('brands','BrandController');
        
        //Leads Routes
        Route::resource('leads','LeadController');
        Route::get('/lead-Assign-User',[LeadController::class, 'assign_user'])->name('leadAssingUser');
        Route::get('/changeleadStatus', [LeadController::class, 'leadStatus'])->name('changeLeadStatus');

        //Paymnet Gateways
        Route::resource('gateways','PaymentGatewayController');

        //Team 
        Route::resource('teams','TeamController');

        Route::get('/profile',[ProfileController::class,'index'])->name('profile');
        Route::put('/profile-update',[ProfileController::class,'update'])->name('profile.update');
        Route::get('/mail',[MailSettingController::class,'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}',[MailSettingController::class,'update'])->name('mail.update');        
});
