<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Categories';
    protected $fillable = [
        'ProductType'
    ];
    // protected $guarded = [];
    public function product()
    {
        return $this->hasMany(Product::class,'Category_Id');
    }
}
