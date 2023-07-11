<?php

namespace App\Http\Controllers\Account\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\SubscriptionTeamMemberStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionTeamMemberController extends Controller
{
    public function store(SubscriptionTeamMemberStoreRequest $request)
    {
        if ($this->teamLimitReached($request)){
            return back()->withError('You have reached the limit for your plan.');
        }

        $request->user()->team->users()->syncWithoutDetaching([
          User::where('email',$request->email)->first()->id
        ]);


        return back()->withSuccess('Team Member Added.');
    }
    public function destroy(User $user , Request $request)
    {
        $request->user()->team->users()->detach($user->id);


        return back()->withSuccess('Team Member has been Deleted.');
    }
    public function teamLimitReached($request)
    {
        return $request->user()->team->users->count() === $request->user()->plan->teams_limit;
    }
}
