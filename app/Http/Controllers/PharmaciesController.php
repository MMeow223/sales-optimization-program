<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Models\Pharmacies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmaciesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Guest can use the 'create' & 'store' function in this controller
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pharmacies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pharmacies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'pharmacy_account_no' => 'required',
            'pharmacy_name' => 'required',
            'pharmacy_address_1' => 'required',
            'pharmacy_city' => 'required',
            'pharmacy_state' => 'required',
            'pharmacy_postcode' => 'required',
            'pharmacy_pic' => 'required',
            'pharmacy_phone' => 'required',
        ]);


        // create new exchange record and patient
        $pharmacy = new Pharmacies();

        $pharmacy->pharmacy_account_no = $request->input('pharmacy_account_no');
        $pharmacy->pharmacy_name = $request->input('pharmacy_name');
        $pharmacy->pharmacy_address_1 = $request->input('pharmacy_address_1');
        $pharmacy->pharmacy_address_2 = $request->input('pharmacy_address_2');
        $pharmacy->pharmacy_city = $request->input('pharmacy_city');
        $pharmacy->pharmacy_state = $request->input('pharmacy_state');
        $pharmacy->pharmacy_postcode = $request->input('pharmacy_postcode');
        $pharmacy->pharmacy_pic = $request->input('pharmacy_pic');
        $pharmacy->pharmacy_phone = $request->input('pharmacy_phone');
        $pharmacy->is_active = true;
        $pharmacy->save();

        if (Auth::user()) { // If user is logged in, redirect to exchanges list page
            return redirect('/pharmacies/'.$pharmacy->id)->with('success', 'Pharmacy Added Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $pharmacy = Pharmacies::find($id);

        return view('pharmacies.show')
            ->with('pharmacy', $pharmacy)
            ;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $pharmacy = Pharmacies::find($id);

        return view('pharmacies.edit')
            ->with('pharmacy', $pharmacy)
            ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'pharmacy_account_no' => 'required',
            'pharmacy_name' => 'required',
            'pharmacy_address_1' => 'required',
            'pharmacy_city' => 'required',
            'pharmacy_state' => 'required',
            'pharmacy_postcode' => 'required',
            'pharmacy_pic' => 'required',
            'pharmacy_phone' => 'required',
        ]);


        $pharmacy = Pharmacies::find($id);
        // create new exchange record and patient
        $pharmacy->pharmacy_account_no = $request->input('pharmacy_account_no');
        $pharmacy->pharmacy_name = $request->input('pharmacy_name');
        $pharmacy->pharmacy_address_1 = $request->input('pharmacy_address_1');
        $pharmacy->pharmacy_address_2 = $request->input('pharmacy_address_2');
        $pharmacy->pharmacy_city = $request->input('pharmacy_city');
        $pharmacy->pharmacy_state = $request->input('pharmacy_state');
        $pharmacy->pharmacy_postcode = $request->input('pharmacy_postcode');
        $pharmacy->pharmacy_pic = $request->input('pharmacy_pic');
        $pharmacy->pharmacy_phone = $request->input('pharmacy_phone');
        $pharmacy->save();

        if (Auth::user()) { // If user is logged in, redirect to exchanges list page
            return redirect('/pharmacies/'.$id)->with('success', 'Pharmacy Edited Successfully!');
        }
    }

    public function deactivate($id)
    {
        $pharmacy = Pharmacies::find($id);
        $pharmacy->is_active = 0;
        $pharmacy->save();

        return redirect('/pharmacies')->with('success', 'Pharmacy Deactivate Successfully!');

    }
    public function activate($id)
    {
        $pharmacy = Pharmacies::find($id);
        $pharmacy->is_active = 1;
        $pharmacy->save();

        return redirect('/pharmacies')->with('success', 'Pharmacy Activate Successfully!');

    }
}
