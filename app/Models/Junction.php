<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Junction extends Model
{
    protected $table = 'junctiontable';

    public $timestamps = false;

    public $primaryKey = 'idJunction';
}
