<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Wiki;
use App\Models\WikiPage;
use App\Models\Category;
use App\Models\ActivityLog;
use App\Models\Organization;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
	protected $wiki;

    protected $wikiPage;

    protected $organization;

    protected $request;

    protected $activityLog;

    protected $category;

    public function __construct(Request $request, Wiki $wiki, Organization $organization, WikiPage $wikiPage, ActivityLog $activityLog, Category $category) {
        $this->wiki         = $wiki;
        $this->request      = $request;
        $this->wikiPage     = $wikiPage;
        $this->category     = $category;
        $this->activityLog  = $activityLog;
        $this->organization = $organization;
    }

	public function pagesReorder($organizationSlug, $wiki_slug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);

        $wiki = $this->wiki->getWiki($wiki_slug, $organization->id);

        return view('wiki.page.reorder', compact('wiki', 'organization'));        
    }

    public function reorder($organizationId, $wikiId)
    {
        $this->wikiPage->changePageParent($this->request->get('nodeId'), $this->request->get('parentId'));   
        return response()->json([
            'success' => true
        ]);
    }

    public function destroy($organizationSlug, $wikiSlug, $pageSlug)
    {
        $pageDeleted = $this->wikiPage->deletePage($pageSlug);

        $this->activityLog->createActivity('page', 'delete', $page);

        return redirect()->back()->with([
            'alert' => 'Page successfully deleted.',
            'alert_type' => 'success'
        ]);
    }   

    public function edit($organizationSlug, $wikiSlug, $pageSlug)
    {
        $organization = $this->organization->where('slug', '=', $organizationSlug)->first();

        $wiki = $this->wiki->getWiki($wikiSlug, $organization->id);
        
        $page = $this->wikiPage->getPage($pageSlug);
        
        $wikiPages = $this->wikiPage->getPages($wiki->id);

        return view('wiki.page.edit', compact('page', 'wiki', 'wikiPages', 'organization'));
    }

    public function store($organizationSlug, $wikiSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);

        $this->validate($this->request, Wiki::WIKI_PAGE_RULES);
        
        $wiki = \App\Models\Wiki::where('slug', '=', $wikiSlug)->first();

        $page = $this->wikiPage->saveWikiPage($wiki->id, $this->request->all());
        $this->activityLog->createActivity('page', 'create', $page, $organization->id);
        
        return redirect()->route('pages.show', [$organizationSlug, $wikiSlug, $page->slug])->with([
            'alert'      => 'Page successfully created.',
            'alert_type' => 'success'
        ]);
    }

    public function create($organizationSlug, $wikiSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);

        $wiki = $this->wiki->getWiki($wikiSlug, $organization->id);
        $wikiPages = $this->wikiPage->getPages($wiki->id);
        
        return view('wiki.page.create', compact('wiki', 'wikiPages', 'organization'));
    }

    public function show($organizationSlug, $wikiSlug, $pageSlug)
    {
        $organization = $this->organization->where('slug', '=', $organizationSlug)->first();

        $wiki = $this->wiki->where('slug', '=', $wikiSlug)->first();
        
        $page = $this->wikiPage->getPage($pageSlug);

        $pagePath = $this->wikiPage->find($page->id)->getAncestorsAndSelf();

        return view('wiki.page.page', compact('organization', 'page', 'wiki', 'pagePath'));
    }

    public function update($organizationSlug, $wikiSlug, $pageSlug)
    {
        $this->wikiPage->updatePage($pageSlug, $this->request->all());
        return redirect()->route('pages.show', [$organizationSlug, $wikiSlug, $pageSlug])->with([
            'alert'      => 'Page successfully updated.',
            'alert_type' => 'success'
        ]);
    }
}
