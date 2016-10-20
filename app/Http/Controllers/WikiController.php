<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use App\Models\WikiPage;
use App\Models\Organization;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class WikiController extends Controller
{
    /**
     * @var \App\Models\Wiki
     */
    protected $wiki;

    /**
     * @var \App\Models\WikiPage
     */
    protected $wikiPage;

    /**
     * @var \App\Models\Organization
     */
    protected $organization;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * WikiController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wiki         $wiki
     */
    public function __construct(Request $request, Wiki $wiki, Organization $organization, WikiPage $wikiPage) {
        $this->wiki         = $wiki;
        $this->request      = $request;
        $this->wikiPage     = $wikiPage;
        $this->organization = $organization;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->wiki->getWikis();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($organizationId = null)
    {
        return view('wiki.create', compact('organizationId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {        
        $this->validate($this->request, Wiki::WIKI_RULES);
        if($this->request->get('organization_id')) {
            $member = $this->organization->isMember(Auth::user()->id, $this->request->get('organization_id'));
            if(!$member) {
                abort(404);
            }
        }

        $wiki = $this->wiki->saveWiki($this->request->all());

        return redirect()->route('wikis.show', $wiki->id)->with([
            'alert' => 'Wiki successfully created.',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wiki = $this->wiki->getWiki($id);
        if(!$wiki) {
            abort('404');
        }
        
        $wikiPages = $this->wikiPage->getPages($id);
        if($wikiPages) {
            return view('wiki.wiki', compact('wikiPages', 'wiki'));
        }
        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wiki = $this->wiki->getWiki($id);
        return view('wiki.edit', compact('wiki'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $this->validate($this->request, Wiki::WIKI_RULES);
        $this->wiki->updateWiki($id, $this->request->all());
        return redirect()->route('wikis.show', $id)->with([
            'alert' => 'Wiki successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wikiDeleted = $this->wiki->deleteWiki($id);
        if($wikiDeleted) {
            return redirect()->route('dashboard')->with([
                'alert' => 'Wiki successfully deleted.',
                'alert_type' => 'success'
            ]);
        }
        return response()->json([
            'message' => 'We are having some issues.'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function createPage($id)
    {
        $wikiId = $id;
        return view('wiki.page.create', compact('wikiId'));
    }

    public function filterWikis($text)
    {
        return $this->wiki->filterWikis($text);
    }

    public function filterWikiPages($wikiId, $text)
    {
        return $this->wikiPage->filterWikiPages($wikiId, $text);
    }

    public function storePage($wikiId)
    {
        $this->validate($this->request, Wiki::WIKI_PAGE_RULES);
        $pageId = $this->wikiPage->saveWikiPage($wikiId, $this->request->all());
        return redirect()->route('wikis.pages.show', [$wikiId, $pageId])->with([
            'alert'      => 'Page successfully created.',
            'alert_type' => 'success'
        ]);
    }

    public function showPage($wikiId, $pageId)
    {
        $page = $this->wikiPage->getPage($pageId);
        if(!$page) {
            abort('404');
        }
        
        $wikiPages = $this->wikiPage->getPages($wikiId);
        if($wikiPages) {
            return view('wiki.page.page', compact('wikiId', 'wikiPages', 'page'));
        }
        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    public function editPage($wikiId, $pageId)
    {
        $page = $this->wikiPage->getPage($pageId);
        return view('wiki.page.edit', compact('wikiId', 'page'));
    }

    public function updatePage($wikiId, $pageId)
    {
        $this->wikiPage->updatePage($pageId, $this->request->all());
        return redirect()->route('wikis.pages.show', [$wikiId, $pageId])->with([
            'alert'      => 'Page successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    public function destroyPage($wikiId, $pageId)
    {
        $pageDeleted = $this->wikiPage->deletePage($pageId);
        if($pageDeleted) {
            return redirect()->route('wikis.show', $wikiId)->with([
                'alert' => 'Page successfully deleted.',
                'alert_type' => 'success'
            ]);
        }
        return response()->json([
            'message' => 'We are having some issues.'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);   
    }

    public function starPage($id)
    {
        $star = $this->wikiPage->star($id);
        if($star) {
            return response()->json([
                'star' => true
            ], Response::HTTP_CREATED);          
        }
        return response()->json([
            'unstar' => true
        ], Response::HTTP_ACCEPTED);          
    }
}
