<?php

namespace App\Http\Controllers\Account\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionCardController extends Controller
{
    public function index()
    {
        $intent = auth()->user()->createSetupIntent();
        return view('account.subscription.card.index',compact('intent'));
    }

    public function store(Request $request)
    {
        $request->user()->updateDefaultPaymentMethodFromStripe($request->token);


        return redirect()->route('account.index')->withSuccess('Your Card has been updated.');

    }
}
