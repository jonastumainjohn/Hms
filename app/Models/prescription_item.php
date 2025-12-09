<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prescription_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'medical_id',
        'quantity',
        'price',
    ];

    public function medical()
    {
    
        return $this->belongsTo(Medical::class);
    }
    
       
        public function medicine()
        {
            return $this->belongsTo(Medical::class, 'medical_id');  // 'medical_id' is the foreign key
        }


     // Define the relationship with Prescription
     public function prescription()
     {
         return $this->belongsTo(Prescription::class, 'prescription_id', 'id');
     }
 
   
}
