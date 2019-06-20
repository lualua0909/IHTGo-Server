<?php

namespace App\Observers;

use App\Helpers\Business;
use App\Models\CollectionOfDebt;
use App\Services\DownstreamMessageToDevice;

class CollectionOfDeptObserver
{
    public $streamMessageToDevice;

    public function __construct()
    {
        $this->streamMessageToDevice = new DownstreamMessageToDevice();
    }

    /**
     * @param CollectionOfDebt $collectionOfDebt
     */
    public function created(CollectionOfDebt $collectionOfDebt)
    {

    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\CollectionOfDebt  $collectionOfDebt
     * @return void
     */
    public function updated(CollectionOfDebt $collectionOfDebt)
    {
        if ($collectionOfDebt->employee_id)
        {
            $bodyMsg = sprintf(Business::FCM_DEPT_DRIVER, $collectionOfDebt->name);
            $this->streamMessageToDevice->sendMsgToDevice(optional($collectionOfDebt->user)->device, Business::FCM_ORDER_TITLE, $bodyMsg);
        }
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\CollectionOfDebt  $collectionOfDebt
     * @return void
     */
    public function deleted(CollectionOfDebt $collectionOfDebt)
    {
        //
    }
}
