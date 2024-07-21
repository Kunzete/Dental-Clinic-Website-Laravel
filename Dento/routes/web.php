<?php

use App\Http\Controllers\admin\DoctorController;
use App\Http\Controllers\admin\PatientController;
use \App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\AdminProfileController;
use App\Http\Controllers\dentist\AppointmentController;
use App\Http\Controllers\dentist\DentistProfileController;
use \App\Http\Controllers\dentist\LoginController as DentistLoginController;
use App\Http\Controllers\dentist\DashboardController as DentistDashboardController;
use \App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PatientProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'Dashboard'])->name('index');
Route::post('/appointment', [HomepageController::class, 'booking'])->name('create.appointment');

Route::group(['prefix' => 'account'], function () {

    //Guest Middleware
    Route::group(['middleware' => 'guest'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('account.login');
        Route::get('register', [LoginController::class, 'register'])->name('account.register');
        Route::get('reset-password', [LoginController::class, 'enter_email'])->name('account.reset');
        Route::post('reset-password/send', [LoginController::class, 'send_code'])->name('account.sendCode');
        Route::get('reset-password/code/{email}', [LoginController::class, 'enter_code'])->name('account.enter_code');
        Route::post('reset/authorize-code/{email}', [LoginController::class, 'authorize_code'])->name('account.authorizeCode');
        Route::get('reset-password/new-password/{email}', [LoginController::class, 'enter_password'])->name('account.new-password');
        Route::post('reset-password/change-password/{email}', [LoginController::class, 'change_pass'])->name('account.change-password');
        Route::post('process-register', [LoginController::class, 'processRegister'])->name('account.processRegister');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
    });

    //Authenticated Middleware
    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class, 'appointment'])->name('account.dashboard');
        Route::post('book-appointment', [DashboardController::class, 'booking'])->name('account.appointment');
        Route::get('profile', [DashboardController::class, 'profile'])->name('account.profile');
        Route::post('update', [PatientProfileController::class, 'update'])->name('account.update');
        Route::post('updatePassword', [PatientProfileController::class, 'updatePassword'])->name('account.updatePassword');
        Route::post('updatePic', [PatientProfileController::class, 'updatePFP'])->name('account.pfp');
        Route::post('deletePic', [PatientProfileController::class, 'destroyPFP'])->name('account.deletePFP');
    });
});

Route::group(['prefix' => 'admin'], function () {

    //Guest Middleware for admin
    Route::group(['middleware' => 'admin.guests'], function () {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    //Authenticated Middleware for admin
    Route::group(['middleware' => 'admin.auths'], function () {
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('dashboard', [AdminDashboardController::class, 'Info'])->name('admin.dashboard');
        Route::get('profile', [AdminDashboardController::class, 'profile'])->name('admin.profile');
        Route::post('update', [AdminProfileController::class, 'update'])->name('admin.update');
        Route::post('updatePassword', [AdminProfileController::class, 'updatePassword'])->name('admin.updatePassword');
        Route::post('updatePic', [AdminProfileController::class, 'updatePFP'])->name('admin.pfp');
        Route::post('deletePic', [AdminProfileController::class, 'destroyPFP'])->name('admin.deletePFP');
        Route::get('/admins/list', [AdminDashboardController::class, 'list'])->name('admin.list');
        Route::get('/admins/search', [AdminDashboardController::class, 'search'])->name('admin.search');
        Route::get('patients/list', [PatientController::class, 'show'])->name('patient.list');
        Route::get('patients/edit/{id}', [PatientController::class, 'edit'])->name('patient.edit');
        Route::post('patients/update/{id}', [PatientController::class, 'update'])->name('patient.update');
        Route::post('patients/update-role', [PatientController::class, 'updateRole'])->name('update.role');
        Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patient.destroy');
        Route::get('/patient/search', [PatientController::class, 'search'])->name('patient.search');
        Route::get('doctors/list', [DoctorController::class, 'show'])->name('doctor.list');
        Route::get('doctors/edit/{id}', [DoctorController::class, 'edit'])->name('doctor.edit');
        Route::post('doctors/update/{id}', [DoctorController::class, 'update'])->name('doctor.update');
        Route::get('doctors/create', [DoctorController::class, 'create'])->name('doctor.create');
        Route::post('doctors/update-role', [DoctorController::class, 'updateRole'])->name('doctor.update.role');
        Route::post('doctors/register', [DoctorController::class, 'createDoctor'])->name('doctor.createDoctor');
        Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctor.destroy');
        Route::get('/doctors/search', [DoctorController::class, 'search'])->name('doctor.search');
        Route::get('/service/list', [AdminDashboardController::class, 'listService'])->name('service.list');
        Route::get('/service/create', [AdminDashboardController::class, 'createService'])->name('service.create');
        Route::post('/service/post', [AdminDashboardController::class, 'postService'])->name('service.post');
    });
});

Route::group(['prefix' => 'dentist'], function () {

    //Guest Middleware for dentist
    Route::group(['middleware' => 'doctor.guests'], function () {
        Route::get('login', [DentistLoginController::class, 'index'])->name('dentist.login');
        Route::post('authenticate', [DentistLoginController::class, 'authenticate'])->name('dentist.authenticate');
    });

    //Authenticated Middleware for denstist
    Route::group(['middleware' => 'doctor.auths'], function () {
        Route::get('logout', [DentistLoginController::class, 'logout'])->name('dentist.logout');
        Route::get('dashboard', [DentistDashboardController::class, 'index'])->name('dentist.dashboard');
        Route::get('profile', [DentistDashboardController::class, 'profile'])->name('dentist.profile');
        Route::post('update', [DentistProfileController::class, 'update'])->name('dentist.update');
        Route::post('updatePassword', [DentistProfileController::class, 'updatePassword'])->name('dentist.updatePassword');
        Route::post('updatePic', [DentistProfileController::class, 'updatePFP'])->name('dentist.pfp');
        Route::post('deletePic', [DentistProfileController::class, 'destroyPFP'])->name('dentist.deletePFP');
        Route::get('appointment/all', [AppointmentController::class, 'all'])->name('all.appointment');
        Route::get('/appointment/search', [AppointmentController::class, 'search'])->name('appointment.search');
        Route::post('appointment/update-status', [AppointmentController::class, 'updateStatus'])->name('update.status');
    });
});
