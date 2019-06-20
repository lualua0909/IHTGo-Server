<?php

namespace App\Observers;

use App\Models\Customer;
use App\User;
use Chatkit\Laravel\Facades\Chatkit;
class UserObserver
{
    /**
     * @param User $user
     * @throws \Chatkit\Exceptions\MissingArgumentException
     * @throws \Chatkit\Exceptions\TypeMismatchException
     */
    public function created(User $user)
    {
        try{
            Chatkit::createUser([
                'id' => $user->chatkit_id,
                'name' => $user->name
            ]);
        }catch (\Exception $exception){
            logger($exception->getMessage());
        }

    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        Customer::where(['user_id' => $user->id])->forceDelete();
    }

}
