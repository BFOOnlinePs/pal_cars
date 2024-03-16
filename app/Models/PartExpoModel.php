<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartExpoModel extends Model
{
    use HasFactory;
    protected $table = 'part_expo';


    public function car()
    {
        return $this->belongsTo(CarsType::class,'part_car_type','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'insert_by','id');
    }

    public function carType()
    {
        return $this->belongsTo(CarsType::class,'part_car_type','id');
    }

    public function partImages(){
        return $this->hasMany(PartExpoImagesModel::class, 'id', 'part_id');
    }


}
