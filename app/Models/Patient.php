<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial',
        'name',
        'mobile',
        'address',
        'age',
        'dues',
        'discount',
        'last_complain',
        'total',
        'paid',
        'date',
    ];

    public function complains(){
        return $this->hasMany(Complain::class);
    }

    public function perpose(){
        return $this->hasOne(Complain::class, 'patient_id', 'id');
    }

}
