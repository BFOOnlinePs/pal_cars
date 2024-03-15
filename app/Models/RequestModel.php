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
}
