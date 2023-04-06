<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    protected $fillable = [
        'product_id',
        'product_name',
        'product_image',
        'product_price',
        'is_sales',
        'description',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->isDirty('product_name')) {
                $product_id = self::convertIdByProductName($model->product_name);
                $model->product_id = $product_id;
            }
        });
    }

    public static function convertIdByProductName($product_name)
    {
        $firstCharactor = strtoupper(substr(Str::slug($product_name), 0, 1));
        $latestProduct = self::orderByDesc('product_id')->where('product_id', 'regexp', $firstCharactor.'[0-9]+')->first();
        $count = 1;
        if ($latestProduct) {
            $count = intval(substr($latestProduct->product_id, 1)) + 1;
        }

        return $firstCharactor . sprintf("%09d", $count);
    }
    public function getProductImageAttribute($value)
    {
         return $value ? Storage::disk('local')->url($value) : null;
        //  Storage::put('/product',$request->product_image)
    }
}
