<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarsAdsModel extends Model
{
    use HasFactory;
    protected $table = 'cars_ads';

    public function carType()
    {
        return $this->belongsTo(CarsType::class,'car_type','id');
    }
    public function visitorCity()
    {
        return $this->belongsTo(Cities::class,'visitor_city','id');
    }
    public function color()
    {
        return $this->belongsTo(ColorsModel::class,'car_color','id');
    }
    public function model()
    {
        return $this->belongsTo(CarModels::class,'car_model','id');
    }
}
