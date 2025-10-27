<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // 多対多リレーション（中間テーブル：product_season）
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_season', 'season_id', 'product_id');
    }
}
