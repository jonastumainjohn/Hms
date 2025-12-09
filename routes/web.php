<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControler;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PatientsController;

/**
 * Default route
 */


/**
 * TESTING ROUTES
 * 
 */
 Route::view('/example-page','example-page');
 Route::view('/example-auth','example-auth');

 Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (authentication)
    Route::middleware(['guest', 'preventBackHistory'])->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/login', 'loginForm')->name('login');
            Route::post('/login', 'loginHandler')->name('login_handler');
            Route::get('/forgot-password', 'forgotForm')->name('forgot');
            Route::post('/send-password-reset-link', 'sendPasswordResetLink')->name('send_password_reset_link');
            Route::get('/password/reset/{token}', 'resetForm')->name('reset_password_form');
            Route::post('/reset-password-handler', 'resetPasswordHandler')->name('reset_password_handler');
        });
    });

    // Authenticated routes
    Route::middleware(['auth', 'preventBackHistory'])->group(function () {
        Route::controller(AdminControler::class)->group(function () {
            Route::get('/dashboard', 'adminDashboard')->name('dashboard');
            Route::post('/logout', 'logoutHandler')->name('logout');
            Route::get('/profile', 'profileView')->name('profile');
            Route::post('/update-profile-picture', 'updateProfilePicture')->name('update_profile_picture');

            // Only for Super Admin
            Route::middleware(['OnlySuperAdmin'])->group(function () {
                Route::get('settings', 'generalSettings')->name('settings');
                Route::post('/update-logo', 'updateLogo')->name('update_logo');
                Route::post('/update-favicon', 'updateFavicon')->name('update_favicon');
                Route::get('/register-users', 'registerUsers')->name('register-users');
                Route::post('/create-user', 'createUser')->name('create-user');
                Route::get('/edit-user/{user}/edit', 'EditUser')->name('edit-user');
                Route::put('/update-user/{user}/edit', 'updateUser')->name('update-user');
                Route::delete('/delete-user/{user}', 'DeleteUser')->name('delete-user');

    
            });
        });

        // Doctor Routes
        Route::middleware(['OnlySuperAdmin'])->controller(DoctorsController::class)->group(function () {
            //Doctors Routes
            Route::get('/create-doctor', 'create')->name('create-doctor');
            Route::get('/list-doctors','index')->name('list-doctors');
            Route::post('/register-doctor', 'store')->name('store-doctor');
            Route::get('/register-doctor/{id}', 'edit')->name('edit-doctor');
            Route::delete('/delete-doctor/{id}','destroy')->name('delete-doctor');
            Route::put('/update-doctor/{id}','update')->name('update-doctor');
            //Receptionist Routes
            Route::get('/create-receptionist','createRecept')->name('create-receptionist');
            Route::get('/list-receptionist','listRecept')->name('list-receptionist');
            Route::post('/store-Receptionist','storeRecept')->name('store-Receptionist'); 
            Route::get('/edit-receptionist/{id}/edit','editRecept')->name('edit-receptionist');
            Route::put('/update-Receptionist/{id}/edit','updateReceptionist')->name('update-Receptionist');
            Route::Delete('/delete-receptionist/{id}','deleteRecept')->name('delete-receptionist');
            //Registration Fee
            Route::get('/registration-fee','registrationFees')->name('registration-fee');
            Route::post('/store-registration-fee','storeRegiFee')->name('store-registration-fee');
            Route::put('/registration-fees/{id}',  'storeRegiFee')->name('update-registration-fee');

            //Menage Medical
            Route::get('/create-medicals', 'createMedicals')->name('create-medicals');
            Route::post('/store-medicals', 'storeMedicals')->name('store-medicals');
            Route::get('/edit-medicals/{id}/edit', 'editMedicals')->name('edit-medicals');
            Route::put('/edit-medicals/{id}/pdate', 'updateMedicals')->name('update-medicals');
            Route::delete('/delete-medicals/{id}/delete', 'deleteMedicals')->name('delete-medicals');
            //Payments Records
            Route::get('/payment-records','paymentList')->name('payment-records');

        });
          
            // Doctor Routes
            Route::middleware(['doctorMiddleware'])->controller(DoctorsController::class)->group(function () {
            Route::get('/add-diagnosis/{patient}/add', 'addDiagnosis')->name('add-diagnosis');
            Route::post('/store-diagnosis/{patient}','storeDiagnosis')->name('store-diagnosis');
            Route::get('/list-diagnosis','listDiagnosis')->name('list-diagnosis');
            // web.php

           Route::get('medical-history/{patient_id}',  'getMedicalHistory');

            Route::get('/view-diagnosis/{id}','viewDiagnosis')->name('view-diagnosis');
            Route::get('/list-appointment','listAppointment')->name('list-appointment');
            Route::put('/appointments/{id}/update-status', 'updateStatus')->name('update-appointment-status');

            Route::post('/notifications/{notification}/mark-as-read', 'markAsRead')->name('notifications.markAsRead');
            Route::get('/notifications/unread', 'fetchNotifications')->name('notifications.fetch');
            Route::get('/admin/view-notification/{id}','viewNotification')->name('view-notification');
                //Prescription Routes
            Route::get('/prescriptions/create',  'createPrescription')->name('create-prescriptions');
            Route::post('/prescriptions',  'storePrescription')->name('store-prescriptions');
            Route::get('/prescriptions/{id}/edit', 'editPrescription')->name('edit-prescriptions');
            Route::put('/prescriptions/{id}', 'updatePrescription')->name('update-prescriptions');
            Route::delete('/prescriptions/{id}',  'deletePrescription')->name('delete-prescriptions');
            

            });
    
    
        // Patients Routes By Receptionist
        Route::middleware(['DoctorReceptMiddleware'])->controller(PatientsController::class)->group(function () {
            Route::get('/list-patients','index')->name('list-patients');
            Route::get('/view-patient/{id}','viewPatient')->name('view-patient');
            Route::get('/create-patient','create')->name('create-patient');
            Route::post('/create-patient','store')->name('create-patients');
            Route::get('/edit-patient/{id}','edit')->name('edit-patient');
            Route::put('/update-patient/{id}','update')->name('update-patient');
            
        });

             // Invertory  Routes By SuperAdmin
             Route::middleware(['OnlySuperAdmin'])->controller(InventoryController::class)->group(function () {
                Route::get('list_inventory',  'index')->name('list_inventory');
                Route::get('generate-slug', 'generateSlug')->name('getSlug');
        
                // Create Inventory Product
                Route::get('create_inventory', 'create')->name('create_inventory');
                Route::post('store_inventory',  'store')->name('store_inventory');



                Route::put('/products/{id}', 'update')->name('update_product');
                Route::get('/products/{id}/edit', 'edit')->name('edit_product');
                Route::delete('/products/{id}','destroy')->name('delete_product');
              
                
            });

        // Patients Routes By Receptionist and Doctor
        Route::middleware(['DoctorReceptMiddleware'])->controller(DoctorsController::class)->group(function () {
            //Prescription route 
            Route::get('/prescriptions', 'listPrescriptions')->name('list-prescriptions');
            Route::get('/prescriptions/{id}/view',  'showPrescription')->name('show-prescriptions');
            
        });

           // Patients Routes By Receptionist
           Route::middleware(['ReceptionistMiddleware'])->controller(DoctorsController::class)->group(function () {
            Route::post('/send-invoice/{id}/', 'sendPrescriptionMail')->name('send-invoice');
        });


    });

});


