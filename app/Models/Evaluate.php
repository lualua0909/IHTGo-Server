<?php

namespace App\Models;

use App\Models\Data\Other;
use App\User;

class Evaluate extends BaseModel
{
    protected $casts = [
        'content' => 'array'
    ];

    protected $fillable = [
        'from_id', 'to_id', 'type', 'content', 'note', 'rate'
    ];

    public function from()
    {
        return $this->hasOne(User::class, 'id', 'from_id');
    }

    public function to()
    {
        return $this->hasOne(User::class, 'id', 'to_id');
    }

    public function other($listID)
    {
        return Other::select(['name'])->whereIn('id', $listID)->get();
    }
}
