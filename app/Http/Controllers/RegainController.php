<?php

namespace App\Http\Controllers;

use App\Regain;
use Illuminate\Http\Request;

class RegainController extends Controller
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
      return view('regains.create');
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
     * @param  \App\Regain  $regain
     * @return \Illuminate\Http\Response
     */
    public function show(Regain $regain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Regain  $regain
     * @return \Illuminate\Http\Response
     */
    public function edit(Regain $regain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Regain  $regain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Regain $regain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Regain  $regain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regain $regain)
    {
        //
    }
}
