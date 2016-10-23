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
    public function create($organizationSlug = null)
    {

        if(!is_null($organizationSlug)) {
            $organization = $this->organization->getOrganization($organizationSlug);
        } else {
            $organization = null;
        }
        return view('wiki.create', compact('organization'));
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

        return redirect()->route('wikis.show', $wiki->slug)->with([
            'alert' => 'Wiki successfully created.',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $nameSlug
     * @return \Illuminate\Http\Response
     */
    public function show($nameSlug)
    {
        $wiki = $this->wiki->getWiki($nameSlug);
        if(!$wiki) {
            abort('404');
        }
        
        $wikiPages = $this->wikiPage->getPages($wiki->id);
        return view('wiki.wiki', compact('wikiPages', 'wiki'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($nameSlug)
    {
        $wiki = $this->wiki->getWiki($nameSlug);
        return view('wiki.edit', compact('wiki'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $nameSlug
     * @return \Illuminate\Http\Response
     */
    public function update($nameSlug)
    {
        $this->validate($this->request, Wiki::WIKI_RULES);
        $this->wiki->updateWiki($nameSlug, $this->request->all());
        return redirect()->route('wikis.show', $nameSlug)->with([
            'alert' => 'Wiki successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $nameSlug
     * @return \Illuminate\Http\Response
     */
    public function destroy($nameSlug)
    {
        $wikiDeleted = $this->wiki->deleteWiki($nameSlug);
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

    public function createPage($wikiSlug)
    {
        $wiki = $this->wiki->getWiki($wikiSlug);
        return view('wiki.page.create', compact('wiki'));
    }

    public function filterWikis($text)
    {
        return $this->wiki->filterWikis($text);
    }

    public function filterWikiPages($wikiId, $text)
    {
        return $this->wikiPage->filterWikiPages($wikiId, $text);
    }

    public function storePage($wikiSlug)
    {
        $this->validate($this->request, Wiki::WIKI_PAGE_RULES);
        $page = $this->wikiPage->saveWikiPage($wikiSlug, $this->request->all());
        return redirect()->route('wikis.pages.show', [$wikiSlug, $page->slug])->with([
            'alert'      => 'Page successfully created.',
            'alert_type' => 'success'
        ]);
    }

    public function showPage($wikiSlug, $pageSlug)
    {
        $page = $this->wikiPage->getPage($pageSlug);
        if(!$page) {
            abort('404');
        }
        
        $wikiPages = $this->wikiPage->getPages($pageSlug);
        if($wikiPages) {
            return view('wiki.page.page', compact('wikiPages', 'page'));
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

    public function pagesReorder($id)
    {
        $wiki = $this->wiki->getWiki($id);        
        $wikiPages = $this->wikiPage->getPages($id);

        if($wikiPages) {
            return view('wiki.page.reorder', compact('wikiPages', 'wiki'));
        }
        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);        
    }

    public function updatePageParent()
    {
        $this->wikiPage->changeParent($this->request->all());
        return response()->json([
            'message' => 'Page parent has been changed.'
        ], Response::HTTP_OK);
    }
}
