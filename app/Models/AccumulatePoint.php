<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccumulatePoint extends Model
{
    use HasFactory;

    protected $table = 'accumulate_points';

    protected $fillable = [
        'customer_phone',
        'name',
        'point',
        'rank',
    ];

    protected $appends = ['percent', 'vn_rank'];

    public function getPercentAttribute()
    {
        switch ($this->rank) {
            case 'normal':
                return 0;
            break;
            case 'potential':
                return 1;
            break;
            case 'chummy':
                return 2;
            break;
            case 'excellent':
                return 3;
            break;
            case 'vip': 
                return 4;
            break;
            default:
        }
    }

    public function getVnRankAttribute()
    {
        switch ($this->rank) {
            case  'normal':
                return 'bình thường';
            break;
            case  'potential':
                return 'tiềm năng';
            break;
            case  'chummy':
                return 'thân thiết';
            break;
            case  'excellent':
                return 'ưu tú';
            break;
            case  'vip':
                return 'vip';
            break;
            default:
                return 'bình thường';
            break;
        }
    }

    
}
