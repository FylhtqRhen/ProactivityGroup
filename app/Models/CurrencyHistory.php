<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'currency_id',
        'name',
        'date',
        'rate',
    ];

    protected $table = 'currency_history';
}
