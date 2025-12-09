<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'description',
        'total_price',
        'appointment_date',
        'status',
    ];

    public function items()
    {
        
        return $this->hasMany(prescription_item::class);
    }



    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    protected $casts = [
        'appointment_date' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
    // Define the relationship
    public function prescriptionItems()
    {
        
        return $this->hasMany(prescription_item::class, 'prescription_id', 'id');
    }

    public function medicine()
        {
        return $this->belongsTo(Medical::class, 'medicine_id');
        }

        public function productItems()
            {
                return $this->hasMany(PrescriptionProductItem::class);
            }
       
}
