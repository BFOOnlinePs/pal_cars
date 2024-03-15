<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccidentsModel extends Model
{
    use HasFactory;
    protected $table = 'accidents';

    public function insurance_company()
    {
        return $this->belongsTo(User::class, 'Insurance_company_id', 'id');

    }

    public function visitor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
