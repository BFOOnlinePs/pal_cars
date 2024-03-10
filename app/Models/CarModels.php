<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarModels extends Model
{
    use HasFactory;
    protected $table = 'car_models';

    public function model_parts()
    {
        return $this->hasMany(PartAcceptModelsModel::class,'id','part_model_id');
    }
    public function adv()
    {
        return $this->hasMany(CarsAdsModel::class,'id','car_model');
    }


}
