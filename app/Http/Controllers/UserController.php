<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    public function __construct(Request $request, User $user)
    {
        $this->user     = $user;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->user->getUsers();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->user->getUser($id);
    }
}
