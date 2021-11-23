<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EventParawisata;
use Illuminate\Http\Request;

class EventParawisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.event_parawisata.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventParawisata  $eventParawisata
     * @return \Illuminate\Http\Response
     */
    public function show(EventParawisata $eventParawisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventParawisata  $eventParawisata
     * @return \Illuminate\Http\Response
     */
    public function edit(EventParawisata $eventParawisata)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventParawisata  $eventParawisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventParawisata $eventParawisata)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventParawisata  $eventParawisata
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventParawisata $eventParawisata)
    {
        //
    }
}
