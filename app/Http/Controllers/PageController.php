<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Wiki;
use App\Models\Team;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $wiki;

    protected $page;

    protected $team;

    protected $request;

    protected $category;

    public function __construct(Request $request,
                                Wiki $wiki,
                                Team $team,
                                Page $page,
                                Category $category)
    {
        $this->wiki     = $wiki;
        $this->request  = $request;
        $this->page     = $page;
        $this->category = $category;
        $this->team     = $team;
    }

    public function pagesReorder(Organization $organization, Category $category, Wiki $wiki)
    {
        return view('wiki.page.reorder', compact('wiki', 'organization', 'category'));
    }

    public function reorder($teamId, $wikiId)
    {
        $this->page->changePageParent($this->request->get('nodeId'), $this->request->get('parentId'));

        return response()->json([
            'success' => true,
        ]);
    }

    public function destroy(Team $team, Category $category, Wiki $wiki, Page $page)
    {
        $this->page->deletePage($page->id);

        return redirect()->route('wikis.show', [$team->slug, $wiki->category->slug, $wiki->slug])->with([
            'alert'      => 'Page successfully deleted.',
            'alert_type' => 'success',
        ]);
    }

    public function edit(Team $team, Category $category, Wiki $wiki, Page $page)
    {
        $pages = $this->page->getPages($wiki->id);

        return view('page.edit', compact('page', 'wiki', 'pages', 'team', 'category'));
    }

    public function store(Team $team, Category $category, Wiki $wiki)
    {
        $this->validate($this->request, Page::PAGE_RULES);

        $page = $this->page->saveWikiPage($wiki, $this->request->all());

        return redirect()->route('pages.show', [$team->slug, $category->slug, $wiki->slug, $page->slug])->with([
            'alert'      => 'Page successfully created.',
            'alert_type' => 'success',
        ]);
    }

    public function create(Team $team, Category $category, Wiki $wiki)
    {
        $pages = $this->page->getPages($wiki->id);

        return view('page.create', compact('team', 'wiki', 'pages', 'category'));
    }

    public function show(Team $team, Category $category, Wiki $wiki, Page $page)
    {
        $isUserLikeWiki = false;
        foreach ($wiki->likes as $like) {
            if($like->user_id === Auth::user()->id) {
                $isUserLikeWiki = true;
            }
        }

        $isUserLikePage = false;
        foreach ($page->likes as $like) {
            if($like->user_id === Auth::user()->id) {
                $isUserLikePage = true;
            }
        }

        return view('page.index', compact('team', 'page', 'wiki', 'category', 'isUserLikeWiki', 'isUserLikePage'));
    }

    public function update(Team $team, Category $category, Wiki $wiki, Page $page)
    {
        $this->page->updatePage($page->id, $this->request->all());
        $page = $this->page->find($page->id);

        return redirect()->route('pages.show', [$team->slug, $category->slug, $wiki->slug, $page->slug])->with([
            'alert'      => 'Page successfully updated.',
            'alert_type' => 'success',
        ]);
    }
}
