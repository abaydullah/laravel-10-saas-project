<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
    public function index()
    {
        $countries = Country::get();
        return view('account.twofactor.index',compact('countries'));
    }
    public function store(DeactivateAccountRequest $request)
    {
        $user = $request->user();
        if ($user->subscription('default')){
            $user->subscription('default')->cancel();
        }
        $user->delete();
        return redirect('/')->withSuccess('Your Account has been Deactivate.');
    }
}
