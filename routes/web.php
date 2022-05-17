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

            // Add-ons products
            Route::delete('add-on-products/destroy', [\App\Http\Controllers\Admin\AddOnProductController::class, 'massDestroy'])->name('add-on-products.massDestroy');
            Route::post('add-on-products/media', [\App\Http\Controllers\Admin\AddOnProductController::class, 'storeMedia'])->name('add-on-products.storeMedia');
            Route::post('add-on-products/ckmedia', [\App\Http\Controllers\Admin\AddOnProductController::class, 'storeCKEditorImages'])->name('add-on-products.storeCKEditorImages');
            Route::resource('add-on-products', '\App\Http\Controllers\Admin\AddOnProductController');
        });

        /** DOCUMENT MANAGEMENT **/
        Route::group(['prefix' => 'document-management'], function() {
            // My Document
            Route::resource('my-documents', '\App\Http\Controllers\Admin\MyDocumentController');
            Route::delete('my-documents/destroy', [\App\Http\Controllers\Admin\MyDocumentController::class, 'massDestroy'])->name('my-documents.massDestroy');
            Route::post('my-documents/media', [\App\Http\Controllers\Admin\MyDocumentController::class, 'storeMedia'])->name('my-documents.storeMedia');
            Route::post('my-documents/ckmedia', [\App\Http\Controllers\Admin\MyDocumentController::class, 'storeCKEditorImages'])->name('my-documents.storeCKEditorImages');
        });

        /** MASTER SETTINGS **/
        Route::group(['prefix' => 'master-settings'], function() {
            // Manage Layouts
            Route::get('lot_layouts', [\App\Http\Controllers\Admin\LotLayoutController::class, 'lotLayouts'])->name('lot.layouts');
            Route::post('lot_layouts', [\App\Http\Controllers\Admin\LotLayoutController::class, 'lotLayoutStore'])->name('lot.layouts.store');
            Route::post('lot_layouts/{id}', [\App\Http\Controllers\Admin\LotLayoutController::class, 'lotLayoutUpdate'])->name('lot.layouts.update');
            Route::post('lot_layouts/destroy', [\App\Http\Controllers\Admin\LotLayoutController::class, 'lotLayoutDelete'])->name('lot.layouts.delete');

            // Manage Location
            Route::delete('locations/destroy', '\App\Http\Controllers\Admin\LocationController@massDestroy')->name('locations.massDestroy');
            Route::resource('locations', '\App\Http\Controllers\Admin\LocationController');

            // Manage Product Type
            Route::delete('product-types/destroy', '\App\Http\Controllers\Admin\ProductTypeController@massDestroy')->name('product-types.massDestroy');
            Route::resource('product-types', '\App\Http\Controllers\Admin\ProductTypeController');

            // Manage Building Type
            Route::delete('building-types/destroy', '\App\Http\Controllers\Admin\BuildingTypeController@massDestroy')->name('building-types.massDestroy');
            Route::resource('building-types', '\App\Http\Controllers\Admin\BuildingTypeController');

            // Manage Level
            Route::delete('levels/destroy', '\App\Http\Controllers\Admin\LevelController@massDestroy')->name('levels.massDestroy');
            Route::resource('levels', '\App\Http\Controllers\Admin\LevelController');

            // Manage Room
            Route::delete('rooms/destroy', '\App\Http\Controllers\Admin\RoomController@massDestroy')->name('rooms.massDestroy');
            Route::resource('rooms', '\App\Http\Controllers\Admin\RoomController');

            // Manage Section
            Route::delete('sections/destroy', '\App\Http\Controllers\Admin\BookingSectionController@massDestroy')->name('sections.massDestroy');
            Route::resource('sections', '\App\Http\Controllers\Admin\BookingSectionController');
        });

        /** ORDERS MANAGEMENT **/
        Route::group(['prefix' => 'order-management'], function() {

            // Locations
            Route::match(['get', 'post'], 'locations', [\App\Http\Controllers\Admin\ProductOrderController::class, 'location'])->name('showLocation');

            // Order Lists
            Route::delete('orders/destroy', [\App\Http\Controllers\Admin\OrdersController::class,'massDestroy'])->name('orders.massDestroy');
            Route::resource('orders', '\App\Http\Controllers\Admin\OrdersController');

            // Calculate Pay Later
            Route::match(['get', 'post'], 'orders/showCalculator/{order}', [\App\Http\Controllers\Admin\OrdersController::class,'showCalculator'])->name('orders.showCalculator');
            Route::match(['get', 'post'], 'orders/calculatePayLater/{order}', [\App\Http\Controllers\Admin\OrdersController::class,'calculatePayLater'])->name('orders.calculatePayLater');

            // Transactions
            Route::match(['get', 'post'], 'transactions/store/{order}', [\App\Http\Controllers\Admin\TransactionController::class, 'store'])->name('transaction.store');
            Route::match(['get', 'post'], 'transactions/index/{order}', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transaction.index');
            Route::match(['get', 'post'], 'transactions/show/{transaction}', [\App\Http\Controllers\Admin\TransactionController::class, 'show'])->name('transaction.show');
            Route::match(['get', 'post'], 'transactions/update/{order}', [\App\Http\Controllers\Admin\TransactionController::class, 'update'])->name('transaction.update');

            // New Order
            Route::resource('new-order', '\App\Http\Controllers\Admin\ProductOrderController');
            Route::get('/{category:name}/{childCategory:name?}/{childCategory2?}', [\App\Http\Controllers\Admin\ProductOrderController::class, 'category'])->name('category');
            Route::get('/{category}/{childCategory}/{childCategory2}/{product}', [\App\Http\Controllers\Admin\ProductOrderController::class, 'productCategory'])->name('product');

            // Customer Details
            Route::resource('/{category}/{childCategory}/{childCategory2}/{product}/customer-details', '\App\Http\Controllers\Admin\CustomerDetailsController');

            // Booking
            Route::resource('/{category}/{childCategory}/{childCategory2}/{product}/product-booking', '\App\Http\Controllers\Admin\ProductBookingController');
            Route::match(['get', 'post'], '/{category}/{childCategory}/{childCategory2}/{product}/review-order', [\App\Http\Controllers\Admin\ProductBookingController::class, 'reviewOrder'])->name('reviewOrder');

            // Order Summary
            Route::match(['get', 'post'], '/{category}/{childCategory}/{childCategory2}/{product}/order-details', [\App\Http\Controllers\Admin\OrderConfirmationController::class, 'orderPage'])->name('order');
            Route::match(['get', 'post'], '/{category}/{childCategory}/{childCategory2}/{product}/order-details/store', [\App\Http\Controllers\Admin\OrderConfirmationController::class, 'store'])->name('order.details.store');

            // Installment Calculator
            Route::resource('/{category}/{childCategory}/{childCategory2}/{product}/installment', '\App\Http\Controllers\Admin\InstallmentController');

            // Carts
            Route::get('cart', [\App\Http\Controllers\Admin\CartController::class, 'cartList'])->name('cart.list');
            Route::post('cart', [\App\Http\Controllers\Admin\CartController::class, 'addToCart'])->name('cart.store');
            Route::post('update-cart', [\App\Http\Controllers\Admin\CartController::class, 'updateCart'])->name('cart.update');
            Route::post('remove', [\App\Http\Controllers\Admin\CartController::class, 'removeCart'])->name('cart.remove');
            Route::post('clear', [\App\Http\Controllers\Admin\CartController::class, 'clearAllCart'])->name('cart.clear');

            // addons page
            Route::match(['get', 'post'], '/{category}/{childCategory}/{childCategory2}/{product}/addons', [\App\Http\Controllers\Admin\ProductOrderController::class, 'addOns'])->name('addons');

            // Pay Later
            Route::match(['get', 'post'], '/{category}/{childCategory}/{childCategory2}/{product}/order-details', [\App\Http\Controllers\Admin\InstallmentController::class, 'payLater'])->name('order.payLater');

        });

        /** CUSTOMER MANAGEMENT **/
        Route::group(['prefix' => 'customer-management'], function() {
            // All Customers
            Route::delete('customers/destroy', [\App\Http\Controllers\Admin\CustomerController::class,'massDestroy'])->name('customers.massDestroy');
            Route::resource('customers', '\App\Http\Controllers\Admin\CustomerController');
            Route::match(['get', 'post'], 'customers/showInvoice/{order}', [\App\Http\Controllers\Admin\CustomerController::class, 'showInvoice'])->name('customers.showInvoice');

            // All Intended Users
            Route::delete('contact-people/destroy', [\App\Http\Controllers\Admin\IntendedUserController::class,'massDestroy'])->name('contact-people.massDestroy');
            Route::resource('contact-people', '\App\Http\Controllers\Admin\IntendedUserController');
        });

        /** REPORT MANAGEMENT **/
        Route::group(['prefix' => 'report-management'], function() {
            // AR Invoices
            Route::match(['get', 'post'], 'invoices/index', [\App\Http\Controllers\Admin\InvoiceController::class,'index'])->name('invoices.index');

            // AR Payments
            Route::resource('payments', '\App\Http\Controllers\Admin\PaymentController');
        });

        // Commission
        Route::delete('commissions/destroy', [\App\Http\Controllers\Admin\CommissionController::class, 'massDestroy'])->name('commissions.massDestroy');
        Route::match(['get', 'post'], 'commissions/index', [\App\Http\Controllers\Admin\CommissionController::class,'index'])->name('commissions.index');
        Route::match(['get', 'post'], 'commissions/show/{order}', [\App\Http\Controllers\Admin\CommissionController::class,'show'])->name('commissions.show');
        Route::match(['get', 'post'], 'commissions/edit/{order}', [\App\Http\Controllers\Admin\CommissionController::class,'edit'])->name('commissions.edit');
        Route::match(['get', 'post'], 'commissions/store/{order}', [\App\Http\Controllers\Admin\CommissionController::class,'store'])->name('commissions.store');

        // Commission Calculator
        Route::match(['get', 'post'], 'commissions/calculator/{order}', [\App\Http\Controllers\Admin\CommissionController::class,'commissionCalculator'])->name('commissions.calculator');
        Route::match(['get', 'post'], 'commissions/calculator/store/{order}', [\App\Http\Controllers\Admin\CommissionController::class,'commissionStore'])->name('commissions.calculatorStore');

        // Audit Logs
        Route::resource('audit-logs', '\App\Http\Controllers\Admin\AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);
    });


    /*
    |--------------------------------------------------------------------------
    | USER SITES
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'user', 'as' => 'user.'], function() {

        /** MY DOWNLINE **/
        Route::group(['prefix' => 'downline'], function() {
            Route::get('/my-tree', [\App\Http\Controllers\User\MembersController::class, 'myTree'])->name('myTree');
            Route::get('/my-downline', [\App\Http\Controllers\User\MembersController::class, 'myDownline'])->name('myDownline');
            Route::resource('/my-downline', '\App\Http\Controllers\User\MembersController');
        });

        /** MY DOCUMENT **/
        Route::group(['prefix' => 'document'], function() {
            Route::resource('my-documents', '\App\Http\Controllers\User\MyDocumentController');
            Route::delete('my-documents/destroy', [\App\Http\Controllers\User\MyDocumentController::class, 'massDestroy'])->name('my-documents.massDestroy');
            Route::post('my-documents/media', [\App\Http\Controllers\User\MyDocumentController::class, 'storeMedia'])->name('my-documents.storeMedia');
            Route::post('my-documents/ckmedia', [\App\Http\Controllers\User\MyDocumentController::class, 'storeCKEditorImages'])->name('my-documents.storeCKEditorImages');
        });

        // My Commissions
        Route::get('/my-commission', [\App\Http\Controllers\User\MembersController::class, 'myCommission'])->name('myCommission');

        // My Customers
        Route::get('/my-customers', [\App\Http\Controllers\User\MembersController::class, 'myCustomers'])->name('myCustomers');


        // My Orders
        Route::resource('/my-orders', '\App\Http\Controllers\User\OrderDetailsController');
    });

});
