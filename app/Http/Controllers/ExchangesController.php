<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Exchange;
use Illuminate\Support\Facades\Auth;

class ExchangesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Guest can use the 'create' & 'store' function in this controller
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $exchanges = Exchange::all();

        $exchanges = Exchange::orderBy('updated_at', 'desc')->paginate(4);
        return view('exchanges.index')->with('exchanges', $exchanges);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exchanges.create');
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
            'brand' => 'required',
            'model' => 'required',
            'serial_no' => 'required',
            'serial_no_image' => 'image|nullable|max:1999',
            'exchange_model' => 'required',
            'exchange_serial_no' => 'required',
            'patient_name' => 'required',
            'patient_dob' => 'required',
            'patient_phone_no' => 'required',
            'patient_email' => 'required',
            'patient_addr_1' => 'required',
            'patient_addr_2' => 'nullable',
            'patient_city' => 'required',
            'patient_state' => 'required',
            'patient_zipcode' => 'required',
            'patient_diabetes' => 'required',
            'pharmacy_name' => 'required',
            'pharmacy_account_no' => 'required',
            'pharmacy_addr_1' => 'required',
            'pharmacy_city' => 'required',
            'pharmacy_state' => 'required',
            'pharmacy_zipcode' => 'required',
            'pharmacy_pic' => 'required',
            'pharmacy_contact' => 'required'
        ]);

        // Handle file upload
        if ($request->hasFile('serial_no_image')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('serial_no_image')->getClientOriginalName();

            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('serial_no_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            // Upload Image
            $path = $request->file('serial_no_image')->storeAs('public/serial_no_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'placeholder.jpg';
        }

        $exchange = new Exchange;
        $exchange->brand = $request->input('brand');
        $exchange->model = $request->input('model');
        $exchange->serial_no = $request->input('serial_no');
        $exchange->serial_no_image = $fileNameToStore;
        $exchange->exchange_model = $request->input('exchange_model');
        $exchange->exchange_serial_no = $request->input('exchange_serial_no');

        $exchange->patient_name = $request->input('patient_name');
        $exchange->patient_dob = $request->input('patient_dob');
        $exchange->patient_phone_no = $request->input('patient_phone_no');
        $exchange->patient_email = $request->input('patient_email');
        $exchange->patient_addr_1 = $request->input('patient_addr_1');
        $exchange->patient_addr_2 = $request->input('patient_addr_2');
        $exchange->patient_city = $request->input('patient_city');
        $exchange->patient_state = $request->input('patient_state');
        $exchange->patient_zipcode = $request->input('patient_zipcode');
        $exchange->patient_diabetes = $request->input('patient_diabetes');

        $exchange->pharmacy_name = $request->input('pharmacy_name');
        $exchange->pharmacy_account_no = $request->input('pharmacy_account_no');
        $exchange->pharmacy_addr_1 = $request->input('pharmacy_addr_1');
        $exchange->pharmacy_addr_2 = $request->input('pharmacy_addr_2');
        $exchange->pharmacy_city = $request->input('pharmacy_city');
        $exchange->pharmacy_state = $request->input('pharmacy_state');
        $exchange->pharmacy_zipcode = $request->input('pharmacy_zipcode');
        $exchange->pharmacy_pic = $request->input('pharmacy_pic');
        $exchange->pharmacy_contact = $request->input('pharmacy_contact');
        $exchange->save();

        if (Auth::user()) { // If user is logged in, redirect to exchanges list page
            return redirect('/exchanges')->with('success', 'Control Exchange Detail Added Successfully!');
        } else { // If user is guest, redirect to create page
            return redirect('/exchanges/create')->with('success', 'Control Exchange Detail Added Successfully!');
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
        $exchange = Exchange::find($id);
        return view('exchanges.show')->with('exchange', $exchange);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exchange = Exchange::find($id);
        return view('exchanges.edit')->with('exchange', $exchange);
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
            'brand' => 'required',
            'model' => 'required',
            'serial_no' => 'required',
            'exchange_model' => 'required',
            'exchange_serial_no' => 'required',
            'patient_name' => 'required',
            'patient_dob' => 'required',
            'patient_phone_no' => 'required',
            'patient_email' => 'required',
            'patient_addr_1' => 'required',
            'patient_addr_2' => 'nullable',
            'patient_city' => 'required',
            'patient_state' => 'required',
            'patient_zipcode' => 'required',
            'patient_diabetes' => 'required',
            'pharmacy_name' => 'required',
            'pharmacy_account_no' => 'required',
            'pharmacy_addr_1' => 'required',
            'pharmacy_city' => 'required',
            'pharmacy_state' => 'required',
            'pharmacy_zipcode' => 'required',
            'pharmacy_pic' => 'required',
            'pharmacy_contact' => 'required'
        ]);

        // Handle file upload
        if ($request->hasFile('serial_no_image')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('serial_no_image')->getClientOriginalName();

            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('serial_no_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            // Upload Image
            $path = $request->file('serial_no_image')->storeAs('public/serial_no_images', $fileNameToStore);
        }

        $exchange = Exchange::find($id);
        $exchange->brand = $request->input('brand');
        $exchange->model = $request->input('model');
        $exchange->serial_no = $request->input('serial_no');
        if ($request->hasFile('serial_no_image')) {
            if ($exchange->serial_no_image != 'placeholder.jpg') {
                Storage::delete('public/serial_no_images/' . $exchange->serial_no_image);
            }
            $exchange->serial_no_image = $fileNameToStore;
        }
        $exchange->exchange_model = $request->input('exchange_model');
        $exchange->exchange_serial_no = $request->input('exchange_serial_no');

        $exchange->patient_name = $request->input('patient_name');
        $exchange->patient_dob = $request->input('patient_dob');
        $exchange->patient_phone_no = $request->input('patient_phone_no');
        $exchange->patient_email = $request->input('patient_email');
        $exchange->patient_addr_1 = $request->input('patient_addr_1');
        $exchange->patient_addr_2 = $request->input('patient_addr_2');
        $exchange->patient_city = $request->input('patient_city');
        $exchange->patient_state = $request->input('patient_state');
        $exchange->patient_zipcode = $request->input('patient_zipcode');
        $exchange->patient_diabetes = $request->input('patient_diabetes');

        $exchange->pharmacy_name = $request->input('pharmacy_name');
        $exchange->pharmacy_account_no = $request->input('pharmacy_account_no');
        $exchange->pharmacy_addr_1 = $request->input('pharmacy_addr_1');
        $exchange->pharmacy_addr_2 = $request->input('pharmacy_addr_2');
        $exchange->pharmacy_city = $request->input('pharmacy_city');
        $exchange->pharmacy_state = $request->input('pharmacy_state');
        $exchange->pharmacy_zipcode = $request->input('pharmacy_zipcode');
        $exchange->pharmacy_pic = $request->input('pharmacy_pic');
        $exchange->pharmacy_contact = $request->input('pharmacy_contact');
        $exchange->save();

        return redirect('/exchanges/'.$id)->with('success', 'Control Exchange Detail Edited Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exchange = Exchange::find($id);

        if ($exchange->serial_no_image != 'placeholder.jpg') {
            // Delete Image
            Storage::delete('public/serial_no_images/' . $exchange->serial_no_image);
        }

        $exchange->delete();
        return redirect('/exchanges')->with('success', 'Control Exchange Detail Deleted Successfully!');
    }
}
