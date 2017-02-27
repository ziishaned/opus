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
            $currentPage = $this->page->where('slug', $this->request->get('page'))->first();

            $wiki =  $this->wiki->where('slug', $this->request->get('wiki'))->with(['category'])->first();
            
            $pages = $this->page->getTreeTo($currentPage);

            $html = '';
            $this->makePageTree($wiki, $pages, $currentPage->id, $html);

            return $html;
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
        $html = '<ul>'; 
        foreach ($pages as $page) {
            $html .= '<li id="' . $page->id . '" data-slug="' . $page->slug . '" data-position="'. $page->position .'" data-created_at="' . $page->created_at . '" class="' . ($page->isLeaf() == false ? 'jstree-closed' : '') . '"><a href="' . route('pages.show', [Auth::user()->team->slug, $page->wiki->category->slug, $page->wiki->slug, $page->slug]) . '">' . $page->name . '</a>';
        }
        $html .= '</ul>'; 

        return $html;
    }

    public static function makePageTree($wiki, $pages, $currentPageId, &$html)
    {
        foreach ($pages as $page => $value) {
            foreach ($value->getSiblings() as $siblings) {
                if ($value->wiki_id == $siblings->wiki_id) {
                    $html .= '<li id="' . $siblings->id . '" data-slug="' . $siblings->slug . '" data-position="'. $siblings->position .'" data-created_at="' . $siblings->created_at . '" class="' . ($siblings->isLeaf() == false ? 'jstree-closed' : '') . ' ' . ($siblings->id == $currentPageId ? 'jstree-selected' : '') . '"><a href="' . route('pages.show', [Auth::user()->team->slug, $wiki->category->slug, $wiki->slug, $siblings->slug]) . '">' . $siblings->name . '</a>';
                }
            }
            $html .= '<li id="' . $value->id . '" data-slug="' . $value->slug . '" data-position="'. $value->position .'" data-created_at="' . $value->created_at . '" class="' . ($value->isLeaf() == false ? 'jstree-closed' : '') . ' ' . ($value->id == $currentPageId ? 'jstree-selected' : '') . '"><a href="' . route('pages.show', [Auth::user()->team->slug, $wiki->category->slug, $wiki->slug, $value->slug]) . '">' . $value->name . '</a>';
            if (!empty($value['children'])) {
                $html .= '<ul>';
                self::makePageTree($wiki, $value['children'], $currentPageId, $html);
                $html .= '</ul></li>';
            }
        }

        return true;
    }

    public function changeSiblingsPositions($node, $nodePosition)
    {
        // Change the node position that is dragged by user
        $node = $this->page->find($node->id);
        $node->position = $nodePosition;
        $node->save();

        // Change the siblings position +1 step
        foreach ($node->siblingsAndSelf()->where('position', '>=', $nodePosition)->get() as $key => $x) {
            if($x->position >= $nodePosition && $x->id !== $node->id) {
                $page = $this->page->find($x->id);
                $page->position = $x->position+1;
                $page->save();
            }
        }
    }

    public function reorder()
    {   
        $node = $this->page->find($this->request->get('nodeToChangeParent'));

        if ($this->request->get('parent') === '#') {
            $node->makeRoot();
            $this->changeSiblingsPositions($node, $this->request->get('position'));
        } else {
            $parent = $this->page->find($this->request->get('parent'));
            $node->makeChildOf($parent);
            $this->changeSiblingsPositions($node, $this->request->get('position'));
        }

        return [
            'Position changed' => true
        ];   
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

        $this->request['position'] = $this->getNodePosition($this->request->all(), $wiki);

        $page = $this->page->saveWikiPage($wiki, $this->request->all());

        return redirect()->route('pages.show', [$team->slug, $category->slug, $wiki->slug, $page->slug])->with([
            'alert'      => 'Page successfully created.',
            'alert_type' => 'success',
        ]);
    }

    public function getNodePosition($data, $wiki)
    {
        if(empty($data['page_parent'])) {
            $pages = $this->page->where('wiki_id', $wiki->id)->whereNull('parent_id')->get();
            if(!empty($pages->toArray())) {
                $position = 0;
                foreach ($pages as $page) {
                    if($page->position > $position) {
                        $position = $page->position;
                    }
                }
                return $position+1;
            } else {
                return 0;
            }
        }
        

        $childPages = $this->page->where('wiki_id', $wiki->id)->where('parent_id', $data['page_parent'])->get();
        if(!empty($childPages->toArray())) {
            $position = 0;
            foreach ($childPages as $page) {
                if($page->position > $position) {
                    $position = $page->position;
                }
            }
            return $position+1;
        } else {
            return 0;
        }
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
