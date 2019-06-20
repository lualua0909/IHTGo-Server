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
use App\Services\SmsService;
use App\User;
use Carbon\Carbon;
use Chatkit\Laravel\Facades\Chatkit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            $dataStore = $this->setDataApi($request);
            $user = DB::table('users')->insert($dataStore);
            //$user = User::create($dataStore);
            $user = $this->findByCondition(['chatkit_id' => $dataStore['chatkit_id']]);
            try{

                Chatkit::createUser([
                    'id' => $dataStore['chatkit_id'],
                    'name' => $dataStore['name']
                ]);

                if ($request->type == Business::CUSTOMER_TYPE_COMPANY){
                    $sms = new SmsService();
                    $message = sprintf(
                        Business::SMS_ACTIVATED_ACCOUNT,
                        $user->activated_phone,
                        'IHT GO'
                    );
                    $sms->sendSMS($user->phone, $message);
                }
                return $user;
            }catch (\Exception $exception){
                //dd($exception->getMessage());
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
            $data = $request->only('phone', 'name', 'support', 'email');
            if($request->password){
                $data['password'] = bcrypt($request->password);
            }
            $data['activated'] = ($request->active) ? Business::USER_ACTIVE : Business::USER_UN_ACTIVE;
            $data['baned'] = ($request->baned) ? Business::USER_BANED : Business::USER_UN_BANED;
            return $data;
        }
        $data = $request->only('name', 'username', 'code', 'email', 'phone', 'support');
        $data['activated'] = Business::USER_ACTIVE;

        $data['level'] = Business::USER_LEVEL_EMPLOYEE ;
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
            $data['activated_phone'] = $request->type == Business::CUSTOMER_TYPE_COMPANY ? random_int(100000, 999999) : null;
            $data['activated'] = $request->type == Business::CUSTOMER_TYPE_COMPANY ? Business::USER_UN_ACTIVE : Business::USER_ACTIVE;
            $data['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
            $data['level'] = Business::USER_LEVEL_CUSTOMER;
            $data['chatkit_id'] = $this->generateChatkitId();
            //$data['code'] = $this->generateCustomerCode();
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
     * @param array $select
     * @return mixed
     */
    public function findByCondition(array $condition, $first = true, $select = ['*'])
    {
        if ($first){
            return $this->_model->select($select)->where($condition)->first();
        }
        return $this->_model->select($select)->where($condition)->get();
    }

    /**
     * @return string
     */
    private function generateChatkitId()
    {
        do{
            $chatkitId = str_random(16);
        }while (User::where('chatkit_id', $chatkitId)->first());
        return $chatkitId;
    }

    /**
     * @return string
     */
    private function generateCustomerCode()
    {
        $count = User::where(['level' => Business::USER_LEVEL_CUSTOMER])->count();
        do{
            $orderCode = sprintf("KH%'.05d", $count);
            $orderCode++;
        }while (User::where('code', $orderCode)->first());
        return $orderCode;
    }
}