<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurposeMedicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'complain_id',
        'medicine_id',
        'power_id',
        'dose_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function complain(){
        return $this->belongsToMany(Complain::class);
    }
    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
    public function power(){
        return $this->belongsTo(Power::class);
    }
    public function dose(){
        return $this->belongsTo(Dose::class);
    }
}
