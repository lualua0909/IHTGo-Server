<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 6/17/18
 * Time: 17:56
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\User\UserRepositoryContract;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @var UserRepositoryContract
     */
    protected $repository;

    /**
     * UserController constructor.
     * @param UserRepositoryContract $repositoryContract
     */
    public function __construct(UserRepositoryContract $repositoryContract)
    {
        $this->repository = $repositoryContract;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $title = __('label.user');
        $listResult = $this->repository->findByCondition(['level' => Business::USER_LEVEL_ADMIN], false);
        return view('admin.user.list', compact('listResult', 'title'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $title = __('label.user_create');
        $item = false;
        return view('admin.user.form', compact('item', 'title'));
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        if ($this->repository->storeUser($request)) {
            return redirect(route('user.list'))->with($this->messageResponse());
        }
        return redirect(route('user.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->repository->find($id);
        if ($item) {
            $title = __('label.user_edit');
            return view('admin.user.form', compact('title', 'item'));
        }
        return redirect(route('user.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request)
    {
        if ($this->repository->updateUser($request)) {
            return redirect(route('user.list'))->with($this->messageResponse());
        }
        return redirect(route('user.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile(Request $request)
    {
        $user = $request->user();
        $title = __('label.profile');
        $genderType = array(
            Business::GENDER_MALE => __('label.male'),
            Business::GENDER_FEMALE => __('label.female'),
        );
        return view('admin.user.profile', compact('title', 'user', 'genderType'));
    }

    /**
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $id = Auth::user()->id;
        $data = $request->only('name', 'phone', 'email', 'gender');
        $data['birthday'] = Carbon::createFromFormat('d/m/Y', $request->birthday)->format('Y-m-d');
        if ($this->repository->update($id, $data)){
            return redirect()->back()->with($this->messageResponse());
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param UpdateProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(UpdateProfileRequest $request)
    {
        if (Hash::check($request->old_password, $request->user()->getAuthPassword())){
            if ($this->repository->update($request->user()->id, ['password' => bcrypt($request->password)])){
                return redirect()->back()->with($this->messageResponse());
            }
        }else{
            $request->session()->flash('old_password', __('label.password_does_not_match'));
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        if ($this->repository->delete($id)) {
            return redirect(route('user.list'))->with($this->messageResponse());
        }
        return redirect(route('user.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajaxBaned($id, Request $request)
    {
        if ($request->ajax()){
            $item = $this->repository->find($id);
            $baned = ($item->baned) ? Business::USER_UN_BANED : Business::USER_BANED;
            if ($this->repository->update($id, ['baned' => $baned])){
                return response()->json(['code' => 200]);
            }
        }
        return response()->json(['code' => 0]);
    }
}