<?php

namespace App\Http\Controllers;

use Validator;
use App\Lotterie;
use Illuminate\Http\Request;

class LotterieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $lotteries = Lotterie::all();
      return view('lotteries.index', compact('lotteries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $lotterie = new Lotterie();
      return view('lotteries.create', compact('lotterie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // validate
      $validator = $request->validate([
        'name' => 'required|unique:lotteries',
        'relation' => 'required',
        'min' => 'required|numeric',
        'max' => 'required|numeric'
      ]);

      // store
      $lotterie = new Lotterie;
      $lotterie->name = $request->name;
      $lotterie->relation = $request->relation;
      $lotterie->min = $request->min;
      $lotterie->max = $request->max;
      $lotterie->save();

      // redirect
      alert()->success('Registro Correcto', 'Nueva Loteria creada')->autoclose(30000);
      return redirect('lotteries');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lotterie  $lotterie
     * @return \Illuminate\Http\Response
     */
    public function show(Lotterie $lotterie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lotterie  $lotterie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $lotterie = Lotterie::findOrFail($id);
      return view('lotteries.edit', compact('lotterie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lotterie  $lotterie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $validator = Validator::make($request->all(), [
        'name' => 'required|max:80',
        'relation' => 'required',
        'min' => 'required|numeric',
        'max' => 'required|numeric'
      ]);

      if ($validator->fails()) {
        return redirect('lotteriesedit')
        ->withErrors($validator)
        ->withInput();
      }

      $lottery = Lotterie::findOrFail($id);

      $lottery->update($request->all());
      alert()->success('Registro Correcto', 'Registro Actualizado')->autoclose(30000);

      return redirect('lotteries');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lotterie  $lotterie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lotterie $lotterie)
    {
        //
    }
  }
