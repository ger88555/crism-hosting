<?php

namespace App\Http\Controllers;

use App\Models\Wireguard;
use App\Http\Requests\StoreWireguardRequest;
use App\Http\Requests\UpdateWireguardRequest;

class WireguardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWireguardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWireguardRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wireguard  $wireguard
     * @return \Illuminate\Http\Response
     */
    public function show(Wireguard $wireguard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wireguard  $wireguard
     * @return \Illuminate\Http\Response
     */
    public function edit(Wireguard $wireguard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWireguardRequest  $request
     * @param  \App\Models\Wireguard  $wireguard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWireguardRequest $request, Wireguard $wireguard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wireguard  $wireguard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wireguard $wireguard)
    {
        //
    }
}
