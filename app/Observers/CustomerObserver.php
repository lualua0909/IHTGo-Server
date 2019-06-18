<?php

namespace App\Observers;

use App\Helpers\Business;
use App\Models\Customer;

class CustomerObserver
{
    /**
     * Handle to the customer "created" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function created(Customer $customer)
    {
        if ($customer->type == Business::CUSTOMER_TYPE_COMPANY){
            $count = Customer::select(['code'])->count() + 1;
            $code = sprintf("IHT-KH%s%'.02d", date('Ymd'), $count);
            $customer->code = $code;
            $customer->save();
        }
    }

    /**
     * Handle the customer "updated" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function updated(Customer $customer)
    {
        //
    }

    /**
     * Handle the customer "deleted" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function deleted(Customer $customer)
    {
        //
    }
}
