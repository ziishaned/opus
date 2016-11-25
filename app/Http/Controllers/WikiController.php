<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Wiki;
use App\Models\WikiPage;
use App\Models\ActivityLog;
use App\Models\Organization;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WikiController
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Http\Controllers
 */
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
     * @var \App\Models\ActivityLog
     */
    protected $activityLog;

    /**
     * WikiController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wiki         $wiki
     * @param \App\Models\Organization $organization
     * @param \App\Models\WikiPage     $wikiPage
     */
    public function __construct(Request $request, Wiki $wiki, Organization $organization, WikiPage $wikiPage, ActivityLog $activityLog) {
        $this->wiki         = $wiki;
        $this->request      = $request;
        $this->wikiPage     = $wikiPage;
        $this->activityLog  = $activityLog;
        $this->organization = $organization;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->wiki->getWikis();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param null|string $organizationSlug
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
        $this->activityLog->createActivity('wiki', 'create', $wiki);

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
     * @param $nameSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
        $wiki = $this->wiki->updateWiki($nameSlug, $this->request->all());
        $this->activityLog->createActivity('wiki', 'update', $wiki);
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
        $wiki = $this->wiki->deleteWiki($nameSlug);
        $this->activityLog->createActivity('wiki', 'delete', $wiki);
        if($wiki) {
            return redirect()->route('dashboard')->with([
                'alert' => 'Wiki successfully deleted.',
                'alert_type' => 'success'
            ]);
        }
        return response()->json([
            'message' => 'We are having some issues.'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Returns the view to create a wiki page.
     *
     * @param $wikiSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPage($wikiSlug)
    {
        $wiki = $this->wiki->getWiki($wikiSlug);
        $wikiPages = $this->wikiPage->getPages($wiki->id);
        return view('wiki.page.create', compact('wiki', 'wikiPages'));
    }

    /**
     * Filter wikis.
     *
     * @param string $text
     * @return \App\Models\Wiki
     */
    public function filterWikis($text)
    {
        return $this->wiki->filterWikis($text);
    }

    /**
     * Filter a specific wiki pages.
     *
     * @param integer $wikiId
     * @param string  $text
     * @return mixed
     */
    public function filterWikiPages($wikiId, $text)
    {
        return $this->wikiPage->filterWikiPages($wikiId, $text);
    }

    /**
     * Create a new resource.
     *
     * @param string $wikiSlug
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storePage($wikiSlug)
    {
        $this->validate($this->request, Wiki::WIKI_PAGE_RULES);
        $page = $this->wikiPage->saveWikiPage($wikiSlug, $this->request->all());
        return redirect()->route('wikis.pages.show', [$wikiSlug, $page->slug])->with([
            'alert'      => 'Page successfully created.',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Return a view with a specific wiki page.
     *
     * @param string $wikiSlug
     * @param string $pageSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPage($wikiSlug, $pageSlug)
    {
        $wiki = $this->wiki->getWiki($wikiSlug);
        $page = $this->wikiPage->getPage($pageSlug);
        if(!$page) {
            abort('404');
        }
        
        $wikiPages = $this->wikiPage->getPages($wiki->id);
        if($wikiPages) {
            return view('wiki.page.page', compact('wikiPages', 'page'));
        }
        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Edit a specific resource.
     *
     * @param string $wikiSlug
     * @param string $pageSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage($wikiSlug, $pageSlug)
    {
        $page = $this->wikiPage->getPage($pageSlug);
        return view('wiki.page.edit', compact('wikiSlug', 'page'));
    }

    /**
     * Update a specific resource.
     *
     * @param $wikiId
     * @param $pageId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePage($wikiSlug, $pageSlug)
    {
        $this->wikiPage->updatePage($pageSlug, $this->request->all());
        return redirect()->route('wikis.pages.show', [$wikiSlug, $pageSlug])->with([
            'alert'      => 'Page successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Remove a specific resource.
     *
     * @param $wikiId
     * @param $pageId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyPage($wikiSlug, $pageSlug)
    {
        $pageDeleted = $this->wikiPage->deletePage($pageSlug);
        if($pageDeleted) {
            return redirect()->route('wikis.show', $wikiSlug)->with([
                'alert' => 'Page successfully deleted.',
                'alert_type' => 'success'
            ]);
        }
        return response()->json([
            'message' => 'We are having some issues.'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);   
    }

    /**
     * Like or Unlike a specific page.
     *
     * @param $id
     * @return mixed
     */
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

    /**
     * Get the pages reorder view.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pagesReorder($wiki_slug)
    {
        $wiki = $this->wiki->getWiki($wiki_slug);        
        $wikiPages = $this->wikiPage->getPages($wiki->id);

        if($wikiPages) {
            return view('wiki.page.reorder', compact('wikiPages', 'wiki'));
        }
        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);        
    }

    /**
     * Update the page parent.
     *
     * @return mixed
     */
    public function updatePageParent()
    {
        $this->wikiPage->changeParent($this->request->all());
        return response()->json([
            'message' => 'Page parent has been changed.'
        ], Response::HTTP_OK);
    }
}
