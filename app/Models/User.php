<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\HasConfirmationTokens;
use App\Models\Traits\HasRoles;
use App\Models\Traits\HasSubsciptions;
use App\Models\Traits\HasTwoFactorAuthenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasConfirmationTokens,Billable,HasSubsciptions,SoftDeletes,HasTwoFactorAuthenticate,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'activated'
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

    public function hasActivated()
    {
        return $this->activated;
    }

    public function hasNotActivated()
    {
        return !$this->hasActivated();
    }
    public function team()
    {
        return $this->hasOne(Team::class);
    }
    public function getPlanAttribute()
    {
        return $this->plan();
    }
       public function plan()
    {
        return $this->plans->first();
    }


    public function plans()
    {
        return $this->hasManyThrough(Plan::class,Subscription::class,'user_id','gateway_id','id','stripe_price')->orderBy('subscriptions.created_at','desc');
    }
    public function teams(){
        return $this->belongsToMany(Team::class);
    }
}
