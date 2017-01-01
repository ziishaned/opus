<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Organization;

class CategoryConroller extends Controller
{
	private $request;

    private $organization;

    private $category;

    public function __construct(Request $request, Organization $organization, Category $category)
    {
    	$this->category = $category;
        $this->request      = $request;
        $this->organization = $organization;
    }

    public function index($organizationSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);
        return view('categories.index', compact('organization'));
    }

    public function create($organizationSlug) 
    {
    	$organization = $this->organization->getOrganization($organizationSlug);
    	return view('categories.create', compact('organization'));
    }

    public function store($organizationSlug)
    {
           
    }
}
