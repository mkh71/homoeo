<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'details',
        'duration',
    ];
    public function patient(){
        return $this->belongsTo(Patient::class);
    }
    public function medicines(){
        return $this->hasMany(PurposeMedicine::class, 'complain_id','id');
    }
}
