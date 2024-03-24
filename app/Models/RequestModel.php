<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    use HasFactory;
    protected $table = 'request';

    public function car()
    {
        return $this->belongsTo(CarsType::class,'car_type','id');
    }

    public function model()
    {
        return $this->belongsTo(CarModels::class,'car_model','id');
    }

    public function request_offers()
    {
        return $this->hasMany(RequestOfferModel::class,'id','request_id');
    }

    public function city_name()
    {
        return $this->belongsTo(Cities::class,'city','id');
    }
}
