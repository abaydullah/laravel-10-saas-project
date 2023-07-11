<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Plan::active()->get();
        $intent = auth()->user()->createSetupIntent();
        return view('subscription.index',compact('plans','intent'));
    }
    public function store(SubscriptionStoreRequest $request)
    {
          $subscription =  $request->user()->newSubscription('default',$request->plan);

              if ($request->has('coupon_code')){
                  $subscription->withCoupon($request->coupon_code);
              }

        $subscription->create($request->token);

            return redirect('/')->withSuccess('Thanks for becoming a subscriber.');
    }
}
