<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'investor_id',
        'investment_type_id',
        'value',
        'sold_in',
        'active'
    ];

    public function investor()
    {
        return $this->belongsTo(Investment::class, 'investor_id');
    }

    public function type()
    {
        return $this->belongsTo(InvestmentType::class, 'investment_type_id');
    }
}
