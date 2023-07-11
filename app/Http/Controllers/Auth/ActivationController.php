<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ConfirmationToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['confirmation_token.expired:/']);
    }

    public function activate(ConfirmationToken $token, Request $request)
    {
        $token->user->update([
          'activated' => true
        ]);
     // $token->delete();
        Auth::loginUsingId($token->user->id);
        return redirect(route('dashboard'))->withSuccess('Your Account Is Activated');
    }
}
