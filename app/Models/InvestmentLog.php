<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'investment_id',
        'value',
        'active',
        'sold_in',
        'action'
    ];
}
