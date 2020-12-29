<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salary extends Model
{
    use HasFactory;

    protected $tables = 'salaries';

    protected $fillable = [
        'salary_code',
        'total_cost',
        'month',
        'note',
    ];
    public function salaryDetail() {
        return $this->HasMany('App\Models\SalaryDetail', 'salary_code', 'salary_code')->get();
    }
}
