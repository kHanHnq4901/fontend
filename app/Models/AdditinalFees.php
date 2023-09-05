<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditinalFees extends Model
{
    protected $table = 'additinalfees';

    public $timestamps = false;

    public $primaryKey = 'idAdditionalFees';
}
