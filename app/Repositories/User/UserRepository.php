<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 12/6/2018
 * Time: 12:00 PM
 */

namespace App\Repositories\User;


use App\Helpers\Business;
use App\Notifications\ActiveRegister;
use App\Notifications\NexmoSendSMS;
use App\Repositories\EloquentRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserRepository extends EloquentRepository implements UserRepositoryContract
{

    public function getModel()
    {
        return User::class;
    }

    /**
     * @param Request $request
     * @return bool|mixed
     * @throws \Exception
     */
    public function storeUser(Request $request)
    {
        $route = $request->route()->getName();
        if ($route == 'api.customer.register'){
            $id = $this->store($this->setDataApi($request));
            $user = $this->find($id);
            try{
                //email
                //$user->notify(new ActiveRegister($id));

                //sms
                $user->notify(new NexmoSendSMS(Business::SMS_ACTIVATED_ACCOUNT));
                return $user;
            }catch (\Exception $exception){
                logger(['service' => 'Register User API', 'content' => $exception->getMessage()]);
                $user->delete();
                return false;
            }
        }
        return $this->store($this->setData($request));
    }

    /**
     * @param Request $request
     * @return bool|mixed
     */
    public function updateUser(Request $request)
    {
        return $this->update($request->id, $this->setData($request));
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function delete($id)
    {
        return $this->update($id, ['baned' => Business::USER_BANED]);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function setData(Request $request)
    {
        if ($request->id){
            $data = $request->only('phone', 'name');
            if($request->password){
                $data['password'] = bcrypt($request->password);
            }
            $data['activated'] = ($request->active) ? Business::USER_ACTIVE : Business::USER_UN_ACTIVE;
            $data['baned'] = ($request->baned) ? Business::USER_BANED : Business::USER_UN_BANED;
            return $data;
        }
        $data = $request->only('name', 'username', 'code', 'email', 'phone');
        $data['activated'] = Business::USER_ACTIVE;

        $data['level'] = Business::USER_LEVEL_ADMIN ;
        if ($request->route()->getName() == 'driver.store') {
            $data['level'] = Business::USER_LEVEL_DRIVER;
        }
        $data['password'] = bcrypt($request->password);
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    private function setDataApi(Request $request)
    {
        try{

            $data = $request->only('name', 'email', 'gender', 'phone');
            //$data['phone'] = preg_replace('/0/', '+84', $request->phone, 1);
            $data['activated_phone'] = random_int(100000, 999999);
            $data['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
            $data['level'] = Business::USER_LEVEL_CUSTOMER;
            $data['password'] = bcrypt($request->password);
            return $data;
        }catch (\Exception $exception){
            logger($exception->getMessage());
            return false;
        }
    }

    /**
     * @param array $condition
     * @param bool $first
     * @return mixed
     */
    public function findByCondition(array $condition, $first = true, $select=['*'])
    {
        if ($first){
            return $this->_model->select($select)->where($condition)->first();
        }
        return $this->_model->select($select)->where($condition)->get();
    }
}