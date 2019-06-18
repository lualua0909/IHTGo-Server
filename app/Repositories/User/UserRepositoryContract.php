<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 12/6/2018
 * Time: 12:00 PM
 */

namespace App\Repositories\User;


use Illuminate\Http\Request;

interface UserRepositoryContract
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function storeUser(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function updateUser(Request $request);

    /**
     * @param array $condition
     * @param bool $first
     * @param array $select
     * @return mixed
     */
    public function findByCondition(array $condition, $first=true, $select=['*']);
}