<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecycleResource;
use App\Models\Recycle;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecycleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recycles = Recycle::all();
        return RecycleResource::collection($recycles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "weekDay" => "required|numeric",
            "startTime" => "required|numeric",
            "endTime" => "required|numeric",
            "type" => "required|string"
        ]);

        return Recycle::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Recycle::find($id);
        return new RecycleResource($item);
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
        $item = Recycle::find($id);
        $item->update($request->all());
        return $item;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Recycle::destroy($id);
 
    }

    //return the todays recyles schedule
    public function today()
    {
        $recycles = Recycle::all();
        $response = [];

        $date = new DateTime();
        $weekDay = $date->format('N');

        foreach ($recycles as $item) {
            if ($item->weekDay == $weekDay)
                array_push($response, $item);
        }

        return RecycleResource::collection($response);
    }

}