<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\DeactivateAccountRequest;
use Illuminate\Http\Request;

class DeactivateController extends Controller
{
    public function index()
    {
        return view('account.deactivate.index');
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
