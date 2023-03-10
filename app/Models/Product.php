<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\In;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'products';

    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'products_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->only(['product_code', 'product_name', 'producer']);
        return $array;
    }

    protected $fillable = [
        'product_code',
        'product_name',
        'producer',
        'product_type',
        'size',
        'material',
        'color',
        'surface',
        'uses_for',
        'quantity_in_one_box',
        'quantity',
        'import_price',
        'sale_price',
        'count_view',
        'type_code',
        'number_error',
        'status',
        'sale_on_web',
        'description',
        'combo',
    ];

    protected $appends = [
        'count_buy',
        'monthly_profit',
        'quarterly_profit',
        'point',
        'count_evaluate',
        'display_star',
        'combo_product',
        'turn_buy'
    ];

    protected $hidden = ['labels'];

    public function getMonthlyProfitAttribute()
    {
        $now = getdate();
        $quantityProduct = InvoiceDetail::where('product_code', $this->product_code)
            ->whereMonth('created_at', $now['mon'])->pluck('quantity_product');
        $total = array_sum($quantityProduct->toArray());
        return $total
            ? ($total*$this->sale_price)
            : 0;
    }

    public function getQuarterlyProfitAttribute()
    {
        $now = getdate();
        $quantityProduct = InvoiceDetail::where('product_code', $this->product_code)
            ->whereMonth('created_at', $now['mon'])
            ->orWhereMonth('created_at', $now['mon']-1)
            ->orWhereMonth('created_at', $now['mon']-2)->pluck('quantity_product');
        $total = array_sum($quantityProduct->toArray());
        return $total
            ? ($total*$this->sale_price)
            : 0;
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image', 'product_code', 'product_code');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'product_id', 'id');
    }

    public function getCountBuyAttribute()
    {
        $quantityProducts = InvoiceDetail::where('product_code', $this->product_code)->pluck('quantity_product');
        return  $quantityProducts ? array_sum($quantityProducts->toArray()) : 0;
    }

    public function getTurnBuyAttribute()
    {
        $quantityProducts = InvoiceDetail::where('product_code', $this->product_code)->get();
        $data = $quantityProducts->where('sales_channel', 'web');
        return  $data ? $data->count() : 0;
    }
    
    public function getCountEvaluateAttribute()
    {
        $points = $this->comments()->pluck('point');
        $count = $points->count();
        return $count;
    }

    public function getPointAttribute()
    {
        $points = $this->comments()->pluck('point');
        $point = array_sum($points->toArray());
        // dd($point);
        if ($this->count_evaluate != 0) {
            return round( $point/$this->count_evaluate, 1, PHP_ROUND_HALF_UP);
        }
        return 0;
    }

    public function getDisplayStarAttribute()
    {
        $text = '';
        $numRound =  round($this->point, 0, PHP_ROUND_HALF_DOWN);
        $num = $this->point - $numRound;
        for ($i = 1; $i <= $numRound; $i++) { 
            $text .= '<i class="fa fa-star"></i>';
        }

        if ($num != 0) {
            $text .= '<i class="icon-copy fa fa-star-half-o"></i>';
            $numRound ++;
        }
        for ($i = 5; $i > $numRound; $i--) {
            $text .= '<i class="icon-copy fa fa-star-o"></i>';
        }
        return $text;
    }

    public function getComboProductAttribute()
    {
        $combos = explode(';', $this->combo);
        return Product::whereIn('product_code', $combos)->get();
    }

    function convert_vi_to_en($str) {
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", "a", $str);
        $str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", "e", $str);
        $str = preg_replace("/(??|??|???|???|??)/", "i", $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", "o", $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", "u", $str);
        $str = preg_replace("/(???|??|???|???|???)/", "y", $str);
        $str = preg_replace("/(??)/", "d", $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", "A", $str);
        $str = preg_replace("/(??|??|???|???|???|??|???|???|???|???|???)/", "E", $str);
        $str = preg_replace("/(??|??|???|???|??)/", "I", $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???)/", "O", $str);
        $str = preg_replace("/(??|??|???|???|??|??|???|???|???|???|???)/", "U", $str);
        $str = preg_replace("/(???|??|???|???|???)/", "Y", $str);
        $str = preg_replace("/(??)/", "D", $str);
        return $str;
    }
}
