<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTicketDetailRequest;
use App\Http\Requests\UpdateTicketDetailRequest;
use App\Models\TicketDetail;

class TicketDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreTicketDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TicketDetail  $ticketDetail
     * @return \Illuminate\Http\Response
     */
    public function show(TicketDetail $ticketDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TicketDetail  $ticketDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(TicketDetail $ticketDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketDetailRequest  $request
     * @param  \App\Models\TicketDetail  $ticketDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketDetailRequest $request, TicketDetail $ticketDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TicketDetail  $ticketDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketDetail $ticketDetail)
    {
        //
    }
}
