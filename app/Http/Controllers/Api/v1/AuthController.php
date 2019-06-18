<?php
namespace App\Http\Controllers\Api\v1;

use App\Helpers\Business;
use App\Helpers\MessageApi;
use App\Http\Resources\UserResource;
use App\Models\Social;
use App\Notifications\NexmoSendSMS;
use App\Notifications\ResetPassword;
use App\Repositories\Customer\CustomerRepositoryContract;
use App\User;
use Carbon\Carbon;
use Chatkit\Laravel\ChatkitManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\User\UserRepositoryContract;
use App\Http\Controllers\Api\ApiController;
use App\Helpers\HttpCode;

class AuthController extends ApiController
{
    /**
     * @var UserRepositoryContract
     */
    protected $repository;

    /**
     * AuthController constructor.
     * @param UserRepositoryContract $contract
     */
    public function __construct(UserRepositoryContract $contract)
    {
        $this->repository = $contract;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $data = $this->validateData($request, $this->ruleLoginByPhone());
        if (!is_array($data)) {
            return $data;
        }
        $credentials = array_merge($this->credentialsByPhone($request), ['level' => Business::USER_LEVEL_CUSTOMER]);
        try {
            if (!$token = JWTAuth::attempt($credentials)) { // attempt to verify the credentials and create a token for the user
                return response()->json(MessageApi::error(['Thông tin đăng nhập không đúng'], HttpCode::CODE_VALIDATE_IN_VALID));
            }
        } catch (JWTException $e) {
            return response()->json(MessageApi::error([], HttpCode::CODE_ERROR_SYSTEM)); // something went wrong whilst attempting to encode the token
        }
        $user = $this->repository->find($request->user()->id);
//        if ($user->activated_phone){
//            return response()->json(MessageApi::error([], HttpCode::CODE_IN_VERIFY));
//        }
        if (!$user->activated){
            return response()->json(MessageApi::error([], HttpCode::CODE_IN_ACTIVATED));
        }
        if ($user->baned){
            return response()->json(MessageApi::error([], HttpCode::CODE_BANED));
        }
        if ($user->image){
            $user->avatar = [
                'full' => route('api.image.show', ['id' => $user->image->id]),
                'thumbnail' => route('api.image.show', ['id' => $user->image->id, 'type' => $user->image->type]),
            ];
        }else{
            $user->avatar = null;
        }
        $user->customer = $user->customer;
        return response()->json(['data' => $user,'token' => "Bearer $token", 'status' => HttpCode::SUCCESS, 'error_code' => HttpCode::CODE_SUCCESS]);
    }

    /**
     * @param Request $request
     * @return UserResource
     */
    public function me(Request $request)
    {
        return new UserResource(optional($this->repository->find($request->user()->id)));
    }

    /**
     * @param Request $request
     * @param CustomerRepositoryContract $customerRepositoryContract
     * @return UserResource|array|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request, CustomerRepositoryContract $customerRepositoryContract)
    {
        $data = $this->validateData($request, $this->rulesRegister());
        if (!is_array($data)) {
            return $data;
        }
        $user = $this->repository->storeUser($request);
        if ($user){
            $dataCustomer = [
                'user_id' => $user->id,
                'type' => ($request->type) ? $request->type : Business::CUSTOMER_TYPE_USER,
                'address' => $request->address,
                'phone_company' => $request->phone_company,
                'tax_code' => $request->tax_code,
                'pic' => $request->pic
            ];
            $customerRepositoryContract->store($dataCustomer);
            return new UserResource(optional($user));
        }
        return response()->json(MessageApi::error([__('label.failed')], HttpCode::CREATE_ITEM_ERROR));
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $data = $this->validateData($request, $this->ruleResetPassword());
        if (!is_array($data)) {
            return $data;
        }
        try{
            $newPassword = random_int(100000,999999);
            $user = $this->repository->findByCondition(['email' => $request->email]);
            if ($user){
                $user->password = bcrypt($newPassword);
                if ($user->save()){
                    $user->notify(new ResetPassword($newPassword));
                    return response()->json(MessageApi::success('success'));
                }
            }
        }catch (\Exception $exception){
            logger($exception->getMessage());
            return response()->json(MessageApi::success($newPassword), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::success($newPassword), HttpCode::SUCCESS);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {
        $data = $this->validateData($request, $this->ruleChangePassword());
        if (!is_array($data)) {
            return $data;
        }
        if (Hash::check($request->old_password, $request->user()->password)){
            $this->repository->update($request->user()->id, ['password' => bcrypt($request->password)]);
            return response()->json(MessageApi::success([]), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::error([__('label.password_does_not_match')]));
    }

    /**
     * @param Request $request
     * @return UserResource|\Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        if (optional($request->user())->id){
            $data = $request->all();
            $this->repository->update($request->user()->id, $data);
            return new UserResource(optional($this->repository->find($request->user()->id)));
        }
        return response()->json(MessageApi::error([__('label.failed')]), HttpCode::SUCCESS);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function activated(Request $request)
    {
        $data = $this->validateData($request, $this->ruleActivated($request));
        if (!is_array($data)) {
            return $data;
        }
        $user = $this->repository->findByCondition(['phone' => $request->phone, 'activated_phone' => $request->code]);
        if ($user){
            $user->activated_phone = null;
            if ($user->save()){
                return response()->json(MessageApi::success([]), HttpCode::SUCCESS);
            }
        }
        return response()->json(MessageApi::error([__('label.failed')], HttpCode::CODE_UPDATE_ERROR), HttpCode::SUCCESS);
    }

    /**
     * @param Request $request
     * @return array
     */
    private function ruleActivated(Request $request)
    {
        //$request->phone = preg_replace('/0/', '+84', $request->phone, 1);
        return [
            'phone' => 'required',
            'code' => 'required|numeric|min:6|exists:users,activated_phone'
        ];
    }

    /**
     * @return array
     */
    private function rulesRegister()
    {
        $rules = [
            'name'        => 'required|max:255',
            'phone' => 'required|max:20',
            'email'           => 'required|email|max:255|unique:users',
            'password'        => 'required|min:6',
            'type' => 'sometimes|nullable|in:1,2',
            'address' => 'sometimes|nullable|string|max:150',
            'phone_company' => 'sometimes|nullable|string|max:20',
            'tax_code' => 'sometimes|nullable|string|max:100',
            'birthday' => 'required|date_format:d/m/Y',
            'pic' => 'required_if:type,2'
        ];
        return $rules;
    }

    /**
     * @return array
     */
    private function ruleLogin()
    {
        return [
            'email' => 'required',
            'password' =>'required|min:6'
        ];
    }

    /**
     * @return array
     */
    private function ruleResetPassword()
    {
        return [
            'email' => 'required|exists:users,email'
        ];
    }

    /**
     * @return array
     */
    private function ruleChangePassword()
    {
        return [
            'old_password' =>'required|min:6',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function credentialsByEmail(Request $request)
    {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            return $request->only('email', 'password');
        }
        return [
            'phone' => $request->email,
            'password' => $request->password
        ];
    }

    /**
     * @return array
     */
    private function ruleLoginByPhone()
    {
        return [
            'phone' => 'required',
            'password' =>'required|min:6'
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function credentialsByPhone(Request $request)
    {
        return [
            //'phone' => preg_replace('/0/', '+84', $request->phone, 1),
            'phone' => $request->phone,
            'password' => $request->password
        ];
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function driverLogin(Request $request)
    {
        $data = $this->validateData($request, $this->ruleLoginByPhone());
        if (!is_array($data)) {
            return $data;
        }
        $credentials = array_merge($this->credentialsByPhone($request), ['level' => Business::USER_LEVEL_EMPLOYEE]);
        try {
            if (!$token = JWTAuth::attempt($credentials)) { // attempt to verify the credentials and create a token for the user
                return response()->json(MessageApi::error(['Thông tin đăng nhập không đúng'], HttpCode::CODE_VALIDATE_IN_VALID));
            }
        } catch (JWTException $e) {
            return response()->json(MessageApi::error([], HttpCode::CODE_ERROR_SYSTEM)); // something went wrong whilst attempting to encode the token
        }
        $user = $this->repository->find($request->user()->id);
        if ($user->baned){
            return response()->json(MessageApi::error([], HttpCode::CODE_BANED));
        }
        if ($user->image){
            $user->avatar = [
                'full' => route('api.image.show', ['id' => $user->image->id]),
                'thumbnail' => route('api.image.show', ['id' => $user->image->id, 'type' => $user->image->type]),
            ];
        }else{
            $user->avatar = null;
        }
        return response()->json(['data' => $user,'token' => "Bearer $token", 'status' => HttpCode::SUCCESS, 'error_code' => HttpCode::CODE_SUCCESS]);
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function resetPasswordByPhone(Request $request)
    {
        $data = $this->validateData($request, $this->ruleResetPasswordByPhone());
        if (!is_array($data)) {
            return $data;
        }
        try{
            $newPassword = random_int(100000,999999);
            $user = $this->repository->findByCondition(['phone' => $request->phone]);
            if ($user){
                $user->password = bcrypt($newPassword);
                if ($user->save()){
                    $user->notify(new NexmoSendSMS(Business::SMS_RESET_PASSWORD));
                    return response()->json(MessageApi::success('success'));
                }
            }
        }catch (\Exception $exception){
            logger($exception->getMessage());
            return response()->json(MessageApi::success($newPassword), HttpCode::SUCCESS);
        }
        return response()->json(MessageApi::success($newPassword), HttpCode::SUCCESS);
    }

    /**
     * @return array
     */
    private function ruleResetPasswordByPhone()
    {
        return [
            'phone' => 'required|exists:users,phone'
        ];
    }

    /**
     *
     * @param Request $request
     * @param Social $social
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function social(Request $request, Social $social)
    {
        $data = $this->validateData($request, $this->ruleSocial());
        if (!is_array($data)) {
            return $data;
        }
        $user = null;
        $token = $this->handleSocial($request, $social, $user);
        if ($user->activated_phone){
            return response()->json(MessageApi::error([], HttpCode::CODE_IN_VERIFY));
        }
        if (!$user->activated){
            return response()->json(MessageApi::error([], HttpCode::CODE_IN_ACTIVATED));
        }
        if ($user->baned){
            return response()->json(MessageApi::error([], HttpCode::CODE_BANED));
        }
        $user->avatar = $user->social->avatar;
        return response()->json(['data' => $user,'token' => "Bearer $token", 'status' => HttpCode::SUCCESS, 'error_code' => HttpCode::CODE_SUCCESS]);
    }

    /**
     * @param Request $request
     * @param Social $social
     * @param $user
     * @return bool
     */
    private function handleSocial(Request $request, Social $social, &$user)
    {
        try{
            $item = $social->where(['provider_user_id' => $request->provider_user_id, 'provider' => $request->provider])->first();
            if ($item){
                $user = $item->user;
                $token = JWTAuth::fromUser($user);
                return $token;
            }
            $newSocial = $social->create($request->only('provider_user_id', 'provider', 'avatar'));
            $data = $request->all();
            unset($data['provider_user_id']);unset($data['provider']);unset($data['avatar']);
            if ($request->birthday){
                $data['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
            }
            $user = User::create($data);
            $newSocial->user_id = $user->id;
            if ($newSocial->save()){
                $token = JWTAuth::fromUser($newSocial->user);
                return $token;
            }
        }catch (\Exception $exception){
            logger($exception->getMessage());
        }
        return false;
    }

    /**
     * @return array
     */
    private function ruleSocial()
    {
        return [
            'provider_user_id' => 'required',
            'provider' => 'required|in:google,facebook'
        ];
    }
}