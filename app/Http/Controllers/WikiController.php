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

    public function index()
    {
        return $this->wiki->getWikis();
    }

    public function create(Organization $organization)
    {  
        $categories = $this->category->getOrganizationCategories($organization->id);

        if($categories->count() == 0) {
            return redirect()->route('organizations.categories.create', [$organization->slug, ])->with([
                'alert' => 'You need to create category before creating wiki!',
                'alert_type' => 'info'
            ]);
        }

        return view('wiki.create', compact('organization', 'categories'));
    }

    public function store(Organization $organization)
    {
        $this->validate($this->request, Wiki::WIKI_RULES);

        $wiki = $this->wiki->saveWiki($this->request->all(), $organization->id);

        return redirect()->route('wikis.show', [$organization->slug, $wiki->category->slug, $wiki->slug])->with([
            'alert' => 'Wiki successfully created.',
            'alert_type' => 'success'
        ]);
    }

    public function show(Organization $organization, Category $category, Wiki $wiki)
    {
        $wikiPages = $this->wikiPage->getPages($wiki->id);

        return view('wiki.wiki', compact('wikiPages', 'wiki', 'organization', 'category'));
    }
    
    public function getWikiPages()
    {
        $organization =  $this->organization->where('slug', '=', $this->request->get('organization_slug'))->first();
        $category     =  $this->category->where('slug', '=', $this->request->get('category_slug'))->first();
        $wiki         =  $this->wiki->where('slug', '=', $this->request->get('wiki_slug'))->first();
        if($this->request->get('page_slug')) {
            $page     =  $this->wikiPage->where('slug', '=', $this->request->get('page_slug'))->first();
        }

        if($this->request->get('fetch') == 'roots') {
            return $this->wikiPage->getRootPages($organization, $category, $wiki);
        } elseif ($this->request->get('fetch') == 'children') {
            return $this->wikiPage->getChildrenPages($organization, $category, $wiki, $page);
        } else {
            $wikiPages =  $this->wikiPage->getTreeTo($organization, $category, $wiki, $page);
         
            $html = '';
            $this->makePageTree($organization, $wiki, $category, $wikiPages, $page->id, $html);
        
            return $html;
        }
    }

    public static function makePageTree($organization, $wiki, $category, $wikiPages, $currentPageId, &$html)
    {
        foreach ($wikiPages as $page => $value) {
            foreach($value->getSiblings() as $siblings) {
                if($value->wiki_id == $siblings->wiki_id) {
                    $html .= '<li id="'.$siblings->id.'" data-slug="'.$siblings->slug.'" data-created_at="'. $siblings->created_at .'" class="' . ($siblings->isLeaf() == false ? 'jstree-closed' : '' ) . ' ' . ($siblings->id == $currentPageId ? 'jstree-selected' : '' ) . '"><a href="'.route('pages.show', [$organization->slug, $category->slug, $wiki->slug, $siblings->slug]).'">' . $siblings->name . '</a>';
                }
            }
            $html .= '<li id="'.$value->id.'" data-slug="'.$value->slug.'" data-created_at="'. $value->created_at .'" class="' . ($value->isLeaf() == false ? 'jstree-closed' : '' ) . ' ' . ($value->id == $currentPageId ? 'jstree-selected' : '' ) . '"><a href="'.route('pages.show', [$organization->slug, $category->slug, $wiki->slug, $value->slug]).'">' . $value->name . '</a>';
            if(!empty($value['children'])) {
                $html .= '<ul>';
                self::makePageTree($organization, $wiki, $category, $value['children'], $currentPageId, $html);
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
    public function edit(Organization $organization, Category $category, Wiki $wiki)
    {
        $categories = $this->category->getOrganizationCategories($organization->id);

        return view('wiki.edit', compact('wiki', 'organization', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $wikiSlug
     * @return \Illuminate\Http\Response
     */
    public function update(Organization $organization, Category $category, Wiki $wiki)
    {        
        $this->wiki->updateWiki($wiki->id, $this->request->all());
        
        return redirect()->route('wikis.show', [$organization->slug, $wiki->category->slug, $wiki->slug])->with([
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

    public function overview(Organization $organization, Category $category, Wiki $wiki)
    {
        return view('wiki.overview', compact('organization', 'wiki', 'category'));
    }

    public function permissions(Organization $organization, Category $category, Wiki $wiki)
    {
        return view('wiki.permissions', compact('organization', 'wiki', 'category'));
    }
}
