<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return redirect(\route('dashboard'));
});

Route::get('privacy-policy', function () {
    return view('privacy_policy');
});

\Illuminate\Support\Facades\Auth::routes();

Route::get('/activated/{user}', 'HomeController@activated')->name('activated')->middleware('signed');
Route::post('/image/upload', 'ImageController@storeWeb')->name('image.web.store');

// Route::get('/home', 'HomeController@index')->name('home');
Route::post('language', 'LanguageController@changeLanguage')->name('language');


// Manager
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'log']], function () {
    // Manager dashboard
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('', 'Admin\DashboardController@dashboard')->name('dashboard')->middleware(['can:dashboard']);
    });

    // Manager Permission
    Route::group(['prefix' => 'role'], function () {
        Route::get('list', 'Admin\PermissionController@listRole')->name('role.listRole')->middleware(['can:view-permission']);
        Route::get('detail/{id?}', 'Admin\PermissionController@getPermission')->name('role.getPermission')->middleware(['can:view-permission']);
        Route::post('detail/{id?}', 'Admin\PermissionController@postPermission')->name('role.postPermission')->middleware(['can:view-permission']);
        Route::get('add', 'Admin\PermissionController@getCreateRole')->name('role.getCreateRole')->middleware(['can:create-permission']);
        Route::post('add', 'Admin\PermissionController@postCreateRole')->name('role.postCreateRole')->middleware(['can:create-permission']);
        Route::get('edit/{id?}', 'Admin\PermissionController@getUpdateRole')->name('role.getUpdateRole')->middleware(['can:edit-permission']);
        Route::post('edit/{id?}', 'Admin\PermissionController@postUpdateRole')->name('role.postUpdateRole')->middleware(['can:edit-permission']);
        Route::get('delete/{id?}', 'Admin\PermissionController@delete')->name('role.deleteRole')->middleware(['can:delete-permission']);
        Route::get('add-user/{id?}', 'Admin\PermissionController@addRoleForUser')->name('role.addRoleForUser')->middleware(['can:create-permission']);
        Route::post('add-user/{id?}', 'Admin\PermissionController@postAddRoleForUser')->name('role.postAddRoleForUser')->middleware(['can:create-permission']);
    });

    // Manager User
    Route::group(['prefix' => 'user'], function () {
        Route::get('', 'Admin\UserController@getList')->name('user.list')->middleware(['can:view-user']);
        Route::get('add', 'Admin\UserController@create')->name('user.add')->middleware(['can:create-user']);
        Route::post('add', 'Admin\UserController@store')->name('user.store')->middleware(['can:create-user']);
        Route::get('edit/{id?}', 'Admin\UserController@edit')->name('user.edit')->middleware(['can:edit-user']);
        Route::post('edit/{id?}', 'Admin\UserController@update')->name('user.update')->middleware(['can:edit-user']);
        Route::get('delete/{id?}', 'Admin\UserController@delete')->name('user.delete')->middleware(['can:delete-user']);
        Route::get('detail/{id?}', 'Admin\UserController@detail')->name('user.detail')->middleware(['can:view-user']);
        Route::get('profile', 'Admin\UserController@profile')->name('user.profile');
        Route::put('profile', 'Admin\UserController@updateProfile')->name('user.profile');
        Route::post('password', 'Admin\UserController@password')->name('user.password');
        Route::post('ajaxBaned/{id?}', 'Admin\UserController@ajaxBaned')->name('user.ajaxBaned')->middleware(['can:edit-user']);
        Route::get('delete-force/{id?}', 'Admin\UserController@deleteForce')->name('user.deleteForce')->middleware(['can:edit-user']);
    });

    // Manager Car
    Route::group(['prefix' => 'car'], function () {
        Route::get('', 'Admin\CarController@getList')->name('car.list')->middleware(['can:view-car']);
        Route::get('add', 'Admin\CarController@create')->name('car.add')->middleware(['can:create-car']);
        Route::post('add', 'Admin\CarController@store')->name('car.store')->middleware(['can:create-car']);
        Route::get('edit/{id?}', 'Admin\CarController@edit')->name('car.edit')->middleware(['can:edit-car']);
        Route::post('edit/{id?}', 'Admin\CarController@update')->name('car.update')->middleware(['can:edit-car']);
        Route::get('delete/{id?}', 'Admin\CarController@delete')->name('car.delete')->middleware(['can:delete-car']);
        Route::get('detail/{id?}', 'Admin\CarController@detail')->name('car.detail')->middleware(['can:view-car']);
        Route::get('ajax', 'Admin\CarController@ajax')->name('car.ajax')->middleware(['can:view-car']);
    });

    // Manager Price
    Route::group(['prefix' => 'price'], function () {
        Route::get('', 'Admin\ManagerPriceController@getList')->name('price.list')->middleware(['can:view-price']);
        Route::get('add/{type?}', 'Admin\ManagerPriceController@create')->name('price.add')->middleware(['can:create-price'])->where('type', '[1-3]');
        Route::post('add/{type?}', 'Admin\ManagerPriceController@store')->name('price.store')->middleware(['can:create-price'])->where('type', '[1-3]');
        Route::get('detail/{id?}', 'Admin\ManagerPriceController@detail')->name('price.detail')->middleware(['can:view-price']);
        Route::get('delete/{id?}', 'Admin\ManagerPriceController@delete')->name('price.delete')->middleware(['can:delete-price']);
        Route::get('ajax', 'Admin\ManagerPriceController@ajax')->name('price.ajax')->middleware(['can:view-price']);
    });

    // Manager Warehouse
    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('', 'Admin\WarehouseController@getList')->name('warehouse.list')->middleware(['can:view-warehouse']);
        Route::get('add', 'Admin\WarehouseController@create')->name('warehouse.add')->middleware(['can:create-warehouse']);
        Route::post('add', 'Admin\WarehouseController@store')->name('warehouse.store')->middleware(['can:create-warehouse']);
        Route::get('edit/{id?}', 'Admin\WarehouseController@edit')->name('warehouse.edit')->middleware(['can:edit-warehouse']);
        Route::post('edit/{id?}', 'Admin\WarehouseController@update')->name('warehouse.update')->middleware(['can:edit-warehouse']);
        Route::get('delete/{id?}', 'Admin\WarehouseController@delete')->name('warehouse.delete')->middleware(['can:delete-warehouse']);
        Route::get('detail/{id?}', 'Admin\WarehouseController@detail')->name('warehouse.detail')->middleware(['can:view-warehouse']);
        Route::get('ajax', 'Admin\WarehouseController@ajax')->name('warehouse.ajax')->middleware(['can:view-warehouse']);
    });

    // Manager Driver
    Route::group(['prefix' => 'driver'], function () {
        Route::get('', 'Admin\DriverController@getList')->name('driver.list')->middleware(['can:view-driver']);
        Route::get('add', 'Admin\DriverController@create')->name('driver.add')->middleware(['can:create-driver']);
        Route::post('add', 'Admin\DriverController@store')->name('driver.store')->middleware(['can:create-driver']);
        Route::get('edit/{id?}', 'Admin\DriverController@edit')->name('driver.edit')->middleware(['can:edit-driver']);
        Route::post('edit/{id?}', 'Admin\DriverController@update')->name('driver.update')->middleware(['can:edit-driver']);
        Route::get('delete/{id?}', 'Admin\DriverController@delete')->name('driver.delete')->middleware(['can:delete-driver']);
        Route::get('detail/{id?}', 'Admin\DriverController@detail')->name('driver.detail')->middleware(['can:view-driver']);
        Route::get('ajaxSelect2', 'Admin\DriverController@ajaxSelect2')->name('driver.ajaxSelect2')->middleware(['can:view-driver']);
    });

    // Manager Other
    Route::group(['prefix' => 'other'], function () {
        Route::get('/{id?}', 'Admin\OtherController@getList')->name('other.list')->middleware(['can:view-other']);
        Route::post('action/{id?}', 'Admin\OtherController@action')->name('other.action')->middleware(['can:create-other']);
        Route::get('delete/{id?}', 'Admin\OtherController@delete')->name('other.delete')->middleware(['can:delete-other']);
    });

    // Statistic
    Route::group(['prefix' => 'data'], function () {
        Route::get('district/{province_id?}', 'Admin\DistrictController@district')->name('district.index')->middleware(['can:data']);
        Route::post('district/{id?}', 'Admin\DistrictController@action')->name('district.action')->middleware(['can:data']);
        Route::post('district2/{id?}', 'Admin\DistrictController@action2')->name('district.action2')->middleware(['can:data']);
        Route::get('', 'Admin\ProvinceController@index')->name('province.index')->middleware(['can:data']);
        Route::post('/{province_id?}', 'Admin\ProvinceController@action')->name('province.action')->middleware(['can:data']);
    });

    // Manager Delivery
    Route::group(['prefix' => 'delivery'], function () {
        Route::get('', 'Admin\DeliveryController@getList')->name('delivery.list')->middleware(['can:view-delivery']);
        Route::post('', 'Admin\DeliveryController@getListDelivery')->name('delivery.post.list')->middleware(['can:view-delivery']);
        Route::get('create', 'Admin\DeliveryController@create')->name('delivery.create')->middleware(['can:create-delivery']);
        Route::post('create', 'Admin\DeliveryController@createDelivery')->name('delivery.createDelivery')->middleware(['can:create-delivery']);
        Route::post('store/{id?}', 'Admin\DeliveryController@store')->name('delivery.store')->middleware(['can:create-delivery']);
        Route::post('storeDriver/{id?}', 'Admin\DeliveryController@storeDriver')->name('delivery.storeDriver')->middleware(['can:create-delivery']);
        Route::get('delete/{id?}', 'Admin\DeliveryController@delete')->name('delivery.delete')->middleware(['can:delete-delivery']);
    });

    // Manager Customer
    Route::group(['prefix' => 'customer'], function () {
        Route::get('', 'Admin\CustomerController@getList')->name('customer.list')->middleware(['can:view-customer']);
        Route::post('', 'Admin\CustomerController@getListCustomer')->name('customer.post.list')->middleware(['can:view-customer']);
        Route::get('detail/{id?}', 'Admin\CustomerController@detail')->name('customer.detail')->middleware(['can:view-customer-detail']);
        Route::post('debt/{id?}', 'Admin\CustomerController@exportDebt')->name('customer.exportDebt')->middleware(['can:view-customer']);
        Route::get('activated/{id?}', 'Admin\CustomerController@activated')->name('customer.activated')->middleware(['can:view-customer']);
        Route::get('ajaxSelect2', 'Admin\CustomerController@ajaxSelect2')->name('customer.ajaxSelect2')->middleware(['can:view-customer']);
    });

    Route::group(['prefix' => 'dept'], function () {
        Route::get('', 'Admin\DeptController@getList')->name('dept.list')->middleware(['can:view-dept']);
        Route::post('', 'Admin\DeptController@getListDept')->name('dept.post.list')->middleware(['can:view-dept']);
        Route::post('export', 'Admin\DeptController@export')->name('dept.export')->middleware(['can:export-dept']);
    });

    // Manager Evaluate
    Route::group(['prefix' => 'evaluate'], function () {
        Route::get('', 'Admin\EvaluateController@getList')->name('evaluate.list')->middleware(['can:view-evaluate']);
        Route::post('', 'Admin\EvaluateController@getListEvaluate')->name('evaluate.post.list')->middleware(['can:view-evaluate']);
        Route::get('detail/{id?}', 'Admin\EvaluateController@detail')->name('evaluate.detail')->middleware(['can:view-evaluate']);
    });

    // Manager Customer Order
    Route::group(['prefix' => 'order'], function () {
        Route::get('', 'Admin\OrderController@getList')->name('order.list')->middleware(['can:view-order']);
        Route::get('list-new', 'Admin\OrderController@getListNew')->name('order.list.new')->middleware(['can:view-order']);
        //search
        Route::post('option-list-new', 'Admin\OrderController@postOptionListNew')->name('order.option.list.new');
        Route::get('option-list-new', 'Admin\OrderController@getOptionListNew')->name('order.option.list.new');
        Route::post('search-list-new', 'Admin\OrderController@postSearchListNew')->name('order.post.search.list.new');
        Route::get('search-list-new', 'Admin\OrderController@getSearchListNew')->name('order.post.search.list.new');

        Route::post('', 'Admin\OrderController@getListOrder')->name('order.post.list')->middleware(['can:view-order']);
        Route::get('add', 'Admin\OrderController@create')->name('order.add')->middleware(['can:create-order']);
        Route::post('add', 'Admin\OrderController@store')->name('order.store')->middleware(['can:create-order']);
        Route::get('detail/{id?}', 'Admin\OrderController@detail')->name('order.detail')->middleware(['can:view-order-detail']);
        Route::post('update/{id?}', 'Admin\OrderController@update')->name('order.update')->middleware(['can:view-order-detail']);
        Route::get('update/{id?}/{status?}', 'Admin\OrderController@updateStatus')->name('order.updateStatus')->middleware(['can:view-order-detail']);
        Route::get('ajaxSelect2', 'Admin\OrderController@ajaxSelect2')->name('order.ajaxSelect2')->middleware(['can:view-order']);
        Route::post('ajaxPrice/{id?}', 'Admin\OrderController@ajaxPrice')->name('order.ajaxPrice')->middleware(['can:edit-order']);
        Route::post('warehouse', 'Admin\OrderController@warehouse')->name('order.warehouse')->middleware(['can:edit-order']);
        Route::get('district/{province_id?}', 'Admin\OrderController@district')->name('order.district')->middleware(['can:create-order']);
        Route::post('payment/{id?}', 'Admin\OrderController@payment')->name('order.payment')->middleware(['can:edit-order']);
        Route::post('coupon/{id?}', 'Admin\OrderController@couponCode')->name('order.coupon_code')->middleware(['can:edit-order']);
        Route::post('admin-note/{id?}', 'Admin\OrderController@adminNote')->name('order.admin_note')->middleware(['can:edit-order']);
        Route::post('calculatePayment', 'Admin\OrderController@calculatePayment')->name('calculatePayment');
        Route::post('order-change-payment', 'Admin\OrderController@changePayment')->name('order-change-payment');
        Route::get('order-delete/{id}', 'Admin\OrderController@deleteOrder');

    });

    // Map
    Route::group(['prefix' => 'map'], function () {
        Route::get('street', 'Admin\MapController@showStreet')->name('map.street')->middleware(['can:map']);
        Route::post('street', 'Admin\MapController@postStreet')->name('post.street')->middleware(['can:map']);
        Route::get('driver', 'Admin\MapController@showDriver')->name('map.driver')->middleware(['can:map']);
        Route::post('driver', 'Admin\MapController@postDriver')->name('post.driver')->middleware(['can:map']);
    });

    // Statistic
    Route::group(['prefix' => 'statistic'], function () {
        Route::get('statistic', 'Admin\StatisticController@index')->name('statistic.index')->middleware(['can:statistic']);
        Route::post('statistic', 'Admin\StatisticController@statistic')->name('statistic.index')->middleware(['can:statistic']);
        Route::post('export', 'Admin\StatisticController@export')->name('statistic.export')->middleware(['can:statistic']);
        Route::get('driver', 'Admin\StatisticController@showDriver')->name('statistic.driver')->middleware(['can:statistic']);
        Route::post('driver', 'Admin\StatisticController@postDriver')->name('statistic.driver')->middleware(['can:statistic']);
    });

    // Manager Finance
    Route::group(['prefix' => 'finance'], function () {
        Route::get('', 'Admin\FinanceController@index')->name('finance.list')->middleware(['can:view-finance']);
        Route::post('', 'Admin\FinanceController@getList')->name('finance.getList')->middleware(['can:view-finance']);
        Route::get('detail', 'Admin\FinanceController@detail')->name('finance.detail')->middleware(['can:view-finance']);
        Route::get('add/{type?}', 'Admin\FinanceController@create')->name('finance.add')->middleware(['can:create-finance']);
        Route::post('add/{type?}', 'Admin\FinanceController@store')->name('finance.store')->middleware(['can:create-finance']);
        Route::get('edit/{type?}/{id?}', 'Admin\FinanceController@edit')->name('finance.edit')->middleware(['can:edit-finance']);
        Route::post('edit/{type?}/{id?}', 'Admin\FinanceController@update')->name('finance.update')->middleware(['can:edit-finance']);
    });

    // Manager Chat
    Route::group(['prefix' => 'chat'], function () {
        Route::get('/{id?}', 'Admin\ChatController@index')->name('chat.list')->middleware(['can:view-chat']);
        Route::post('', 'Admin\ChatController@getList')->name('chat.getList')->middleware(['can:view-chat']);
    });

    // Manager Log
    Route::group(['prefix' => 'log'], function () {
        Route::get('', 'Admin\LogController@index')->name('log.list')->middleware(['can:view-log']);
        Route::post('', 'Admin\LogController@getList')->name('log.getList')->middleware(['can:view-log']);
    });

    //Company
    Route::group(['prefix' => 'company'], function () {
        Route::get('', 'Admin\CompanyController@getList')->name('company.list')->middleware(['can:view-company']);
        Route::post('', 'Admin\CompanyController@postList')->name('company.post.list')->middleware(['can:view-company']);
        Route::get('add', 'Admin\CompanyController@create')->name('company.add')->middleware(['can:create-company']);
        Route::post('add', 'Admin\CompanyController@store')->name('company.store')->middleware(['can:create-company']);
        Route::get('edit/{id?}', 'Admin\CompanyController@edit')->name('company.edit')->middleware(['can:edit-company']);
        Route::post('edit/{id?}', 'Admin\CompanyController@update')->name('company.update')->middleware(['can:edit-company']);
        Route::get('detail/{id?}', 'Admin\CompanyController@detail')->name('company.detail')->middleware(['can:view-company-detail']);
        Route::delete('{id?}', 'Admin\CompanyController@delete')->name('company.delete')->middleware(['can:delete-customer']);
        Route::post('export', 'Admin\CompanyController@export')->name('company.export')->middleware(['can:view-company']);
    });

    //Company
    Route::group(['prefix' => 'collection'], function () {
        Route::get('', 'Admin\CollectionOfDebtController@getList')->name('collection.list')->middleware(['can:view-collection']);
        Route::post('', 'Admin\CollectionOfDebtController@postList')->name('collection.post.list')->middleware(['can:view-collection']);
        Route::get('add', 'Admin\CollectionOfDebtController@create')->name('collection.add')->middleware(['can:create-collection']);
        Route::post('add', 'Admin\CollectionOfDebtController@store')->name('collection.store')->middleware(['can:create-collection']);
        Route::get('edit/{id?}', 'Admin\CollectionOfDebtController@edit')->name('collection.edit')->middleware(['can:edit-collection']);
        Route::post('edit/{id?}', 'Admin\CollectionOfDebtController@update')->name('collection.update')->middleware(['can:edit-collection']);
        Route::get('detail/{id?}', 'Admin\CollectionOfDebtController@detail')->name('collection.detail')->middleware(['can:view-collection-detail']);
        Route::delete('{id?}', 'Admin\CollectionOfDebtController@delete')->name('collection.delete')->middleware(['can:delete-collection']);
    });
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
// Clear Cache
Route::get('cache', function () {
    $exitCode = \Illuminate\Support\Facades\Artisan::call('cache:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('view:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:clear');
    $exitCode = \Illuminate\Support\Facades\Artisan::call('config:cache');
    return redirect(\route('dashboard'));
});

Route::get('price', 'Admin\ManagerPriceController@show')->name('price.show');
Route::get('security', 'Admin\ManagerPriceController@security')->name('security.show');
