<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Models\ExchangeRecords;
use App\Models\Patients;
use App\Models\Pharmacies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return view('exchanges.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $otherDevices = Devices::where('device_brand',"!=","Ubisson")
            ->where("is_active","=",true)
            ->get();

        $ourDevices = Devices::where('device_brand',"=","Ubisson")
            ->where("is_active","=",true)
            ->get();

        $pharmacies = Pharmacies::where("is_active","=",true)
            ->get();

        $otherDeviceBrands = array();
        foreach($otherDevices as $device){
            $otherDeviceBrands[$device->device_brand] = $device->device_brand;
        }

        $otherDeviceModels = array();
        foreach($otherDevices as $device){
            $otherDeviceModels[$device->device_model] = $device->device_model;
        }

        $ourDeviceModels = array();
        foreach($ourDevices as $device){
            $ourDeviceModels[$device->device_model] = $device->device_model;
        }

        $pharmacyArray = array();
        foreach($pharmacies as $pharmacy){
            $pharmacyArray[$pharmacy->pharmacy_account_no] = $pharmacy->pharmacy_name;
        }

        asort($otherDeviceBrands);
        asort($otherDeviceModels);
        asort($ourDeviceModels);
        asort($pharmacyArray);


        return view('exchanges.create')
            ->with('otherDeviceBrands', $otherDeviceBrands)
            ->with('otherDeviceModels', $otherDeviceModels)
            ->with('ourDeviceModels', $ourDeviceModels)
            ->with('pharmacyArray', $pharmacyArray)
            ;
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
            'other_device_brand' => 'required',
            'other_device_model' => 'required',
            'other_device_serial_no' => 'required',
            'our_device_model' => 'required',
            'our_device_serial_no' => 'required',
            'patient_name' => 'required',
            'patient_dob' => 'required',
            'patient_phone' => 'required',
            'patient_email' => 'required',
            'patient_address_1' => 'required',
            'patient_address_2' => 'nullable',
            'patient_city' => 'required',
            'patient_state' => 'required',
            'patient_postcode' => 'required',
            'patient_diabetes_type' => 'required',
            'pharmacy_account_no' => 'required',
        ]);

        // Handle file upload
        if ($request->hasFile('other_device_serial_no_image')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('other_device_serial_no_image')->getClientOriginalName();

            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('other_device_serial_no_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            // Upload Image
            $path = $request->file('other_device_serial_no_image')->storeAs('public/serial_no_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'placeholder.jpg';
        }

        // create new exchange record and patient
        $exchangeRecord = new ExchangeRecords();
        $patient = new Patients();

        // assign values to patient
        $patient->patient_name = $request->input('patient_name');
        $patient->patient_dob = $request->input('patient_dob');
        $patient->patient_phone = $request->input('patient_phone');
        $patient->patient_email = $request->input('patient_email');
        $patient->patient_address_1 = $request->input('patient_address_1');
        $patient->patient_address_2 = $request->input('patient_address_2');
        $patient->patient_city = $request->input('patient_city');
        $patient->patient_state = $request->input('patient_state');
        $patient->patient_postcode = $request->input('patient_postcode');
        $patient->patient_diabetes_type = $request->input('patient_diabetes_type');
        $patient->total_exchanged = 0;
        $patient->save();

        $otherDeviceId = Devices::where('device_brand', $request->input('other_device_brand'))
            ->where('device_model', $request->input('other_device_model'))
            ->first()->id;

        $ourDeviceId = Devices::where('device_brand',"=","Ubisson")
            ->where('device_model', $request->input('our_device_model'))->first()->id;

        $patientId = Patients::where('patient_name',$request->input('patient_name'))->first()->id;

        $pharmacyId = Pharmacies::where('pharmacy_account_no', $request->input('pharmacy_account_no'))->first()->id;
        // assign values to exchange record
        $exchangeRecord->other_device_id = $otherDeviceId;

        $exchangeRecord->our_device_id = $ourDeviceId;

        $exchangeRecord->pharmacy_id = $pharmacyId;

        $device =  Devices::find($otherDeviceId);
        $device->total_exchanged +=1;
        $device->save();

        $device =  Devices::find($ourDeviceId);
        $device->total_exchanged +=1;
        $device->save();

        $patient = Patients::find($patientId);
        $patient->total_exchanged +=1;
        $patient->save();

        $pharmacy = Pharmacies::find($pharmacyId);
        $pharmacy->total_exchanged +=1;
        $pharmacy->save();

        $exchangeRecord->patient_id = $patient->id;
        $exchangeRecord->other_device_serial_no = $request->input('other_device_serial_no');
        $exchangeRecord->our_device_serial_no = $request->input('our_device_serial_no');
        $exchangeRecord->other_device_serial_no_image = $request->input('other_device_serial_no_image');

        if ($request->hasFile('other_device_serial_no_image')) {
            if ($exchangeRecord->other_device_serial_no_image != 'placeholder.jpg') {
                Storage::delete('public/serial_no_images/' . $exchangeRecord->other_device_serial_no_image);
            }
            $exchangeRecord->other_device_serial_no_image = $fileNameToStore;
        }

        $exchangeRecord->save();

        if (Auth::user()) { // If user is logged in, redirect to exchanges list page
            return redirect('/exchanges/'.$exchangeRecord->id)->with('success', 'Control Exchange Detail Added Successfully!');
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

        $exchangeRecord = ExchangeRecords::find($id);

        return view('exchanges.show')
            ->with('exchangeRecord', $exchangeRecord)
            ->with('otherDevice', Devices::find($exchangeRecord->other_device_id))
            ->with('ourDevice', Devices::find($exchangeRecord->our_device_id))
            ->with('pharmacy', Pharmacies::find($exchangeRecord->pharmacy_id))
            ->with('patient', Patients::find($exchangeRecord->patient_id));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exchangeRecord = ExchangeRecords::find($id);

//        dd($exchangeRecord);
        $devices = Devices::all();
        $pharmacies = Pharmacies::all();

        $deviceBrands = array();
        foreach($devices as $device){
            if($device->is_active) {
                $deviceBrands[$device->device_brand] = $device->device_brand;
            }
        }

        $deviceModels = array();
        foreach($devices as $device){
            if($device->is_active) {
                $deviceModels[$device->device_model] = $device->device_model;
            }
        }

        $pharmacyArray = array();
        foreach($pharmacies as $pharmacy){
            $pharmacyArray[$pharmacy->pharmacy_name] = $pharmacy->pharmacy_name;
        }
//        dd($pharmacyArray);

//        dd(Pharmacies::find($exchangeRecord->pharmacy_id));

        return view('exchanges.edit')
            ->with('exchangeRecord', $exchangeRecord)
            ->with('otherDevice', Devices::find($exchangeRecord->other_device_id))
            ->with('ourDevice', Devices::find($exchangeRecord->our_device_id))
            ->with('pharmacy', Pharmacies::find($exchangeRecord->pharmacy_id))
            ->with('patient', Patients::find($exchangeRecord->patient_id))

            ->with('deviceBrands', $deviceBrands)
            ->with('deviceModels', $deviceModels)
            ->with('pharmacyArray', $pharmacyArray)
            ->with('patients', Patients::all());
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
            'other_device_brand' => 'required',
            'other_device_model' => 'required',
            'other_device_serial_no' => 'required',
            'our_device_model' => 'required',
            'our_device_serial_no' => 'required',
            'patient_name' => 'required',
            'patient_dob' => 'required',
            'patient_phone' => 'required',
            'patient_email' => 'required',
            'patient_address_1' => 'required',
            'patient_address_2' => 'nullable',
            'patient_city' => 'required',
            'patient_state' => 'required',
            'patient_postcode' => 'required',
            'patient_diabetes_type' => 'required',
            'pharmacy_name' => 'required',
        ]);

        // Handle file upload
        if ($request->hasFile('other_device_serial_no_image')) {
            // Get filename with extension
            $fileNameWithExt = $request->file('other_device_serial_no_image')->getClientOriginalName();

            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('other_device_serial_no_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

            // Upload Image
            $path = $request->file('other_device_serial_no_image')->storeAs('public/serial_no_images', $fileNameToStore);
        }

        // get the data from table first
        $exchangeRecord = ExchangeRecords::find($id);
        $patient = Patients::find($exchangeRecord->patient_id);

        // backup
        $oldOtherDevice = Devices::find($exchangeRecord->other_device_id);
        $oldOurDevice = Devices::find($exchangeRecord->our_device_id);
        $oldPharmacy = Pharmacies::find($exchangeRecord->pharmacy_id);

        // update patient details
        $patient->patient_name = $request->input('patient_name');
        $patient->patient_dob = $request->input('patient_dob');
        $patient->patient_phone = $request->input('patient_phone');
        $patient->patient_email = $request->input('patient_email');
        $patient->patient_address_1 = $request->input('patient_address_1');
        $patient->patient_address_2 = $request->input('patient_address_2');
        $patient->patient_city = $request->input('patient_city');
        $patient->patient_state = $request->input('patient_state');
        $patient->patient_postcode = $request->input('patient_postcode');
        $patient->patient_diabetes_type = $request->input('patient_diabetes_type');
        $patient->save();



        // the new id for the three foreign key
        $newOtherDevice = Devices::find(
            Devices::where('device_brand', $request->input('other_device_brand'))
                ->where('device_model', $request->input('other_device_model'))
                ->first()->id
        );

        $newOurDevice =  Devices::find(
            Devices::where('device_brand',"Ubisson")
                ->where('device_model', $request->input('our_device_model'))
                ->first()->id
        );

//        dd($request->input('pharmacy_name'));
        $newPharmacy = Pharmacies::find(
            Pharmacies::where('pharmacy_name', $request->input('pharmacy_name'))
                ->first()->id
        );

        // update exchange record details
        $exchangeRecord->other_device_id = $newOtherDevice->id;
        $exchangeRecord->our_device_id = $newOurDevice->id;
        $exchangeRecord->pharmacy_id = $newPharmacy->id;
        $exchangeRecord->other_device_serial_no = $request->input('other_device_serial_no');
        $exchangeRecord->our_device_serial_no = $request->input('our_device_serial_no');
        $exchangeRecord->other_device_serial_no_image = $request->input('other_device_serial_no_image');

        if ($request->hasFile('other_device_serial_no_image')) {
            if ($exchangeRecord->other_device_serial_no_image != 'placeholder.jpg') {
                Storage::delete('public/serial_no_images/' . $exchangeRecord->other_device_serial_no_image);
            }
            $exchangeRecord->other_device_serial_no_image = $fileNameToStore;
        }



        // update other device
        if($oldOtherDevice != $newOtherDevice){
            $oldOtherDevice->total_exchanged -=1;
            $newOtherDevice->total_exchanged +=1;
        }
        $oldOtherDevice->save();
        $newOtherDevice->save();


        // update our device
        if($oldOurDevice != $newOurDevice){
            $oldOurDevice->total_exchanged -=1;
            $newOurDevice->total_exchanged +=1;
        }
        $oldOurDevice->save();
        $newOurDevice->save();

        // update pharmacy
        if($oldPharmacy != $newPharmacy){
            $oldPharmacy->total_exchanged -=1;
            $newPharmacy->total_exchanged +=1;
        }
        $oldPharmacy->save();
        $newPharmacy->save();



        $exchangeRecord->save();

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
        $exchangeRecord = ExchangeRecords::find($id);

        if ($exchangeRecord->serial_no_image != 'placeholder.jpg') {
            // Delete Image
            Storage::delete('public/serial_no_images/' . $exchangeRecord->other_device_serial_no_image);
        }

        $exchangeRecord->delete();
        return redirect('/exchanges')->with('success', 'Control Exchange Detail Deleted Successfully!');
    }

    public function updateDeviceModelOption(Request $request)
    {

        $devices = Devices::where('device_brand','=',$request->devicebrand)
            ->where('is_active',true)
            ->select('device_model')
            ->get();

        $html = "";
        foreach ($devices as $device){
            $html .= "<option>".$device->device_model."</option>";
        }

        return response()->json($html);
    }
}
