<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function viewCustomerForm()
    {
        return view('customer-form');
    }

    public function submitCustomerForm(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'desired_budget'=>'required|numeric',
            'message' => 'string|nullable'
         ]);

        \App\Models\Customer::create($request->all());
        return redirect()->back()->with('success', 'data submitted successfully');
    }
}
