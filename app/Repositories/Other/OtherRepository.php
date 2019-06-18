<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 24/6/2018
 * Time: 8:08 AM
 */

namespace App\Repositories\Other;


use App\Models\Data\Other;
use App\Repositories\EloquentRepository;

class OtherRepository extends EloquentRepository implements OtherRepositoryContract
{
    public function getModel()
    {
        return Other::class;
    }
}