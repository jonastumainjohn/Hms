<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vist extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'service_type',
        'service_fee',
        'visit_date'

    ];


    public function patients(){
        return $this->belongsTo(Vist::class);
    }
}
