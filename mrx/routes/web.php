<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backend\HomeController as BackendHomeController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\Backend\ResumeController as BackendResumeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProjectController;

use App\Http\Controllers\Backend\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use App\Http\Controllers\Backend\DashboardController;

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
//Page route
Route::get('/',[HomeController::class,'page']);
Route::get('/contact',[ContactController::class,'page']);
Route::get('/projects',[ProjectController::class,'page']);
Route::get('/resume',[ResumeController::class,'page']);


//Ajax call route
Route::get('/heroData',[HomeController::class,'homeData']);
Route::get('/aboutData',[HomeController::class,'aboutData']);
Route::get('/socialData',[HomeController::class,'socialData']);

Route::get('/projectData',[ProjectController::class,'projectData']);

Route::get('/resumeLink',[ResumeController::class,'resumeLink']);
Route::get('/experienceData',[ResumeController::class,'experienceData']);
Route::get('/educationData',[ResumeController::class,'educationData']);
Route::get('/skillsData',[ResumeController::class,'skillsData']);
Route::get('/languageData',[ResumeController::class,'languageData']);

Route::post('/contactRequest',[ContactController::class,'contactRequest']);



//==========================backend routs start=======================================//
//====================================================================================//

// Web API Routes
Route::post('/user-registration',[UserController::class,'UserRegistration']);
Route::post('/user-login',[UserController::class,'UserLogin']);
Route::post('/send-otp',[UserController::class,'SendOTPCode']);
Route::post('/verify-otp',[UserController::class,'VerifyOTP']);
Route::post('/reset-password',[UserController::class,'ResetPassword'])->middleware([TokenVerificationMiddleware::class]);



// User Logout
Route::get('/logout',[UserController::class,'UserLogout']);

// Page Routes
Route::get('/userLogin',[UserController::class,'LoginPage']);
Route::get('/userRegistration',[UserController::class,'RegistrationPage']);
Route::get('/sendOtp',[UserController::class,'SendOtpPage']);
Route::get('/verifyOtp',[UserController::class,'VerifyOTPPage']);




Route::group(['middleware' => [TokenVerificationMiddleware::class]], function () {

    Route::get('/resetPassword',[UserController::class,'ResetPasswordPage']) ;
    Route::get('/dashboard',[DashboardController::class,'DashboardPage']);


    //Baxkend HomeController
    Route::controller(BackendHomeController::class)->group(function () {
        //hero area routes
            Route::get('/hero', 'heroPage')->name('hero.page');
            Route::post('/hero-data', 'herodata')->name('hero.data');
            Route::post('/update-hero', 'updateHero')->name('hero.update');

        //about area routes
            Route::get('/about', 'aboutPage')->name('about.page');
            Route::get('/about-data', 'aboutdatashow');
            Route::post('/update-about', 'updateAbout');

        //social link area routes
            Route::get('/social-linls', 'socialLink')->name('social.link');
            Route::get('/social-link-data', 'sociallinkData');
            Route::post('/update-sociallink', 'updateSocialLink');



    });
    //Backend ResumeController
    Route::controller(BackendResumeController::class)->group(function () {
        //experience area routes
            Route::get('/experience', 'experiencePage')->name('experience.page');
            Route::get('/list-experience', 'experienceList')->name('experience.list');
            Route::post('/create-experience', 'createExperience');
            Route::post('/experience-by-id', 'experienceById');
            Route::post('/update-experience', 'experienceUpdate') ;
            Route::post('/delete-experience', 'experienceDelete') ;


        //education area routes
            Route::get('/education', 'educationPage')->name('education.page');
            Route::get('/list-education', 'educationList')->name('education.list');
            Route::post('/create-education', 'createEducation');

            Route::post('/education-by-id', 'educationById');
            Route::post('/update-education', 'educationUpdate') ;
            Route::post('/delete-education', 'educationDelete') ;


        //Skills area routes
            Route::get('/skill', 'skillPage')->name('skill.page');
            Route::get('/list-skill', 'skillList')->name('skill.list');
            Route::post('/create-skill', 'createskill');
            Route::post('/skill-by-id', 'skillById');
            Route::post('/update-skill', 'skillUpdate') ;
            Route::post('/delete-skill', 'skillDelete') ;


        //language area routes
            Route::get('/language', 'languagePage')->name('language.page');
            Route::get('/list-language', 'languageList')->name('language.list');
            Route::post('/create-language', 'createlanguage');
            Route::post('/language-by-id', 'languageById');
            Route::post('/update-language', 'languageUpdate') ;
            Route::post('/delete-language', 'languageDelete') ;





    });
});

//==========================backend routs end=======================================//
//==================================================================================//
