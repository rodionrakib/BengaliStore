<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = auth()->user();
        
        return view('front.accounts.address', [
            'customer' => $customer,
            'addresses' => $customer->addresses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = auth()->user();
        return view('front.address.create',compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'alias' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        
        $attributes = $request->only(['alias','address','zip','phone']);
        auth()->user()->addresses()->create($attributes);
        return redirect()->route('accounts.address')->with('message','Address Created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerAddress $address)
    {
        return view('front.address.edit',compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerAddress $address)
    {
        if(!auth()->user()->addresses->contains($address))
        {
            abort(403);
        }
        $address->update($request->all());
        return redirect()->route('accounts.address')->with('message','Address Updated');    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerAddress $address)
    {
        if(!auth()->user()->addresses->contains($address))
        {
            abort(403);
        }
        $address->delete();
        return redirect()->route('accounts.address')->with('message','Address deleted'); 
    }
}
