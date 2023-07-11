<?php
namespace App\Models\Traits;

trait HasSubsciptions
{
    public function HasTeamSubsciption()
    {

        return optional($this->plan())->isForTeams();
    }
    public function HasTeamNotSubsciption()
    {


        return !$this->HasTeamSubsciption();
    }
    public function HasPiggybackSubsciption()
    {
        foreach ($this->teams as $team){
            if($team->owner->HasSubsciption()){
                return true;
            }
        }
        return false;
    }

    public function HasSubsciption()
    {
            if ($this->HasPiggybackSubsciption()){
                return true;
            }

        return $this->subscribed('default');
    }
    public function HasNotSubsciption()
    {


        return !$this->HasSubsciption();
    }

    public function HasCanceled()
    {


        return optional($this->subscription('default'))->canceled();
    }
    public function HasNotCanceled()
    {

        return !$this->HasCanceled();
    }
    public function isCustomer()
    {

        return $this->hasStripeId();
    }
}
