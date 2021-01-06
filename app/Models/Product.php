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
        'combo_product'
    ];

    protected $hidden = ['labels'];

    public function getMonthlyProfitAttribute()
    {
        $now = getdate();
        $quantityProduct = InvoiceDetail::where('product_code', $this->product_code)
            ->whereMonth('created_at', $now['mon'])->pluck('quantity_product');
        $total = array_sum($quantityProduct->toArray());
        return $total
            ? (($total*$this->sale_price) - ($total*$this->import_price))
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
            ? (($total*$this->sale_price) - ($total*$this->import_price))
            : 0;
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image', 'product_code', 'product_code');
    }

    // public function invoiceDetail()
    // {
    //     return $this->hasMany('App\Models\InvoiceDetail', 'product_code', 'product_code');
    // }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment', 'product_id', 'id');
    }

    public function getCountBuyAttribute()
    {
        $quantityProduct = InvoiceDetail::where('product_code', $this->product_code);
        return  $quantityProduct ? $quantityProduct->count() : 0;
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
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        $str = preg_replace("/(đ)/", "d", $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        $str = preg_replace("/(Đ)/", "D", $str);
        //$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        return $str;
    }
}
