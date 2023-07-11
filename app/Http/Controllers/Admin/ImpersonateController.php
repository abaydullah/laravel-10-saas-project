<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImpersonateStoreRequest;

use App\Models\User;
use Illuminate\Http\Request;

class ImpersonateController extends Controller
{
    public function index()
    {
        return view('admin.impersonate.index');
    }
    public function store(ImpersonateStoreRequest $request)
    {
       $user = User::where('email',$request->email)->first();
       session()->put('impersonate',$user->id);
       return redirect('/')->withSuccess('You are now impersonating '.$user->name);
    }

    public function destroy(Request $request)
    {
            session()->forget('impersonate');
        return redirect('/')->withSuccess('You are now Main Account ');
    }
}
