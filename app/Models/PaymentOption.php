<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOption extends Model
{
    protected $table = 'paymentoption';

    public $timestamps = false;

    public $primaryKey = 'idPaymentoption';
}