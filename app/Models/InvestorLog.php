<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'investor_id',
        'name',
        'balance',
        'action'
    ];
}
