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

    protected $category;

    /**
     * WikiController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wiki         $wiki
     * @param \App\Models\Organization $organization
     * @param \App\Models\WikiPage     $wikiPage
     */
    public function __construct(Request $request, Wiki $wiki, Organization $organization, WikiPage $wikiPage, ActivityLog $activityLog, Category $category) {
        $this->wiki         = $wiki;
        $this->request      = $request;
        $this->wikiPage     = $wikiPage;
        $this->category     = $category;
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
    public function create($organizationSlug)
    {  
        $organization = $this->organization->getOrganization($organizationSlug);    

        $categories = $this->category->getOrganizationCategories($organization->id);

        if($categories->count() == 0) {
            return redirect()->route('organizations.categories.create', [$organization->slug, ])->with([
                'alert' => 'You need to create category before creating wiki!',
                'alert_type' => 'info'
            ]);
        }

        return view('wiki.create', compact('organization', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store($organizationSlug)
    {
        $this->validate($this->request, Wiki::WIKI_RULES);
     
        $organization = $this->organization->getOrganization($organizationSlug);

        $wiki = $this->wiki->saveWiki($this->request->all(), $organization->id);
        $this->activityLog->createActivity('wiki', 'create', $wiki, $organization->id);

        return redirect()->route('wikis.show', [$organization->slug, $wiki->slug])->with([
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
    public function show($organizationSlug, $nameSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);
        $wiki = $this->wiki->getWiki($nameSlug, $organization->id);
        if(!$wiki) {
            abort('404');
        }

        $wikiPages = $this->wikiPage->getPages($wiki->id);
        return view('wiki.wiki', compact('wikiPages', 'wiki', 'organization'));
    }
    
    public function getWikiPages($organizationId, $id, $page_id = null)
    {
        dd($id);
        $organization = \App\Models\Organization::find($organizationId)->first();

        $wiki = $this->wiki->find($id);

        if(!$this->request->get('opened_node')) {
            $wikiPages = $this->wikiPage->getWikiPages($organization, $id, $page_id);
            return $this->makePageHtml($wikiPages, $organization);
        } 

        $wikiPages = $this->wikiPage->getWikiPages($organization, $id, $page_id, $this->request->get('opened_node'));

        $html = '';
        $this->makePageTree($organization, $wikiPages, $this->request->get('opened_node'), $html);
    
        return $html;
    }

    public function makePageHtml($pages, $organization) {
        $html = '';
        if($pages) {
            foreach ($pages as $key => $value) {
                $html .= '<li id="'.$value['id'].'" data-created_at="'. $value['data']['created_at'] .'" class="' . ($value['children'] == true ? 'jstree-closed' : '' ) . '"><a href="'.route('wikis.pages.show', [$organization->slug, $this->wiki->find($value['wiki_id'])->pluck('slug')->first(), $value['slug']]).'">' . $value['text'] . '</a>';
            }
        }
        return $html;
    }

    /**
     * Todo: send this in array form instead of html
     * 
     * @param  [type] $wikiPages     [description]
     * @param  [type] $currentPageId [description]
     * @param  [type] &$html         [description]
     * @return [type]                [description]
     */
    public static function makePageTree($organization, $wikiPages, $currentPageId, &$html)
    {
        foreach ($wikiPages as $page => $value) {
            foreach($value->getSiblings() as $siblings) {
                if($value->wiki_id == $siblings->wiki_id) {
                    $html .= '<li id="'.$siblings->id.'" data-created_at="'. $siblings->created_at .'" class="' . ($siblings->isLeaf() == false ? 'jstree-closed' : '' ) . ' ' . ($siblings->id == $currentPageId ? 'jstree-selected' : '' ) . '"><a href="'.route('wikis.pages.show', [$organization->slug, $siblings->wiki->slug, $siblings->slug]).'">' . $siblings->name . '</a>';
                }
            }
            $html .= '<li id="'.$value->id.'" data-created_at="'. $value->created_at .'" class="' . ($value->isLeaf() == false ? 'jstree-closed' : '' ) . ' ' . ($value->id == $currentPageId ? 'jstree-selected' : '' ) . '"><a href="'.route('wikis.pages.show', [$organization->slug, $value->wiki->slug, $value->slug]).'">' . $value->name . '</a>';
            if(!empty($value['children'])) {
                $html .= '<ul>';
                self::makePageTree($organization, $value['children'], $currentPageId, $html);
                $html .= '</ul></li>';
            }
        }
        return;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $nameSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($organizationSlug, $nameSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);
        $wiki = $this->wiki->getWiki($nameSlug, $organization->id);

        return view('wiki.edit', compact('wiki', 'organization'));
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
    public function createPage($organizationSlug, $wikiSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);

        $wiki = $this->wiki->getWiki($wikiSlug, $organization->id);
        $wikiPages = $this->wikiPage->getPages($wiki->id);
        
        return view('wiki.page.create', compact('wiki', 'wikiPages', 'organization'));
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
    public function storePage($organizationSlug, $wikiSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);

        $this->validate($this->request, Wiki::WIKI_PAGE_RULES);
        
        $wiki = \App\Models\Wiki::where('slug', '=', $wikiSlug)->first();

        $page = $this->wikiPage->saveWikiPage($wiki->id, $this->request->all());
        $this->activityLog->createActivity('page', 'create', $page, $organization->id);
        
        return redirect()->route('wikis.pages.show', [$organizationSlug, $wikiSlug, $page->slug])->with([
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
    public function showPage($organizationSlug, $wikiSlug, $pageSlug)
    {
        $organization = $this->organization->where('slug', '=', $organizationSlug)->first();

        $wiki = $this->wiki->where('slug', '=', $wikiSlug)->first();
        
        $page = $this->wikiPage->getPage($pageSlug);

        $pagePath = $this->wikiPage->find($page->id)->getAncestorsAndSelf();

        return view('wiki.page.page', compact('organization', 'page', 'wiki', 'pagePath'));
    }

    public function reverseArray($data)
    {
        return array_combine(array_keys($data), array_reverse(array_values($data)));
    }

    /**
     * Edit a specific resource.
     *
     * @param string $wikiSlug
     * @param string $pageSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editPage($organizationSlug, $wikiSlug, $pageSlug)
    {
        $organization = $this->organization->where('slug', '=', $organizationSlug)->first();

        $wiki = $this->wiki->getWiki($wikiSlug, $organization->id);
        $page = $this->wikiPage->getPage($pageSlug);
        $wikiPages = $this->wikiPage->getPages($wiki->id);

        return view('wiki.page.edit', compact('page', 'wiki', 'wikiPages', 'organization'));
    }

    /**
     * Update a specific resource.
     *
     * @param $organizationSlug
     * @param $wikiSlug
     * @param $pageSlug
     *
     * @return \Illuminate\Http\RedirectResponse
     * @internal param $wikiId
     * @internal param $pageId
     */
    public function updatePage($organizationSlug, $wikiSlug, $pageSlug)
    {
        $this->wikiPage->updatePage($pageSlug, $this->request->all());
        return redirect()->route('wikis.pages.show', [$organizationSlug, $wikiSlug, $pageSlug])->with([
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
    public function destroyPage($organizationSlug, $wikiSlug, $pageSlug)
    {
        $pageDeleted = $this->wikiPage->deletePage($pageSlug);

        $this->activityLog->createActivity('page', 'delete', $page);

        return redirect()->back()->with([
            'alert' => 'Page successfully deleted.',
            'alert_type' => 'success'
        ]);
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
