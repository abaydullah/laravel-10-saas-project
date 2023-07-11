<?php

namespace App\Models;

use App\Models\Traits\HasTwoFactorAuthenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoFactor extends Model
{
    use HasFactory;
    protected $table = 'two_factors';
    protected $fillable = [
        'phone','dial_code','identifier','verified'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($twofactor){
            optional($twofactor->user->twoFactor)->delete();
        });
    }

    public function user()
    {
       return $this->belongsTo(User::class);
    }
    public function isVerified()
    {
       return $this->verified;
    }

}
