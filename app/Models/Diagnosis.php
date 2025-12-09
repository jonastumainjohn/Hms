<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'medical_history',
        'diagnosis',
        'symptoms',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    
    public function getFullNameAttribute(){
        return 
        trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }
}
