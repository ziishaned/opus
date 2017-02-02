<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Wiki;
use App\Models\WikiPage;
use App\Models\Category;
use App\Models\Organization;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
	protected $wiki;

    protected $wikiPage;

    protected $organization;

    protected $request;

    protected $category;

    public function __construct(Request $request, 
                                Wiki $wiki, 
                                Organization $organization, 
                                WikiPage $wikiPage,  
                                Category $category) {
        $this->wiki         = $wiki;
        $this->request      = $request;
        $this->wikiPage     = $wikiPage;
        $this->category     = $category;
        $this->organization = $organization;
    }

	public function pagesReorder(Organization $organization, Category $category, Wiki $wiki)
    {
        return view('wiki.page.reorder', compact('wiki', 'organization', 'category'));        
    }

    public function reorder($organizationId, $wikiId)
    {
        $this->wikiPage->changePageParent($this->request->get('nodeId'), $this->request->get('parentId'));   
        return response()->json([
            'success' => true
        ]);
    }

    public function destroy(Organization $organization, Category $category, Wiki $wiki, WikiPage $page)
    {
        $pageDeleted = $this->wikiPage->deletePage($page->id);

        return redirect()->route('wikis.show', [$organization->slug, $wiki->category->slug, $wiki->slug])->with([
            'alert' => 'Page successfully deleted.',
            'alert_type' => 'success'
        ]);
    }   

    public function edit(Organization $organization, Category $category, Wiki $wiki, WikiPage $page)
    {   
        $wikiPages = $this->wikiPage->getPages($wiki->id);

        return view('wiki.page.edit', compact('page', 'wiki', 'wikiPages', 'organization', 'category'));
    }

    public function store(Organization $organization, Category $category, Wiki $wiki)
    {
        $this->validate($this->request, Wiki::WIKI_PAGE_RULES);

        $page = $this->wikiPage->saveWikiPage($wiki->id, $this->request->all());
        
        return redirect()->route('pages.show', [$organization->slug, $category->slug, $wiki->slug, $page->slug])->with([
            'alert'      => 'Page successfully created.',
            'alert_type' => 'success'
        ]);
    }

    public function create(Organization $organization, Category $category, Wiki $wiki)
    {
        $wikiPages = $this->wikiPage->getPages($wiki->id);
        
        return view('wiki.page.create', compact('wiki', 'wikiPages', 'organization', 'category'));
    }

    public function show(Organization $organization , Category $category, Wiki $wiki, WikiPage $page)
    {
        return view('wiki.page.page', compact('organization', 'page', 'wiki', 'pagePath', 'category'));
    }

    public function update(Organization $organization, Category $category, Wiki $wiki, WikiPage $page)
    {
        $this->wikiPage->updatePage($page->id, $this->request->all());
        $page = $this->wikiPage->find($page->id);

        return redirect()->route('pages.show', [$organization->slug, $category->slug, $wiki->slug, $page->slug])->with([
            'alert'      => 'Page successfully updated.',
            'alert_type' => 'success'
        ]);
    }
}
