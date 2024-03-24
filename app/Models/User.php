<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_phone1',
        'user_phone2',
        'user_role',
        'user_status',
        'user_reg_date',
        'user_photo',
        'user_notes',
        'user_city',
        'user_website',
        'user_address',
        'user_category',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function carPartPerson()
    {
        return $this->hasMany(PartExpoModel::class,'id','insert_by');
    }

    public function city()
    {
        return $this->belongsTo(Cities::class, 'user_city', 'id');
    }

    public function accidents()
    {
        return $this->hasMany(AccidentsModel::class,'id','Insurance_company_id');
    }

    public function people_accident()
    {
        return $this->hasMany(AccidentsModel::class,'id','user_id');
    }

    public function request_offers()
    {
        return $this->hasMany(RequestOfferModel::class,'id','offer_from_user_id');
    }
}
