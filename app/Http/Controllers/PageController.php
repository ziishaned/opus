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

    public function getWikiPages()
    {
        if($this->request->get('explore')) {
            $pages = $this->page->getTreeTo($team, $category, $wiki, $page);

            $html = '';
            $this->makePageTree($team, $wiki, $category, $pages, $page->id, $html);

            return $html;
            ////////////////////////////////////////////////////////
            $wiki = $this->wiki->where('slug', $this->request->get('wiki'))->with(['team'])->first();

            $pageTree = $this->page->getWikiTree($wiki);
            dd($pageTree->toArray());
        }

        if($this->request->get('wiki')) {
            $wiki = $this->wiki->where('slug', $this->request->get('wiki'))->with(['team'])->first();

            $roots = $this->page->getRootPages($wiki);
            return $this->formatePagesData($roots);
        }

        $childs = $this->page->getPageChilds($this->request->get('page'));
        return $this->formatePagesData($childs);
    }

    public function formatePagesData($pages) 
    {
        $nodes = [];
        
        foreach ($pages as $page) {
            $nodes[] = [
                'id'        => $page->id,
                'wiki_id'   => $page->wiki_id,
                'text'      => $page->name,
                'slug'      => $page->slug,
                'children'  => ($page->childPages->count()) ? true : false,
                'data'      => [
                    'created_at' => $page->created_at,
                    'slug'       => $page->slug,
                ],
                'a_attr'    => [
                    'href'  => route('pages.show', [Auth::user()->team->slug, $page->wiki->category->slug, $page->wiki->slug, $page->slug]),
                ],
            ];
        }

        return $nodes;

    }

    public static function makePageTree($team, $wiki, $category, $pages, $currentPageId, &$html)
    {
        foreach ($pages as $page => $value) {
            foreach ($value->getSiblings() as $siblings) {
                if ($value->wiki_id == $siblings->wiki_id) {
                    $html .= '<li id="' . $siblings->id . '" data-slug="' . $siblings->slug . '" data-created_at="' . $siblings->created_at . '" class="' . ($siblings->isLeaf() == false ? 'jstree-closed' : '') . ' ' . ($siblings->id == $currentPageId ? 'jstree-selected' : '') . '"><a href="' . route('pages.show', [$team->slug, $category->slug, $wiki->slug, $siblings->slug]) . '">' . $siblings->name . '</a>';
                }
            }
            $html .= '<li id="' . $value->id . '" data-slug="' . $value->slug . '" data-created_at="' . $value->created_at . '" class="' . ($value->isLeaf() == false ? 'jstree-closed' : '') . ' ' . ($value->id == $currentPageId ? 'jstree-selected' : '') . '"><a href="' . route('pages.show', [$team->slug, $category->slug, $wiki->slug, $value->slug]) . '">' . $value->name . '</a>';
            if (!empty($value['children'])) {
                $html .= '<ul>';
                self::makePageTree($team, $wiki, $category, $value['children'], $currentPageId, $html);
                $html .= '</ul></li>';
            }
        }

        return true;
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
