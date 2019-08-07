<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    protected $fillable = [
      'type', 'order_id', 'total', 'payment', 'own', 'date', 'note', 'user_id', 'name'
    ];
}
