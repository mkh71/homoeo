<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientPayment extends Model
{
    use HasFactory;
    protected $table = 'patient_payments';
    protected $fillable = [
      'patient_id',
      'total',
      'paid',
      'discount',
      'dues',
      'serial',
      'complain_id',
    ];
}
