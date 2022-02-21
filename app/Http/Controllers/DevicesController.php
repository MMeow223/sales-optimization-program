<?php

namespace App\Http\Controllers;

use App\Models\Devices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DevicesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('devices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('devices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'device_brand' => 'required',
            'device_model' => 'required',
        ]);

        $device  = Devices::query()->create(
            [
                'device_brand' => $request->input('device_brand'),
                'device_model' => $request->input('device_model'),
                'is_active' => true,
                'total_exchanged' => 0,
            ]
        );

        if (Auth::user()) { // If user is logged in, redirect to exchanges list page
            return redirect('/devices/'.$device->id)->with('success', 'Device Added Successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        return view('devices.show')
            ->with('device', Devices::find($id))
            ;
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        return view('devices.edit')
            ->with('device', Devices::find($id))
            ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Application|Redirector|RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'device_brand' => 'required',
            'device_model' => 'required',
        ]);

        DB::table('devices')
            ->where('id',$id)
            ->update([
                'device_brand' => $request->input('device_brand'),
                'device_model' => $request->input('device_model'),
            ]);

        return redirect('/devices/'.$id)->with('success', 'Device Details Edited Successfully!');
    }

    /**
     * Deactivate the is_active field of the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function deactivate($id)
    {
        DB::table('devices')
            ->where('id',$id)
            ->update(['is_active' => 0]);

        return redirect('/devices')->with('success', 'Device Deactivate Successfully!');

    }

    /**
     * Activate the is_active field of the specified resource in storage.
     *
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function activate($id)
    {
        $device = Devices::find($id);
        $device->is_active = 1;
        $device->save();

        return redirect('/devices')->with('success', 'Device Activate Successfully!');
    }
}
