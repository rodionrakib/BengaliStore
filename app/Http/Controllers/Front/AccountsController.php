<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function profile()
    {
    	$customer = auth()->user();
    	return view('front.accounts.profile',compact('customer'));
    }

    public function address()
    {
    	$customer = auth()->user();
        $addresses = $customer->addresses;

    	return view('front.accounts.address',compact('customer','addresses'));
    }

    public function order()
    {
    	$customer = auth()->user();
    	return view('front.accounts.order',compact('customer'));
    }
}
