<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Products';
    protected $fillable = [
          'name',
          'info',
          'image',
          'Price',
          'Stock',
          'Category_Id'
    ];
    // protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class,'Category_Id');
    }
}
