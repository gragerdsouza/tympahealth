<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Http\Requests\DeviceRequest;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\DeviceCollection;
use Illuminate\Support\Str;

class DeviceController extends Controller
{
    /**
     * Function to get all devices
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Get all devices from the database
        $search = empty($request->query('query')) ? '' : trim($request->query('query'));
        $devices = new DeviceCollection(Device::search($search)->paginate(10));
        //$devices = new DeviceCollection(Device::all());
        return $devices->response();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Function to create an device.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeviceRequest $request)
    {
        //validate required parameters or fields
        $request->validated();

        //Create the new device into the database
        return new DeviceResource(
            Device::create([
            'id' => Str::uuid(), //unique UUID/Identifier
            'model' => $request->get('model'),
            'brand' => $request->get('brand'),
            'release_date' => $request->get('release_date'),
            'os' => $request->get('os'),
            'is_new' => $request->get('is_new'),
            'received_datatime' => $request->get('received_datatime'),
        ]));
    }

    /**
     * Function to get an device
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Find the specific device from the database
        return new DeviceResource(Device::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified device from the devices.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeviceRequest $request, $id)
    {
        //validate required parameters or fields
        $request->validated();
        
        //Find the device id from the database
        $device = Device::find($id);

        //Update all the necessary fields and save into database
        $device->model = $request->input('model');
        $device->brand = $request->input('brand');
        $device->release_date = $request->input('release_date');
        $device->os = $request->input('os');
        $device->is_new = $request->input('is_new');
        $device->save();

        //Json response if its valid or updated
        return response()->json([
            'status' => true,
            'message' => "Device Updated successfully!",
        ], 200);
    }

    /**
     * Remove the specified device from the devices.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Find the device id and delete from the database
        Device::find($id)->delete();
       
        //Json response if its valid or deleted
        $reponse = array('message' => 'The device has been sucessfully deleted','status' => '200');
        return response()->json([
           'data'=> $reponse], 200);
    }
}