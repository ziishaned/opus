<?php

namespace App\Http\Controllers;

use DB;
use Pdf;
use Auth;
use App\Models\Tag;
use App\Models\Wiki;
use App\Models\Team;
use App\Models\Page;
use App\Models\Space;
use App\Models\ReadList;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Helpers\HtmlToDocHelper;

class PageController extends Controller
{
    protected $wiki;

    protected $page;

    protected $team;

    protected $request;

    protected $space;

    public function __construct(Request $request,
                                Wiki $wiki,
                                Team $team,
                                Page $page,
                                Space $space)
    {
        $this->wiki     = $wiki;
        $this->request  = $request;
        $this->page     = $page;
        $this->space    = $space;
        $this->team     = $team;
    }

    public function getWikiPages()
    {
        if($this->request->get('explore')) {
            $currentPage = $this->page->where('slug', $this->request->get('page'))->first();

            $wiki =  $this->wiki->where('slug', $this->request->get('wiki'))->with(['space'])->first();

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
            $html .= '<li id="' . $page->id . '" data-slug="' . $page->slug . '" data-position="'. $page->position .'" data-created_at="' . $page->created_at . '" class="' . ($page->isLeaf() == false ? 'jstree-closed' : '') . '"><a href="' . route('pages.show', [Auth::user()->getTeam()->slug, $page->wiki->space->slug, $page->wiki->slug, $page->slug]) . '">' . $page->name . '</a>';
        }
        $html .= '</ul>';

        return $html;
    }

    public static function makePageTree($wiki, $pages, $currentPageId, &$html)
    {
        foreach ($pages as $page => $value) {
            foreach ($value->getSiblings() as $siblings) {
                if ($value->wiki_id == $siblings->wiki_id) {
                    $html .= '<li id="' . $siblings->id . '" data-slug="' . $siblings->slug . '" data-position="'. $siblings->position .'" data-created_at="' . $siblings->created_at . '" class="' . ($siblings->isLeaf() == false ? 'jstree-closed' : '') . ' ' . ($siblings->id == $currentPageId ? 'jstree-selected' : '') . '"><a href="' . route('pages.show', [Auth::user()->getTeam()->slug, $wiki->space->slug, $wiki->slug, $siblings->slug]) . '">' . $siblings->name . '</a>';
                }
            }
            $html .= '<li id="' . $value->id . '" data-slug="' . $value->slug . '" data-position="'. $value->position .'" data-created_at="' . $value->created_at . '" class="' . ($value->isLeaf() == false ? 'jstree-closed' : '') . ' ' . ($value->id == $currentPageId ? 'jstree-selected' : '') . '"><a href="' . route('pages.show', [Auth::user()->getTeam()->slug, $wiki->space->slug, $wiki->slug, $value->slug]) . '">' . $value->name . '</a>';
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

    public function destroy(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        $this->page->deletePage($page->id);

        return redirect()->route('wikis.show', [$team->slug, $wiki->space->slug, $wiki->slug])->with([
            'alert'      => 'Page successfully deleted.',
            'alert_type' => 'success',
        ]);
    }

    public function edit(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        $pageTags = $this->page->find($page->id)->tags()->get();

        $pages = $this->page->getPages($wiki->id);

        return view('page.edit', compact('page', 'pageTags', 'wiki', 'pages', 'team', 'space'));
    }

    public function store(Team $team, Space $space, Wiki $wiki)
    {
        $this->validate($this->request, Page::PAGE_RULES);

        $this->request['position'] = $this->getNodePosition($this->request->all(), $wiki);

        $page = $this->page->saveWikiPage($wiki, $this->request->all());

        if(!empty($this->request->get('tags'))) {
            (new Tag)->createTags($this->request->get('tags'), 'App\Models\Page', $page->id);
        }

        return redirect()->route('pages.show', [$team->slug, $space->slug, $wiki->slug, $page->slug])->with([
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

    public function create(Team $team, Space $space, Wiki $wiki)
    {
        $pages = $this->page->getPages($wiki->id);

        return view('page.create', compact('team', 'wiki', 'pages', 'space'));
    }

    public function show(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        $isPageInReadList = ReadList::where('user_id', Auth::user()->id)->where('subject_id', $page->id)->where('subject_type', Page::class)->first();

        $pageTags = $this->page->find($page->id)->tags()->get();

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

        return view('page.index', compact('team', 'pageTags', 'page', 'wiki', 'space', 'isUserLikeWiki', 'isUserLikePage', 'isPageInReadList'));
    }

    public function update(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        $this->page->updatePage($page->id, $this->request->all());
        $page = $this->page->find($page->id);

        if(!empty($this->request->get('tags'))) {
            (new Tag)->updateTags($this->request->get('tags'), 'App\Models\Page', $page->id);
        }

        return redirect()->route('pages.show', [$team->slug, $space->slug, $wiki->slug, $page->slug])->with([
            'alert'      => 'Page successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    public function getTagPages(Team $team, Tag $tag)
    {
        $spaces = $this->space->getTeamSpaces($team->id);

        $pages = (new Tag)->getTeamTagPages($team->id, $tag->id);

        return view('tag.pages', compact('team', 'pages', 'tag', 'spaces'));
    }

    public function generatePdf(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        $header = '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <title>Page header</title>
                <style>
                    * {
                        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
                    }

                    p {
                        font-weight: 500;
                        padding-bottom: 8px;
                        border-bottom: 1px solid #eaecef;
                        color: #c1c1c1;
                    }

                    h1 {
                        padding-bottom: 8px;
                    }
                </style>
            </head>
            <body>
                <p>
                    '.$page->name.'
                </p>
                <h1></h1>
            </body>
            </html>
        ';

        return Pdf::loadView('pdf.page', compact('page'))->setOption('header-html',$header)->inline($page->name . '.pdf');
    }

    public function generateWord(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        $htmltodoc = new HtmlToDocHelper();

        return response()->json($htmltodoc->createDoc($page->description, $page->name.".doc", true), 200);
    }

    public function addToReadList(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        ReadList::create([
            'subject_id' => $page->id,
            'subject_type' => Page::class,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with([
            'alert'      => 'Page successfully added to read list.',
            'alert_type' => 'success',
        ]);
    }

    public function removeFromReadList(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        ReadList::where('user_id', Auth::user()->id)->where('subject_id', $page->id)->where('subject_type', Page::class)->delete();

        return redirect()->back()->with([
            'alert'      => 'Page successfully removed from read list.',
            'alert_type' => 'success',
        ]);
    }

    public function setting(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        $isUserLikeWiki = WikiController::isUserLikeWiki($wiki);

        $pageLastUpdated = Activity::where('subject_type', Page::class)->where('subject_id', $page->id)->orderBy('created_at', 'desc')->first()->updated_at->timezone(Auth::user()->timezone)->toDayDateTimeString();

        $pageTags = $this->page->find($page->id)->tags()->get();

        $pages = $this->page->getPages($wiki->id);

        return view('page.setting', compact('team', 'space', 'wiki', 'isUserLikeWiki', 'pageLastUpdated', 'pageTags', 'page', 'pages'));
    }

    public function overviewUpdate(Team $team, Space $space, Wiki $wiki, Page $page)
    {
        $this->validate($this->request, Page::PAGE_RULES);

        $this->page->find($page->id)->update([
            'name' => $this->request->get('name'),
            'outline' => $this->request->get('outline'),
            'parent_id'    =>  !empty($this->request->get('page_parent')) ? $this->request->get('page_parent') : null,
        ]);

        if(!empty($this->request->get('tags'))) {
            (new Tag)->updateTags($this->request->get('tags'), Page::class, $page->id);
        }

        return redirect()->back()->with([
            'alert'      => 'Page successfully updated.',
            'alert_type' => 'success',
        ]);
    }
}
