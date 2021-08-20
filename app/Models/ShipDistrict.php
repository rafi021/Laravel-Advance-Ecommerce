<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDistrict extends Model
{
    use HasFactory;

    protected $fillable = [
        'division_id',
        'district_name',
    ];

    public function division()
    {
        return $this->belongsTo(ShipDivision::class, 'division_id','id');
    }
}
