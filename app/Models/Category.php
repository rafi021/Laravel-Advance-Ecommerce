<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name_en',
        'category_name_bn',
        'category_slug_en',
        'category_slug_bn',
        'category_image'
    ];

    public function subcategory()
    {
        return $this->belongsTo(Category::class);
    }
}
