<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'slider_name',
        'slider_title',
        'slider_description',
        'slider_image',
        'slider_status',
    ];

    public function getSliderImageAttribute($value)
    {
        if ($value) {
            return url('upload/brands/' . $value);
        } else {
            return url('uploads/images/default.png');
        }
    }

}
