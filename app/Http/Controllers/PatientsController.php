<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use App\Models\ExchangeRecords;
use App\Models\patients;
use App\Models\Pharmacies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PatientsController extends Controller
{

    public function __construct()
    {
        // Guest can use the 'create' & 'store' function in this controller
        $this->middleware('auth');
    }

    public function index()
    {
        return view('patients.index');
    }

    public function create()
    {
        return view('patients.create');
    }

    public function show($id)
    {

        $patient = Patients::find($id);

        return view('patients.show')
            ->with('patient', $patient)
            ;
    }

    public function edit($id)
    {
        $patient = Patients::find($id);

        return view('patients.edit')
            ->with('patient', $patient)
            ;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
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
        ]);

        // get the data from table first
        $patient = Patients::find($id);

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

        return redirect('/patients/'.$id)->with('success', 'Patient Details Edited Successfully!');
    }
}
