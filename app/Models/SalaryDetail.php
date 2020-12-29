<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryDetail extends Model
{
    use HasFactory;

    protected $tables = 'salary_details';

    protected $fillable = [
        'salary_code',
        'admin_id',
        'staff_name',
        'basic_salary',
        'salary_type',
        'commission',
        'allowance',
        'workdays',
        'amercement',
        'advance_money',
        'insurrance',
        'last_salary',
    ];
}
