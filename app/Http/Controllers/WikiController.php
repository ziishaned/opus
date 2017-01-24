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

    public function index()
    {
        return $this->wiki->getWikis();
    }

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

    public function show($organizationSlug, $wikiSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);
        $wiki = $this->wiki->getWiki($wikiSlug, $organization->id);
        if(!$wiki) {
            abort('404');
        }

        $wikiPages = $this->wikiPage->getPages($wiki->id);
        return view('wiki.wiki', compact('wikiPages', 'wiki', 'organization'));
    }
    
    public function getWikiPages($organizationId, $id, $page_id = null)
    {
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
                $html .= '<li id="'.$value['id'].'" data-created_at="'. $value['data']['created_at'] .'" class="' . ($value['children'] == true ? 'jstree-closed' : '' ) . '"><a href="'.route('pages.show', [$organization->slug, $this->wiki->where('id', '=', $value['wiki_id'])->pluck('slug')->first(), $value['slug']]).'">' . $value['text'] . '</a>';
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
                    $html .= '<li id="'.$siblings->id.'" data-created_at="'. $siblings->created_at .'" class="' . ($siblings->isLeaf() == false ? 'jstree-closed' : '' ) . ' ' . ($siblings->id == $currentPageId ? 'jstree-selected' : '' ) . '"><a href="'.route('pages.show', [$organization->slug, $siblings->wiki->slug, $siblings->slug]).'">' . $siblings->name . '</a>';
                }
            }
            $html .= '<li id="'.$value->id.'" data-created_at="'. $value->created_at .'" class="' . ($value->isLeaf() == false ? 'jstree-closed' : '' ) . ' ' . ($value->id == $currentPageId ? 'jstree-selected' : '' ) . '"><a href="'.route('pages.show', [$organization->slug, $value->wiki->slug, $value->slug]).'">' . $value->name . '</a>';
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
     * @param $wikiSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($organizationSlug, $wikiSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);
        
        $categories = $this->category->getOrganizationCategories($organization->id);

        $wiki = $this->wiki->getWiki($wikiSlug, $organization->id);

        return view('wiki.edit', compact('wiki', 'organization', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $wikiSlug
     * @return \Illuminate\Http\Response
     */
    public function update($organizationSlug, $wikiSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);
        
        $wiki = $this->wiki->where('slug', '=', $wikiSlug)->first();
        
        $this->wiki->updateWiki($wikiSlug, $this->request->all());
        
        $this->activityLog->createActivity('wiki', 'update', $wiki, $organization->id);
        
        return redirect()->route('wikis.show', [$organization->slug, $wiki->slug])->with([
            'alert' => 'Wiki successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $wikiSlug
     * @return \Illuminate\Http\Response
     */
    public function destroy($wikiSlug)
    {
        $wiki = $this->wiki->deleteWiki($wikiSlug);
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

    public function reverseArray($data)
    {
        return array_combine(array_keys($data), array_reverse(array_values($data)));
    }

    public function updatePageParent()
    {
        $this->wikiPage->changeParent($this->request->all());
        return response()->json([
            'message' => 'Page parent has been changed.'
        ], Response::HTTP_OK);
    }

    public function overview($organizationSlug, $wikiSlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);

        $wiki = $this->wiki->getWiki($wikiSlug, $organization->id);

        return view('wiki.overview', compact('organization', 'wiki'));
    }
}
