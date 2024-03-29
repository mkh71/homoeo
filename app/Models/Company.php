<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $fillable = [
      'name',
      'email',
      'phone',
      'address',
      'total_amount',
      'total_paid',
      'total_dues',
      'mpo'
    ];
}
