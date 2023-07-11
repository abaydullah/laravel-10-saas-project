<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmationToken extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $d = [
       'expires_at' => 'datetime'
    ];

    protected $fillable = [
        'token',
        'expires_at'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($token){
            optional($token->user->confirmationToken)->delete();
        });
    }

    public function getRouteKeyName()
    {
        return 'token';
    }
    public function user(){
     return $this->belongsTo(User::class);
    }

    public function hasExpired()
    {
        return $this->freshTimestamp()->gt($this->expires_at);
    }
}
