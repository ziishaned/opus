<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    protected $organization;

    public function __construct(Organization $organization) {
        $this->organization = $organization;
    }
}
