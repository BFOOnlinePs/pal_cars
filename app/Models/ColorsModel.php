<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorsModel extends Model
{
    use HasFactory;
    protected $table = 'colors';

    public function ads()
    {
        return $this->hasMany(CarsAdsModel::class, 'id', 'car_color');
    }
}
