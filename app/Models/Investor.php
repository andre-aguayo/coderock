<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Investor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'balance'
    ];

    public function investments()
    {
        return $this->hasMany(Investment::class, 'investor_id');
    }
}
