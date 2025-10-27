<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
    ];


    public function seasons()
    {
    return $this->belongsToMany(Season::class, 'product_season');
     }

    public function scopeProductSearch($query,$product)
    {
       if(!empty($product)){
         $query->where('name',$product);
       }
    }

    public function scopeKeywordSearch($query,$keyword)
    {
       if(!empty($keyword)){
         $query->where('name','like','%'.$keyword.'%');
       }
    }

    public function scopeSortByPrice($query, $sortOrder)
  {
    if ($sortOrder === 'price_asc') {
        // 価格が安い順
        return $query->orderBy('price', 'asc');
    }

    if ($sortOrder === 'price_desc') {
        // 価格が高い順
        return $query->orderBy('price', 'desc');
    }

    // 並び替え指定がない場合はそのまま
    return $query;
  }
}
