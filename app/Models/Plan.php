<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

   public function isForTeams()
   {
       return $this->teams_enabled === 1;
   }
   public function isNotForTeams()
   {
       return !$this->isForTeams();
   }

   public function scopeActive(Builder $builder)
   {
       return $builder->where('active',true);
   }
   public function scopeExcept(Builder $builder,$planId)
   {
       return $builder->where('id','!=',$planId);
   }
    public function scopeForUsers(Builder $builder)
    {
        return $builder->where('teams_enabled',false);
    }
    public function scopeForTeams(Builder $builder)
    {
        return $builder->where('teams_enabled',true);
    }
}
