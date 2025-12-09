<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prescriptionProductItem extends Model
{
    use HasFactory;


  // Define the fillable attributes
  protected $fillable = [
    'prescription_id',  
    'product_id',       
    'quantity',         
    'price',            
];

    public function prescription()
        {
            return $this->belongsTo(Prescription::class);
        }

public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
