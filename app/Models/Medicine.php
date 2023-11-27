<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function diseases()
    {
        return $this->belongsToMany(Disease::class);
    }
    public function power(){
        return $this->belongsTo(Power::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }


}
