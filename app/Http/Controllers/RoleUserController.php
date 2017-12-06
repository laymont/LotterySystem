<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Role_user;
use Illuminate\Http\Request;
use DB;

class RoleUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $role_user = User::where('deleted_at',null)->with('roles')->get();
      return view('roles.index', compact('role_user'));
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
     * @param  \App\Role_user  $role_user
     * @return \Illuminate\Http\Response
     */
    public function show(Role_user $role_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role_user  $role_user
     * @return \Illuminate\Http\Response
     */
    public function edit(Role_user $role_user)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role_user  $role_user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role_user $role_user)
    {
      $role = Role_user::where('user_id', $request->user_id)
      ->first();
      $role->role_id = $request->input('role_id');
      $role->save();
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role_user  $role_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role_user $role_user)
    {
        //
    }
  }
