<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 16/4/2018
 * Time: 10:17 AM
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission\Permission;
use App\Models\Permission\Role;
use App\Models\Permission\RolePermission;
use App\Models\Permission\UserRole;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    protected $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function listRole(Role $role)
    {
        $title = __('label.role');
        $listResult = $role->get();

        return view('admin.permissions.list', compact('listResult', 'title'));
    }

    public function getPermission($id)
    {
        $sql = "SELECT GROUP_CONCAT(CONCAT('{\"description\":\"', a.description, '\", \"id\":\"',a.id,'\"}')) list, a.group_key FROM `permissions` AS a GROUP BY a.group_key";
        $listPermission = DB::select($sql);
        $title = __('label.role');
        $arrPermission = $this->getPermissionForRole($id);

        return view('admin.permissions.show-permission', compact('arrPermission', 'title', 'id', 'listPermission'));
    }

    private function getPermissionForRole($roleID)
    {
        $arrID = [];
        $listId = DB::table('role_permission')->select('permission_id')->where('role_id', $roleID)->get();
        foreach ($listId as $id) {
            array_push($arrID, $id->permission_id);
        }

        return $arrID;
    }

    public function postPermission($id, Request $request, UserRole $userRole)
    {
        $oldData = $this->getPermissionForRole($id);
        $newData = $request->permission;
        $listInsert = array_diff((array)$newData, (array)$oldData);
        $listDelete = array_diff((array)$oldData, (array)$newData);

        if (sizeof($listInsert) > 0) {
            foreach ($listInsert as $insert) {
                $role = new RolePermission();
                $role->role_id = $id;
                $role->permission_id = $insert;
                $role->save();
            }
        }
        if (sizeof($listDelete) > 0) {
            foreach ($listDelete as $delete) {
                RolePermission::where([
                    'role_id'       => (int)$id,
                    'permission_id' => (int)$delete,
                ])->delete();
            }
        }
        $listUser = $userRole->select('user_id')->where(['role_id' => $id])->get();
        try {
            $this->updatePermissionToFile($listUser, $id);
        } catch (\Exception $exception) {
            error_log($exception->getMessage());
        }

        return redirect(route('role.getPermission', $id))->with($this->messageResponse());
    }

    private function updatePermissionToFile($listId, $roleID)
    {
        $listPermission = $this->addPermissionToFile($roleID);
        foreach ($listId as $itemUser) {
            $fileName = config_path('permission') . '/' . $itemUser->user_id . '.json';
            if (file_exists($fileName)) {
                $jsonPermission = file_get_contents($fileName);
                if ($jsonPermission && $jsonPermission != '') {
                    $arrPermission = json_decode($jsonPermission, true);
                    foreach ($arrPermission as $k => $item) {
                        if ($k == $roleID) {
                            $arrPermission[$k] = $listPermission;
                        }
                    }
                    file_put_contents($fileName, json_encode($arrPermission));
                }
            }
        }
    }

    public function getCreateRole()
    {
        $title = __('label.add_role');
        $item = false;

        return view('admin.permissions.form', compact('title', 'item'));
    }

    public function postCreateRole(Request $request, Role $role)
    {
        $id = $role->create($request->only('name', 'description'));
        if ($id) {
            return redirect(route('role.listRole'))->with($this->messageResponse());
        }

        return redirect(route('role.listRole'))->with($this->messageResponse('danger', __('label.failed')));
    }

    public function getUpdateRole($id, Role $role)
    {
        $item = $role->find($id);
        if ($item) {
            $title = __('label.role_update');

            return view('admin.permissions.form', compact('title', 'item'));
        }

        return redirect(route('role.listRole'))->with($this->messageResponse('danger', __('label.failed')));
    }

    public function postUpdateRole($id, Request $request, Role $role)
    {
        $role = $role->find($id);
        if ($role) {
            $role->update($request->only('name', 'description'));

            return redirect(route('role.listRole'))->with($this->messageResponse());
        }

        return redirect(route('role.listRole'))->with($this->messageResponse('danger', __('label.failed')));
    }

    public function addRoleForUser($id, Role $role, UserRole $userRole)
    {
        $title = __('label.add_role_for_user');
        $listUser = User::all();
        $listRole = $role->all();
        $item = $userRole->select('role_id')->where(['user_id' => $id])->get();
        $arrItem = [];
        foreach ($item as $i) {
            array_push($arrItem, $i->role_id);
        }

        return view('admin.permissions.role-user', compact('id', 'title', 'listUser', 'listRole', 'arrItem'));
    }

    public function postAddRoleForUser($id, Request $request, UserRole $userRole)
    {
        $arrayPermission = [];
        $userRole->where(['user_id' => $id])->delete();
        if ($request->role_id) {
            foreach ($request->role_id as $roleId) {
                //$arrayPermission = array_merge($arrayPermission, [$roleId => $this->addPermissionToFile($roleId)]);
                //array_push($arrayPermission, [$roleId => $this->addPermissionToFile($roleId)]);
                $arrayPermission[$roleId] = $this->addPermissionToFile($roleId);
                $userRole->create(['user_id' => $id, 'role_id' => $roleId]);
            }
        } else {
            $arrayPermission = [];
        }
        file_put_contents(config_path('permission') . '/' . $id . '.json', json_encode($arrayPermission));

        return redirect(route('user.list'))->with($this->messageResponse());
    }

    public function delete($id, UserRole $userRole, Role $role)
    {
        $item = $role->find($id);
        if ($item) {
            $item->delete();
            $userRole->where(['role_id' => $id])->delete();

            return redirect(route('role.listRole'))->with($this->messageResponse());
        }
    }

    private function addPermissionToFile($roleID)
    {
        $sql = "select permissions.key as k from permissions where id in (select permission_id from role_permission where role_id = $roleID)";
        $listResult = DB::select($sql);
        $data = [];
        foreach ($listResult as $item) {
            array_push($data, $item->k);
        }

        return $data;
    }
}