<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;


    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number',
        'age',
        'address',
        'gender',
        'registration_fee',
        'payment_method',
        'medical_history',
        'mrn_number',
        'receptionist_id',
    ];

    public function getFullNameAttribute(){
        return 
        trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }
    
    public function receptionist()
{
    return $this->belongsTo(User::class, 'receptionist_id');
}

public function appointments()
{
    return $this->hasMany(Appointment::class);
}

public function visits(){
    return $this->hasMany(Vist::class);
}

public function diagnosis(){
    return $this->hasMany(Diagnosis::class);
}

public function notification(){
    return $this->hasMany(Notification::class);
}

}
