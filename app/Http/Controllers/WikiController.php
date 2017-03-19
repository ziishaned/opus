<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\{Page, Space, Team, Wiki, Tag};

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

    protected $space;

    public function __construct(Request $request, Wiki $wiki, Team $team, Page $page, Space $space)
    {
        $this->wiki    = $wiki;
        $this->page    = $page;
        $this->team    = $team;
        $this->request = $request;
        $this->space   = $space;
    }

    public function create(Team $team)
    {
        $spaces = $this->space->getTeamSpaces($team->id);

        if ($spaces->count() == 0) {
            return redirect()->route('spaces.create', [$team->slug])->with([
                'alert'      => 'You need to create space before creating wiki!',
                'alert_type' => 'info',
            ]);
        }

        return view('wiki.create', compact('team', 'spaces'));
    }

    public function store(Team $team)
    {
        $this->validate($this->request, Wiki::WIKI_RULES);

        $wiki = $this->wiki->saveWiki($this->request->all(), $team->id);

        (new Tag)->createTags($this->request->get('tags'), 'App\Models\Wiki', $wiki->id);

        return redirect()->route('wikis.show', [$team->slug, $wiki->space->slug, $wiki->slug])->with([
            'alert'      => 'Wiki successfully created.',
            'alert_type' => 'success',
        ]);
    }

    public function show(Team $team, Space $space, Wiki $wiki)
    {
        $wikiTags = $this->wiki->find($wiki->id)->tags()->get();
        
        $isUserLikeWiki = false;
        foreach ($wiki->likes as $like) {
            if ($like->user_id === Auth::user()->id) {
                $isUserLikeWiki = true;
            }
        }

        return view('wiki.index', compact('pages', 'wiki', 'team', 'space', 'isUserLikeWiki', 'wikiTags'));
    }

    public function edit(Team $team, Space $space, Wiki $wiki)
    {
        $spaces = $this->space->getTeamSpaces($team->id);

        $editWiki = true;

        return view('wiki.edit', compact('wiki', 'team', 'spaces', 'space', 'editWiki'));
    }

    public function update(Team $team, Space $space, Wiki $wiki)
    {
        $this->wiki->updateWiki($wiki->id, $this->request->all());

        return redirect()->route('wikis.show', [$team->slug, $wiki->space->slug, $wiki->slug])->with([
            'alert'      => 'Wiki successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    public function destroy(Team $team, Space $space, Wiki $wiki)
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

        $spaces = $this->space->getTeamSpaces($team->id);

        return view('wiki.list', compact('team', 'wikis', 'spaces'));
    }

    public function getTeamWikis(Team $team)
    {
        if ($this->request->get('space_slug')) {
            $space = $this->space->where('slug', $this->request->get('space_slug'))->first();

            return $this->wiki->where('team_id', $team->id)->where('space_id', $space->id)->with(['user', 'space', 'team'])->latest()->paginate(10);
        }

        return $this->wiki->where('team_id', $team->id)->with(['user', 'space', 'team'])->latest()->paginate(10);
    }

    public function getWikiActivity(Team $team, Space $space, Wiki $wiki)
    {
        $isUserLikeWiki = $this->isUserLikeWiki($wiki);
        $activities     = $this->wiki->getActivty($wiki->id)->activity;

        return view('wiki.activity', compact('team', 'space', 'wiki', 'activities', 'isUserLikeWiki'));
    }

    public function overview(Team $team, Space $space, Wiki $wiki)
    {
        $isUserLikeWiki = $this->isUserLikeWiki($wiki);

        return view('wiki.setting.overview', compact('team', 'space', 'wiki', 'isUserLikeWiki'));
    }

    public function permission(Team $team, Space $space, Wiki $wiki)
    {
        $isUserLikeWiki = $this->isUserLikeWiki($wiki);

        return view('wiki.setting.permission', compact('team', 'space', 'wiki', 'isUserLikeWiki'));
    }

    public function isUserLikeWiki($wiki)
    {
        $isLiked = false;
        foreach ($wiki->likes as $like) {
            if ($like->user_id === Auth::user()->id) {
                $isLiked = true;
            }
        }
        return $isLiked;
    }
}
