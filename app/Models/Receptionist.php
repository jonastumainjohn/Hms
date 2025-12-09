<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receptionist extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date_of_birth',
        'shift'
    ];




    public function user(){
        return $this->belongsTo(User::class);
    }
}
