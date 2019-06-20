<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Order;
use App\Observers\CustomerObserver;
use App\Observers\DeliveryObserver;
use App\Observers\OrderObserver;
use App\Observers\UserObserver;
use App\Repositories\Car\CarRepository;
use App\Repositories\Car\CarRepositoryContract;
use App\Repositories\CollectionOfDebt\CollectionOfDebtRepository;
use App\Repositories\CollectionOfDebt\CollectionOfDebtRepositoryContract;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryContract;
use App\Repositories\Dept\DeptRepository;
use App\Repositories\Dept\DeptRepositoryContract;
use App\Repositories\Finance\FinanceRepository;
use App\Repositories\Finance\FinanceRepositoryContract;
use App\Repositories\Log\LogRepository;
use App\Repositories\Log\LogRepositoryContact;
use App\Repositories\Notification\NotificationRepository;
use App\Repositories\Notification\NotificationRepositoryContract;
use App\Repositories\Warehouse\WarehouseRepository;
use App\Repositories\Warehouse\WarehouseRepositoryContract;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryContract;
use App\Repositories\Delivery\DeliveryRepository;
use App\Repositories\Delivery\DeliveryRepositoryContract;
use App\Repositories\Driver\DriverRepository;
use App\Repositories\Driver\DriverRepositoryContract;
use App\Repositories\Evaluate\EvaluateRepository;
use App\Repositories\Evaluate\EvaluateRepositoryContract;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryContract;
use App\Repositories\OrderDetail\OrderDetailRepository;
use App\Repositories\OrderDetail\OrderDetailRepositoryContract;
use App\Repositories\Other\OtherRepository;
use App\Repositories\Other\OtherRepositoryContract;
use App\Repositories\Setting\SettingRepository;
use App\Repositories\Setting\SettingRepositoryContract;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryContract;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if (env('APP_ENV') == 'production'){
            URL::forceScheme('https');
        }
        Order::observe(OrderObserver::class);
        User::observe(UserObserver::class);
        Delivery::observe(DeliveryObserver::class);
        Customer::observe(CustomerObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(CustomerRepositoryContract::class, CustomerRepository::class);
        $this->app->bind(CarRepositoryContract::class, CarRepository::class);
        $this->app->bind(OtherRepositoryContract::class, OtherRepository::class);
        $this->app->bind(SettingRepositoryContract::class, SettingRepository::class);
        $this->app->bind(EvaluateRepositoryContract::class, EvaluateRepository::class);
        $this->app->bind(OrderRepositoryContract::class, OrderRepository::class);
        $this->app->bind(OrderDetailRepositoryContract::class, OrderDetailRepository::class);
        $this->app->bind(DriverRepositoryContract::class, DriverRepository::class);
        $this->app->bind(DeliveryRepositoryContract::class, DeliveryRepository::class);
        $this->app->bind(WarehouseRepositoryContract::class, WarehouseRepository::class);
        $this->app->bind(FinanceRepositoryContract::class, FinanceRepository::class);
        $this->app->bind(DeptRepositoryContract::class, DeptRepository::class);
        $this->app->bind(LogRepositoryContact::class, LogRepository::class);
        $this->app->bind(CompanyRepositoryContract::class, CompanyRepository::class);
        $this->app->bind(CollectionOfDebtRepositoryContract::class, CollectionOfDebtRepository::class);
        $this->app->bind(NotificationRepositoryContract::class, NotificationRepository::class);
    }
}
