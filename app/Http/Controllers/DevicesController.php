<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Models\ExchangeRecords;
use App\Models\Patients;
use App\Models\Pharmacies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DevicesController extends Controller
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
        return view('devices.index')
            ->with('devices', Devices::orderBy('device_brand', 'asc')
                ->orderBy('device_model', 'asc')
                ->paginate(15));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.create');
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
            'device_brand' => 'required',
            'device_model' => 'required',
        ]);


        // create new exchange record and patient
        $device = new Devices();

        // assign values to patient
        $device->device_brand = $request->input('device_brand');
        $device->device_model = $request->input('device_model');
        $device->is_active = true;
        $device->total_exchanged = 0;
        $device->save();

        if (Auth::user()) { // If user is logged in, redirect to exchanges list page
            return redirect('/devices/'.$device->id)->with('success', 'Device Added Successfully!');
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

        $device = Devices::find($id);

        return view('devices.show')
            ->with('device', $device)
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

        $device = Devices::find($id);

        return view('devices.edit')
            ->with('device', $device)
            ;
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
            'device_brand' => 'required',
            'device_model' => 'required',

        ]);

        // get the data from table first
        $devices = Devices::find($id);

        $devices->device_brand = $request->input('device_brand');
        $devices->device_model = $request->input('device_model');
        $devices->save();

        return redirect('/devices/'.$id)->with('success', 'Device Details Edited Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Devices::find($id);
        $device->delete();
        dd($device);

        return redirect('/devices')->with('success', 'Device Deleted Successfully!');
    }

    public function deactivate($id)
    {
        $device = Devices::find($id);
        $device->is_active = 0;
        $device->save();

        return redirect('/devices')->with('success', 'Device Deactivate Successfully!');

    }
    public function activate($id)
    {
        $device = Devices::find($id);
        $device->is_active = 1;
        $device->save();

        return redirect('/devices')->with('success', 'Device Activate Successfully!');

    }
}
