<?php

namespace App\Http\Controllers;

use App\Models\Invite;
use Illuminate\Http\Request;

class InviteController extends Controller
{
    protected $request;

    protected $invite;

    public function __construct(Request $request, Invite $invite)
    {
        $this->request = $request;
        $this->invite  = $invite;
    }

    public function index()
    {
        
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        
    }
}
