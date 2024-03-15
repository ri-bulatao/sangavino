<?php

// Facades
use Illuminate\Support\Facades\{Auth,Route};

// Shared Restful Controllers
use App\Http\Controllers\All\{
    CommentController,
    PrintController,
    ProfileController,
    TmpImageUploadController
};

// Admin Restful Controllers
use App\Http\Controllers\Admin\{
    DashboardController,
    ActivityLogController,
    AnnouncementController,
    BlotterController,
    CategoryController,
    OfficialController,
    PositionController,
    ProductController,
    PurokController,
    RequestController as AdminRequestController,
    ResidentController,
    ServicesController,
    UserController
};

// Secretary
use App\Http\Controllers\Secretary\{
    AnnouncementController as SecretaryAnnouncementController,
    DashboardController as SecretaryDashboardController,
    RequestController as SecretaryRequestController
};

// Resident Restful Controllers
use App\Http\Controllers\Resident\{
    PaypalController,
    RequestController
};

// Guest
use App\Http\Controllers\Guest\{
    AnnouncementController as GuestAnnouncementController,
    MainController,
    OfficialController as GuestOfficialController
};



// Guest 
Route::group(['as' => 'guest.'],function() {
    Route::get('/', MainController::class)->name('main.index');
    Route::get('officials', GuestOfficialController::class)->name('officials.index');
    Route::resource('announcements', GuestAnnouncementController::class)->only(['index', 'show']);
});


// Admin 
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'as' => 'admin.'],function() {
    Route::get('dashboard', DashboardController::class)->name('dashboard.index');
    Route::resource('services', ServicesController::class);
    Route::get('/requests/{request}/print', [AdminRequestController::class, 'print'])->name('requests.print');
    Route::resource('requests', AdminRequestController::class);
    Route::resource('puroks', PurokController::class);
    Route::resource('residents', ResidentController::class);
    Route::resource('blotters', BlotterController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('positions', PositionController::class);
    Route::resource('officials', OfficialController::class);

    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    //Route::get('role', RoleController::class)->name('role.index');
    Route::get('activity', ActivityLogController::class)->name('activity_logs.index');
});


// Secretary 
Route::group(['middleware' => ['auth', 'secretary'], 'prefix' => 'secretary', 'as' => 'secretary.'],function() {
    Route::get('dashboard', SecretaryDashboardController::class)->name('dashboard.index');
    Route::get('/requests/{request}/print', [SecretaryRequestController::class, 'print'])->name('requests.print');
    Route::resource('requests', SecretaryRequestController::class);
    // Route::resource('blotters', BlotterController::class);
    Route::resource('announcements', SecretaryAnnouncementController::class);

});



// Resident
Route::group(['middleware' => ['auth', 'resident'], 'prefix' => 'resident', 'as' => 'resident.'],function() {
    Route::resource('issuance/requests', RequestController::class);

    Route::controller(PaypalController::class)->group(function () {
        Route::post('handle-payment', 'handle')->name('paypal.handle');
        Route::get('cancel-payment', 'cancel')->name('paypal.cancel');
        Route::get('payment-success', 'success')->name('paypal.success');
    });
    
});


// Auth
Route::group(['middleware' => ['auth']],function() {
    Route::delete('tmp_upload/revert', [TmpImageUploadController::class, 'revert']);     // TMP FILE UPLOAD
    Route::post('tmp_upload/content', [TmpImageUploadController::class, 'faqImageUpload'])->name('tmpupload.faqImageUpload');
    Route::resource('tmp_upload', TmpImageUploadController::class);
    Route::resource('profile', ProfileController::class)->parameter('profile', 'user');
    Route::get('print', PrintController::class)->name('print.handle');

    Route::resource('comments', CommentController::class)->except('index', 'show');
});



Auth::routes(['register' => false]);