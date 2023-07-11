<?php

namespace App\Http\Controllers\Account\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionCancelController extends Controller
{
    public function index()
    {
        return view('account.subscription.cancel.index');
    }

    public function store(Request $request)
    {
        $request->user()->subscription('default')->cancel();


        return redirect()->route('account.index')->withSuccess('Your Subscription has been cancelled.');

    }
}
