<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    protected $table = 'cities';

    // protected $fillable = [
    //     'city_id'
    // ];
    public function users()
    {
        return $this->hasMany(User::class, 'user_city', 'id');
    }
    public function ads()
    {
        return $this->hasMany(CarsAdsModel::class, 'id', 'visitor_city');
    }

}
