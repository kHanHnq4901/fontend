<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtFee extends Model
{
    protected $table = 'debtfee';

    public $timestamps = false;

    public $primaryKey = 'idDebtfee';
}
