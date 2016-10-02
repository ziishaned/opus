<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use App\Http\Requests;
use Illuminate\Http\Request;

class WikiController extends Controller
{
    protected $wiki;

    public function __construct(Wiki $wiki) {
        $this->wiki = $wiki;
    }
}
