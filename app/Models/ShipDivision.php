<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDivision extends Model
{
    use HasFactory;

    protected $fillable = ['division_name'];

    public function districts()
    {
        return $this->hasMany(ShipDistrict::class, 'division_id','id');
    }

    public function states()
    {
        return $this->hasMany(ShipState::class, 'id','state_id');
    }
}
