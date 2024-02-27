<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DependantDropdownController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SalesAuthController;
use App\Models\User;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PasswordGenerationController;
use App\Http\Controllers\SalesReportController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\TestPushController; 




// use App\Http\Controllers\SuperAdminController;





Route::get('/', function () {
    return view('welcome');
});


Route::resource('shops', ShopController::class);
Route::resource('sales', SalesController::class);


Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);


// detail data visit per shop
Route::get('shops/details/visitdata/{id}',[ShopController::class,'showDetails'])->name('view-shop-details-visit-data');
Route::get('/assign-sales-to-shop', [SalesController::class, 'showAssignSalesToShopForm'])->name('assign.sales.to.shop');

Route::get('sales/details/shopdata/{namasales}',[ShopController::class,'showDetailsShopData'])->name('view-sales-details-shop-data');


Route::get('provinces', [DependantDropdownController::class,'provinces'])->name('provinces');
Route::get('cities', [DependantDropdownController::class,'cities'])->name('cities');
Route::get('districts', [DependantDropdownController::class,'districts'])->name('districts');
Route::get('villages', [DependantDropdownController::class,'villages'])->name('villages');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');






Route::get('/assign-sales-to-shop', [SalesController::class, 'showAssignSalesToShopForm'])->name('assign.sales.to.shop');
Route::post('/assign-sales-to-shop/save', [SalesController::class, 'assignSalesToShop'])->name('assign.sales.to.shop.save');
Route::get('/search-shops', [SalesController::class, 'searchShops'])->name('search.shops');



Route::get('/shops/{id}', [ShopController::class, 'show'])->name('shops.details');


Route::get('/shops/{id}/visits/create', [VisitController::class, 'create'])->name('visits.create');
Route::post('/shops/{id}/visits', [VisitController::class, 'store'])->name('visits.store');


Route::get('visits/{location}', [VisitController::class, 'show'])->name('visits.show');
Route::get('visits/{id}/edit', [VisitController::class, 'edit'])->name('visits.edit');
Route::put('visits/{id}', [VisitController::class, 'update'])->name('visits.update');

Route::get('superadmin/visits/{location}', [VisitController::class, 'show'])->name('superadmin.visits.show');



Route::get('visited-store-data}', [VisitController::class, 'showVisitedStoreData'])->name('visits.showVisitedStoreData');




// Route::get('/report/{token}', [ReportController::class, 'index'])->name('report.index');
Route::get('/report', [ReportController::class, 'index'])->name('report.index');
Route::get('/report/export', [ReportController::class, 'export'])->name('report.export');



// Route::get('/sales-passwords', 'PasswordGenerationController@showSalesPasswords');
Route::get('/generate-sales-passwords', [PasswordGenerationController::class, 'generatePasswords']);
Route::get('/sales-passwords', [PasswordGenerationController::class, 'showSalesPasswords']);


Route::get('/update-sales-password', [UserController::class, 'showUpdatePasswordForm'] )->name('update.password.form');
Route::post('/update-sales-password', [UserController::class, 'updatePassword'] )->name('update.password');
// Route::post('/update-sales-password', )->name('update.password');






// Route::get('/sales-report', [SalesReportController::class, 'showSalesReport']);
Route::get('/sales-report', [SalesReportController::class, 'showSalesReport'])->name('sales-report');
Route::get('/sales-report-for-superadmin', [SalesReportController::class, 'showSalesReportBySuperadmin2'])->name('sales-report-superadmin');
// Route::get('/test-access', [SalesReportController::class, 'testAccess'])->name('test-access');
// showSalesReportBySuperadmin

#todo
Route::get('/sales-report/export', [SalesReportController::class, 'exportSalesReport'])->name('sales-report.export');

Route::get('test-push',[TestPushController::class,'testPush'])->name('test-push');


Route::middleware(['role:sales'])->group(function () {
    // Route yang hanya dapat diakses oleh peran sales
    Route::get('/sales/dashboard', 'SalesController@dashboard');
});

Route::middleware(['role:owner'])->group(function () {
    // Route yang hanya dapat diakses oleh peran owner
    Route::get('/owner/dashboard', 'OwnerController@dashboard');
});


// use Illuminate\Support\Facades\Route;

Route::get('/optimize', function () {
    $output = [];
    $status = 0;

    // Set the working directory to the Laravel project root
    chdir(base_path());

    // Run the php artisan optimize command
    exec('php artisan optimize', $output, $status);

    // Log the output (optional)
    \Illuminate\Support\Facades\Log::info('Artisan Optimize Output: ' . implode(PHP_EOL, $output));

    // Return a response based on the command status
    if ($status === 0) {
        return response('Artisan optimize command ran successfully. 
        The configuration cache has been cleared successfully, 
        and routes as well as files have been cached successfully.');
    } else {
        return response('Error running artisan optimize command.', 500);
    }
})->name('optimize');
