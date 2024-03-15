<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PartExpoModel;

class CarsType extends Model
{
    use HasFactory;
    protected $table = 'cars_type';


    public function carParts()
    {
        return $this->hasMany(PartExpoModel::class,'id','part_car_type');
    }

    public function car_adv()
    {
        return $this->hasMany(CarsAdsModel::class,'id','car_type');
    }

    public function request_part()
    {
        return $this->hasMany(RequestModel::class,'id','car_type');
    }



}
