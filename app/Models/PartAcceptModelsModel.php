<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartAcceptModelsModel extends Model
{
    use HasFactory;
    protected $table = 'part_accept_models';

    public function accepted_model()
    {
        // return $this->belongsTo(CarsType::class,'part_car_type','id');
        return $this->belongsTo(CarModels::class, 'part_model_id', 'id');
    }

    public function carModel()
    {
        return $this->belongsTo(CarModels::class, 'part_model_id', 'id');
    }
}
