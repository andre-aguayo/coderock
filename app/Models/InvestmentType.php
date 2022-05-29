<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvestmentType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'tax',
        'active',
        'minimum_moths'
    ];

    public function invesments()
    {
        return $this->hasMany(Investment::class, 'investment_type_id');
    }
}
