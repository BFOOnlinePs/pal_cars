<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestOfferModel extends Model
{
    use HasFactory;
    protected $table="request_offer";

    public function request()
    {
        return $this->belongsTo(RequestModel::class,'request_id','id');
    }

    public function offer_by()
    {
        return $this->belongsTo(User::class,'offer_from_user_id','id');
    }
}
