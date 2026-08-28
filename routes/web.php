<?php

use App\Http\Controllers\AddPlantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProfileDetailController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PlantUpdateController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\PlantCatalogController;
use App\Http\Controllers\DeletePlantController;
use App\Http\Controllers\whitelistController;
use App\Http\Controllers\PlantSearchController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PassowrdResetController;
use App\Http\Controllers\PlantSuitabilityController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/registration', function () {
    return view('auth.registration');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/plant/{id}', [DetailController::class, 'show'])->name('detail');

Route::get('/suitability', function () {
    return view('frontend.suitability');
});

Route::get('/profile', function () {
    return view('user.profile_detail');
})->name('profile');


//  +++++++++++++++++++++++++++++++ Backend Routes +++++++++++++++++++++++++++++++

Route::get('/forgot_password', function () {
    return view('frontend.forgot_password');
})->name('forgot_password');

// Displays the HTML page with the form
Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register.form');

// Handles the POST data when "Complete Enrollment" is clicked
Route::post('/register', [RegistrationController::class, 'register'])->name('register');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login'); 


Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// 2. PROTECTED ROUTES (Only accessible if logged in)
Route::middleware(['auth'])->group(function () {

    Route::get('/add_a_plant', function () {
        return view('admin.add_a_plant');
    })->name('add_a_plant');

    Route::get('/delete_a_plant', function () {
        return view('admin.delete_a_plant');
    })->name('delete_a_plant');


Route::get('/all-users', [UsersController::class, 'index'])->name('all_users');
Route::get('/all-users/export', [UsersController::class, 'exportCsv'])->name('all_users.export');
Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
});


// Authenticated Profile Updates
Route::middleware(['auth'])->group(function () {
    Route::post('/profile/avatar', [ProfileDetailController::class, 'updateAvatar'])->name('profile.avatar.update');

    // Replace your existing /home route with this:
Route::get('/home', [PlantController::class, 'index'])->name('home');
Route::get('/data', [PlantController::class, 'index'])->name('homedata');

Route::get('/change_password', function () {
    return view('frontend.change_password');
})->name('change_password');

});


Route::middleware('auth')->group(function () {
    // The route that handles processing the form submission data
    Route::put('/profile/update', [EditProfileController::class, 'update'])->name('profile.update');
    
    Route::get('/edit_profile', function () {
    return view('user.edit_profile');
})->name('edit_profile');

//Add a plant routes
Route::get('/plants/create', [AddPlantController::class, 'create'])->name('add_a_plant');
Route::post('/plants', [AddPlantController::class, 'store'])->name('plants.store');

//update a plant 

Route::get('/plants/edit', [PlantUpdateController::class, 'edit'])->name('update_a_plant');
Route::put('/plants/{id}', [PlantUpdateController::class, 'update'])->name('plants.update');

//delete a plant routes
Route::get('/plants/delete',     [DeletePlantController::class, 'index'  ])->name('plants.delete');
Route::delete('/plants/{plant}', [DeletePlantController::class, 'destroy'])->name('plants.destroy');

// Plant Catalog Administration Route System
Route::get('/plant_catalog', [PlantCatalogController::class, 'index'])->name('plant_catalog');
Route::delete('/plant_catalog/{id}', [PlantCatalogController::class, 'destroy'])->name('plants.destroy');
Route::get('/plant_catalog/export', [PlantCatalogController::class, 'exportCsv'])->name('plants.export');

//edit plant frm plant catalog page
// Add this: Route configuration pointing to your optimization screen
Route::get('/plant_catalog/edit-matrix', [PlantCatalogController::class, 'editMatrix'])->name('admin.update_a_plant');
});

// ── All the following are message routes ───────────────────────────────────────────────

// Public: contact form submission (any visitor)
Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');

// Public API: unread badge count (called by header JS polling)
Route::get('/api/messages/unread-count', [MessageController::class, 'unreadCount'])
     ->name('messages.unread.count');

// Admin only
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/messages',                  [MessageController::class, 'index'          ])->name('admin.messages');
    Route::get('/messages/{message}',        [MessageController::class, 'show'           ])->name('admin.messages.show');
    Route::delete('/messages/{message}',     [MessageController::class, 'destroy'        ])->name('admin.messages.destroy');
    Route::delete('/messages-bulk',          [MessageController::class, 'destroyFiltered'])->name('admin.messages.bulk-delete');
});

Route::get('/support', fn() => view('frontend.support'))->name('support');


Route::middleware(['auth'])->group(function () {
    // 1. View all whitelisted items
    Route::get('/whitelist', [whitelistController::class, 'index'])->name('whitelist.index');
    
    // 2. Add an item to the whitelist
    Route::post('/whitelist', [whitelistController::class, 'store'])->name('whitelist.store');
    
    // 3. Remove an item from the whitelist (using the item's ID)
    Route::delete('/whitelist/{id}', [whitelistController::class, 'destroy'])->name('whitelist.destroy');
});

//for dynamic searchbar

Route::get('/api/plants/search', [PlantSearchController::class, 'search'])->name('plants.search');


//change password routes

Route::middleware(['auth'])->group(function () {
    Route::get('/change-password', [ChangePasswordController::class, 'edit'])->name('password.edit');
    Route::put('/change-password', [ChangePasswordController::class, 'update'])->name('password.update');
   
    Route::get('/password_changed_succuessfully', function () {
    return view('frontend.password_changed_succuessfully');
    })->name('password_changed_succuessfully');

});

//send email to user when forgot password
// Route::get('send-Email', [EmailController::class, 'sendEmail']);  //delete this route
Route::post('passwordForgot', [EmailController::class, 'passwordForgot'])->name('passwordForgot');  

Route::get('/verify_code', function () {
    return view('frontend.verify_code');
})->name('verify_code');


// Route::post('/forgot-password', [EmailController::class, 'passwordForgot'])->name('passwordForgot');

// Resend code(during password forgot) route 
Route::get('resendCode', [EmailController::class, 'resendCode'])->name('resendCode');
//sending four digit code from user
Route::post('fourdigitcode', [EmailController::class, 'verifyCode'])->name('fourdigitcode'); 
//next page where user gives new password
Route::get('/reset_password', function () {
    return view('frontend.reset_password');
})->name('reset_password'); 

//updating password in DB:
Route::put('/update-password', [PassowrdResetController::class, 'resetPassword'])->name('password_update');
//when user updated password successfully in DB:
Route::get('/Password_reset_successfully', function () {
    return view('frontend.Password_reset_successfully');
})->name('Password_reset_successfully'); 


//routes for plant suitability check

Route::middleware('auth')->group(function () {
    Route::get('/plant/{plant}/suitability', [PlantSuitabilityController::class, 'show'])
        ->name('plant.suitability');
});
