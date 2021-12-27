<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Product Category
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Products
    Route::post('products/media', 'ProductsApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductsApiController');

    // Product Tag
    Route::apiResource('product-tags', 'ProductTagApiController');

    // My Document
    Route::post('my-documents/media', 'MyDocumentApiController@storeMedia')->name('my-documents.storeMedia');
    Route::apiResource('my-documents', 'MyDocumentApiController');

    // User Alerts
    Route::post('user-alerts/media', 'UserAlertsApiController@storeMedia')->name('user-alerts.storeMedia');
    Route::apiResource('user-alerts', 'UserAlertsApiController');

    // Customer
    Route::apiResource('customers', 'CustomerApiController');

    // Orders
    Route::apiResource('orders', 'OrdersApiController');

    // Team
    Route::apiResource('teams', 'TeamApiController');

    // Commission
    Route::apiResource('commissions', 'CommissionApiController');
});
