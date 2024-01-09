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




// use App\Http\Controllers\SuperAdminController;





Route::get('/', function () {
    return view('welcome');
});


Route::resource('shops', ShopController::class);
Route::resource('sales', SalesController::class);


Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);





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




Route::middleware(['role:sales'])->group(function () {
    // Route yang hanya dapat diakses oleh peran sales
    Route::get('/sales/dashboard', 'SalesController@dashboard');
});

Route::middleware(['role:owner'])->group(function () {
    // Route yang hanya dapat diakses oleh peran owner
    Route::get('/owner/dashboard', 'OwnerController@dashboard');
});




// <td>{{ \Carbon\Carbon::parse($visit->created_at)->format('D, d M Y H:i') }}</td>
// <a href="{{ route('visits.show', $visit->id) }}">View Details</a>
// <td><a href="{{ route('visits.create', $shop->id) }}">Visit</a></td>

// $visitedShops = DB::table('sales_visit')
//         ->join('shop', 'sales_visit.shop_id', '=', 'shop.id')            
//         ->where('sales_visit.sales_id', $userId)
//         ->select('sales_visit.*', 'shop.shop_name', 'shop.shop_address', 'shop.shop_region', 'shop.shop_city', 'shop.shop_district', 'shop.shop_subdistrict', 'shop.shop_googlemaps_coord', 'shop.shop_uuid')
//         ->get();



#todo entah kenapa kecamatan di database berubah jadi int


// <!DOCTYPE html>
// <html>
// <head>
//     <title>Ambil Foto</title>
// </head>
// <body>
//     <form action="/upload" method="post" enctype="multipart/form-data">
//         <input type="file" accept="image/*" capture="camera" name="photo">
//         <input type="submit" value="Upload">
//     </form>
// </body>
// </html>
