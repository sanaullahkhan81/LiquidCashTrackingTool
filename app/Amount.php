<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amount extends Model
{
    protected $table = 'amount';
    protected $fillable = ['amount'];
}
