<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInvoice extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'company_invoices';
    protected $fillable = [
      'invoice_no',
      'company_id',
      'total_amount',
      'total_paid',
      'total_dues',
      'date',
    ];
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
