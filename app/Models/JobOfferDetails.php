<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOfferDetails extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'basic_salary',
        'net_salary',
        'allowances',
        'gross_salary',
        'total_paye_tax',
        'emp_pension_cont_amt',
        'emp_pension_amt',
    ];
}
