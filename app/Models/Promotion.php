<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';

    protected $fillable = [
        'tilte',
        'object',
        'date_from',
        'date_to',
        'type',
        'value'
    ];

    protected $append = [
        'status'
    ];

    public function getStatusAttribute()
    {
        $dateFrom = date($this->date_form);
    }
}
