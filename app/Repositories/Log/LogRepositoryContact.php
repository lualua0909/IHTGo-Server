<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/4/18
 * Time: 22:10
 */

namespace App\Repositories\Log;


use Illuminate\Http\Request;

interface LogRepositoryContact
{
    public function getDataTable(Request $request);
}