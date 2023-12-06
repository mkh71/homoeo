<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeackSize extends Model
{
    use HasFactory;
    protected $table = 'peack_sizes';
    protected $fillable = [
      'name'
    ];
}
