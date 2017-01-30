<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class ReportConroller extends Controller
{
	private $request;

    private $organization;

	public function __construct(Request $request, Organization $organization)
	{
		$this->request = $request;
		$this->organization = $organization;
	}

    public function index(Organization $organization)
    {
    	return view('organization.report', compact('organization'));
    }
}
