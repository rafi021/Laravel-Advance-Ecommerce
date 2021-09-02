<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'division_id',
        'district_id',
        'state_id',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_postCode',
        'shipping_address',
        'shipping_notes'
    ];

}
