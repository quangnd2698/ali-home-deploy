<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'product_id',
        'user_id',
        'user_name',
        'point',
        'comment',
    ];

    protected $appends = [
        'display_star'
    ];

    public function getDisplayStarAttribute()
    {
        $text = '';
        for ($i = 1; $i <= $this->point; $i++) { 
            $text .= '<i class="fa fa-star"></i>';
        }

        for ($i = 5; $i > $this->point; $i--) { 
            $text .= '<i class="icon-copy fa fa-star-o"></i>';
        }
        return $text;
    }
}
