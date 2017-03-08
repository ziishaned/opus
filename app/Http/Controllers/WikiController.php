<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Wiki;
use App\Models\Page;
use App\Models\Team;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WikiController
 *
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Http\Controllers
 */
class WikiController extends Controller
{
    protected $wiki;

    protected $page;

    protected $team;

    protected $request;

    protected $category;

    public function __construct(Request $request, Wiki $wiki, Team $team, Page $page, Category $category)
    {
        $this->wiki     = $wiki;
        $this->page     = $page;
        $this->team     = $team;
        $this->request  = $request;
        $this->category = $category;
    }

    public function create(Team $team)
    {
        $categories = $this->category->getTeamCategories($team->id);

        if ($categories->count() == 0) {
            return redirect()->route('categories.create', [$team->slug,])->with([
                'alert'      => 'You need to create category before creating wiki!',
                'alert_type' => 'info',
            ]);
        }

        return view('wiki.create', compact('team', 'categories'));
    }

    public function store(Team $team)
    {
        $this->validate($this->request, Wiki::WIKI_RULES);

        $wiki = $this->wiki->saveWiki($this->request->all(), $team->id);

        return redirect()->route('wikis.show', [$team->slug, $wiki->category->slug, $wiki->slug])->with([
            'alert'      => 'Wiki successfully created.',
            'alert_type' => 'success',
        ]);
    }

    public function show(Team $team, Category $category, Wiki $wiki)
    {
        $pages = $this->page->getPages($wiki->id);
        
        $isUserLikeWiki = false;
        foreach ($wiki->likes as $like) {
            if($like->user_id === Auth::user()->id) {
                $isUserLikeWiki = true;
            }
        }

        return view('wiki.index', compact('pages', 'wiki', 'team', 'category', 'isUserLikeWiki'));
    }

    public function edit(Team $team, Category $category, Wiki $wiki)
    {
        $categories = $this->category->getTeamCategories($team->id);

        return view('wiki.edit', compact('wiki', 'team', 'categories', 'category'));
    }

    public function update(Team $team, Category $category, Wiki $wiki)
    {
        $this->wiki->updateWiki($wiki->id, $this->request->all());

        return redirect()->route('wikis.show', [$team->slug, $wiki->category->slug, $wiki->slug])->with([
            'alert'      => 'Wiki successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    public function destroy(Team $team, Category $category, Wiki $wiki)
    {
        $this->wiki->deleteWiki($wiki->id);

        return redirect()->route('dashboard', [$team->slug])->with([
            'alert'      => 'Wiki successfully deleted.',
            'alert_type' => 'success',
        ]);
    }

    public function reverseArray($data)
    {
        return array_combine(array_keys($data), array_reverse(array_values($data)));
    }

    public function getWikis(Team $team)
    {
        $wikis = $this->wiki->getTeamWikis($team->id);

        $categories = $this->category->getTeamCategories($team->id);

        return view('wiki.list', compact('team', 'wikis', 'categories'));
    }

    public function getTeamWikis(Team $team)
    {
        if ($this->request->get('category_slug')) {
            $category = $this->category->where('slug', $this->request->get('category_slug'))->first();

            return $this->wiki->where('team_id', $team->id)->where('category_id', $category->id)->with(['user', 'category', 'team'])->latest()->paginate(10);
        }

        return $this->wiki->where('team_id', $team->id)->with(['user', 'category', 'team'])->latest()->paginate(10);
    }

    public function getWikiActivity(Team $team, Category $category, Wiki $wiki)
    {
        $activities = $this->wiki->getActivty($wiki->id)->activity;

        return view('wiki.activity', compact('team', 'category', 'wiki', 'activities'));
    }

    public function overview(Team $team, Category $category, Wiki $wiki)
    {
        $isUserLikeWiki = $this->isUserLikeWiki($wiki); 

        return view('wiki.setting.overview', compact('team', 'category', 'wiki', 'isUserLikeWiki'));
    }

    public function permission(Team $team, Category $category, Wiki $wiki)
    {
        $isUserLikeWiki = $this->isUserLikeWiki($wiki); 

        return view('wiki.setting.permission', compact('team', 'category', 'wiki', 'isUserLikeWiki'));
    }

    public function isUserLikeWiki($wiki)
    {
        $isLiked = false;
        foreach ($wiki->likes as $like) {
            if($like->user_id === Auth::user()->id) {
                $isLiked = true;
            }
        }
        return $isLiked;
    }
}
