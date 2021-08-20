<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipState extends Model
{
    use HasFactory;
    protected $fillable = [
        'division_id',
        'district_id',
        'state_name',
    ];

    public function division()
    {
        return $this->belongsTo(ShipDivision::class, 'division_id','id');
    }

    public function district()
    {
        return $this->belongsTo(ShipDistrict::class, 'district_id','id');
    }
}
