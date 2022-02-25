<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('home.index')->with('status', session('status'));
    }

    return redirect()->route('home.index');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['middleware' => 'auth'], function() {
    /*
    |--------------------------------------------------------------------------
    | ALL AUTHENTICATIONS
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'home', 'as' => 'home.'], function() {
        Route::get('/', 'HomeController@index')->name('index');
        Route::get('/help', 'HomeController@help')->name('help');
    });

    // Profile Updated
    Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth'], function () {
        if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
            Route::get('password/edit', 'ChangePasswordController@edit')->name('password.edit');
            Route::post('password/update', 'ChangePasswordController@update')->name('password.update');
            Route::get('my-profile', 'ChangePasswordController@profile')->name('index');
            Route::post('my-profile/update', 'ChangePasswordController@updateProfile')->name('updateProfile');
            Route::post('my-profile/update-image', 'ChangePasswordController@updateProfileImage')->name('updateProfileImage');
            Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        }
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN SITES
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['can:admin_only']], function () {
        /** USERS MANAGEMENT **/
        Route::group(['prefix' => 'user-management'], function() {
            // Permissions
            Route::resource('permissions', '\App\Http\Controllers\Admin\PermissionsController');
            Route::delete('permissions/destroy', [\App\Http\Controllers\Admin\PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');

            // Roles
            Route::resource('roles', '\App\Http\Controllers\Admin\RolesController');
            Route::delete('roles/destroy', [\App\Http\Controllers\Admin\RolesController::class, 'massDestroy'])->name('roles.massDestroy');

            // Users
            Route::resource('users', '\App\Http\Controllers\Admin\UsersController');
            Route::delete('users/destroy', [\App\Http\Controllers\Admin\UsersController::class, 'massDestroy'])->name('users.massDestroy');
            // Route::get('users/{id}/hierarchy', [\App\Http\Controllers\Admin\UsersController::class, 'hierarchy'])->name('users.hierarchy');

            // Team
            Route::delete('teams/destroy', [\App\Http\Controllers\Admin\TeamController::class, 'massDestroy'])->name('teams.massDestroy');
            Route::resource('teams', '\App\Http\Controllers\Admin\TeamController');

            // User Alerts
            Route::delete('user-alerts/destroy', [\App\Http\Controllers\Admin\UserAlertsController::class, 'massDestroy'])->name('user-alerts.massDestroy');
            Route::post('user-alerts/media', [\App\Http\Controllers\Admin\UserAlertsController::class, 'storeMedia'])->name('user-alerts.storeMedia');
            Route::post('user-alerts/ckmedia', [\App\Http\Controllers\Admin\UserAlertsController::class, 'storeCKEditorImages'])->name('user-alerts.storeCKEditorImages');
            Route::get('user-alerts/read', [\App\Http\Controllers\Admin\UserAlertsController::class, 'read']);
            Route::resource('user-alerts', '\App\Http\Controllers\Admin\UserAlertsController');
        });

        /** PRODUCT MANAGEMENT **/
        Route::group(['prefix' => 'product-management'], function() {
            // Categories
            Route::resource('product-categories', '\App\Http\Controllers\Admin\ProductCategoryController');
            Route::delete('product-categories/destroy', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'massDestroy'])->name('product-categories.massDestroy');
            Route::post('product-categories/media', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'storeMedia'])->name('product-categories.storeMedia');
            Route::post('product-categories/ckmedia', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'storeCKEditorImages'])->name('product-categories.storeCKEditorImages');
            Route::get('product-categories/check-slug', [\App\Http\Controllers\Admin\ProductCategoryController::class, 'checkSlug'])->name('product-categories.checkSlug');

            // Products
            Route::resource('products', '\App\Http\Controllers\Admin\ProductsController');
            Route::delete('products/destroy', [\App\Http\Controllers\Admin\ProductsController::class, 'massDestroy'])->name('products.massDestroy');
            Route::post('products/media', [\App\Http\Controllers\Admin\ProductsController::class, 'storeMedia'])->name('products.storeMedia');
            Route::post('products/ckmedia', [\App\Http\Controllers\Admin\ProductsController::class, 'storeCKEditorImages'])->name('products.storeCKEditorImages');
            Route::get('products/check-slug', [\App\Http\Controllers\Admin\ProductsController::class, 'checkSlug'])->name('products.checkSlug');
            Route::get('importExportView', [\App\Http\Controllers\Admin\ProductsController::class, 'importExportView'])->name('products.importExportView');
            Route::get('export', [\App\Http\Controllers\Admin\ProductsController::class, 'export'])->name('products.export');
            Route::post('import', [\App\Http\Controllers\Admin\ProductsController::class, 'import'])->name('products.import');

            // Tags
            Route::resource('product-tags', '\App\Http\Controllers\Admin\ProductTagController');
            Route::delete('product-tags/destroy', [\App\Http\Controllers\Admin\ProductTagController::class, 'massDestroy'])->name('product-tags.massDestroy');
        });

        /** DOCUMENT MANAGEMENT **/
        Route::group(['prefix' => 'document-management'], function() {
            // My Document
            Route::resource('my-documents', '\App\Http\Controllers\Admin\MyDocumentController');
            Route::delete('my-documents/destroy', [\App\Http\Controllers\Admin\MyDocumentController::class, 'massDestroy'])->name('my-documents.massDestroy');
            Route::post('my-documents/media', [\App\Http\Controllers\Admin\MyDocumentController::class, 'storeMedia'])->name('my-documents.storeMedia');
            Route::post('my-documents/ckmedia', [\App\Http\Controllers\Admin\MyDocumentController::class, 'storeCKEditorImages'])->name('my-documents.storeCKEditorImages');
        });

        // Customer
        Route::delete('customers/destroy', [\App\Http\Controllers\Admin\CustomerController::class,'massDestroy'])->name('customers.massDestroy');
        Route::resource('customers', '\App\Http\Controllers\Admin\CustomerController');

        // Commission
        Route::delete('commissions/destroy', [\App\Http\Controllers\Admin\CommissionController::class, 'massDestroy'])->name('commissions.massDestroy');
        Route::resource('commissions', '\App\Http\Controllers\Admin\CommissionController');

        /** ORDERS **/
        Route::group(['prefix' => 'order-management'], function() {
            Route::delete('orders/destroy', [\App\Http\Controllers\Admin\OrdersController::class,'massDestroy'])->name('orders.massDestroy');
            Route::resource('orders', '\App\Http\Controllers\Admin\OrdersController');
            Route::resource('new-order', '\App\Http\Controllers\User\ProductsController');
            Route::get('/{category:name}/{childCategory:name?}/{childCategory2?}', [\App\Http\Controllers\User\ProductsController::class, 'category'])->name('category');
            Route::get('/{category}/{childCategory}/{childCategory2}/{product}', [\App\Http\Controllers\User\ProductsController::class, 'productCategory'])->name('product');
            Route::match(['get', 'post'], '/{category}/{childCategory}/{childCategory2}/{product}/booking', [\App\Http\Controllers\User\ProductsController::class, 'bookingLot'])->name('bookinglot');

            // Customers
            Route::resource('/{category}/{childCategory}/{childCategory2}/{product}/customerdetails', '\App\Http\Controllers\User\CustomerController');

            // Orders
            Route::match(['get', 'post'], '/{category}/{childCategory}/{childCategory2}/{product}/order-details', [\App\Http\Controllers\User\OrderController::class, 'orderPage'])->name('order');
            Route::match(['get', 'post'], '/{category}/{childCategory}/{childCategory2}/{product}/order-details/store', [\App\Http\Controllers\User\OrderController::class, 'store'])->name('order.details.store');
        });

        // Audit Logs
        Route::resource('audit-logs', '\App\Http\Controllers\Admin\AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    });


    /*
    |--------------------------------------------------------------------------
    | USER SITES
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {
        // Products
        Route::group(['prefix' => 'products'], function() {
            Route::resource('products', '\App\Http\Controllers\User\ProductsController');
            Route::get('/{category:name}/{childCategory:name?}/{childCategory2?}', [\App\Http\Controllers\User\ProductsController::class, 'category'])->name('category');
            Route::get('/{category}/{childCategory}/{childCategory2}/{product}', [\App\Http\Controllers\User\ProductsController::class, 'productCategory'])->name('product');
            Route::get('/{category}/{childCategory}/{childCategory2}/{product}/booking', [\App\Http\Controllers\User\ProductsController::class, 'bookingLot'])->name('bookinglot');

            // Customers
            Route::resource('/{category}/{childCategory}/{childCategory2}/{product}/customerdetails', '\App\Http\Controllers\User\CustomerController');

            // Orders
            Route::match(['get', 'post'], '/{category}/{childCategory}/{childCategory2}/{product}/order-details', [\App\Http\Controllers\User\OrderController::class, 'orderPage'])->name('order');
            Route::match(['get', 'post'], '/{category}/{childCategory}/{childCategory2}/{product}/order-details/store', [\App\Http\Controllers\User\OrderController::class, 'store'])->name('order.details.store');
        });

        // Downline
        Route::group(['prefix' => 'downline'], function() {
            Route::get('/my-tree', [\App\Http\Controllers\User\MembersController::class, 'myTree'])->name('myTree');
            Route::get('/my-downline', [\App\Http\Controllers\User\MembersController::class, 'myDownline'])->name('myDownline');
            Route::resource('/my-downline', '\App\Http\Controllers\User\MembersController');
        });

        // Report
        Route::group(['prefix' => 'report'], function() {
            Route::get('/my-commission', [\App\Http\Controllers\User\MembersController::class, 'myCommission'])->name('myCommission');
        });

        Route::group(['prefix' => 'document'], function() {
            Route::resource('my-documents', '\App\Http\Controllers\User\MyDocumentController');
            Route::delete('my-documents/destroy', [\App\Http\Controllers\User\MyDocumentController::class, 'massDestroy'])->name('my-documents.massDestroy');
            Route::post('my-documents/media', [\App\Http\Controllers\User\MyDocumentController::class, 'storeMedia'])->name('my-documents.storeMedia');
            Route::post('my-documents/ckmedia', [\App\Http\Controllers\User\MyDocumentController::class, 'storeCKEditorImages'])->name('my-documents.storeCKEditorImages');
        });

        Route::resource('/my-orders', '\App\Http\Controllers\User\OrderDetailsController');
    });

});
