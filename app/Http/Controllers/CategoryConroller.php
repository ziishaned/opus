<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class CategoryConroller extends Controller
{
	/**
     * @var \Illuminate\Http\Request
     */
	private $request;

	/**
     * @var \App\Models\Organization
     */
    private $organization;

    public function __construct(Request $request, Organization $organization)
    {
    	$this->request 		= $request;
    	$this->organization = $organization;
    }

    public function create($organizationSlug) 
    {
    	$organization = $this->organization->getOrganization($organizationSlug);
    	return view('categories.create', compact('organization'));
    }
}
