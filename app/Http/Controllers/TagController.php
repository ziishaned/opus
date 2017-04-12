<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * Class TagController
 *
 * @package App\Http\Controllers
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class TagController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \App\Models\Tag
     */
    protected $tag;

    /**
     * TagController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag          $tag
     */
    public function __construct(Request $request, Tag $tag)
    {
        $this->tag     = $tag;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->tag->filterTags($this->request->get('q'));
    }
}
