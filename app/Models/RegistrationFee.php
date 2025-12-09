<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'fee_amount',
        'currency',
        'valid_from',
        'valid_until',
        'description',
    ];
}
