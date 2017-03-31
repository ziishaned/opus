<?php

namespace App\Http\Controllers;

use Pdf;
use Auth;
use App\Models\Tag;
use App\Models\Page;
use App\Models\Team;
use App\Models\Wiki;
use App\Models\Activity;
use App\Models\Space;
use App\Models\WatchWiki;
use App\Models\ReadList;
use Illuminate\Http\Request;
use App\Helpers\HtmlToDocHelper;

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

        if(!empty($this->request->get('tags'))) {
            (new Tag)->createTags($this->request->get('tags'), 'App\Models\Wiki', $wiki->id);
        }

        return redirect()->route('wikis.show', [$team->slug, $wiki->space->slug, $wiki->slug])->with([
            'alert'      => 'Wiki successfully created.',
            'alert_type' => 'success',
        ]);
    }

    public function show(Team $team, Space $space, Wiki $wiki)
    {
        $isWikiInReadList = ReadList::where('user_id', Auth::user()->id)->where('subject_id', $wiki->id)->where('subject_type', Wiki::class)->first();

        $isUserWatchWiki = WatchWiki::where('user_id', Auth::user()->id)->where('wiki_id', $wiki->id)->first();

        $wikiTags = $this->wiki->find($wiki->id)->tags()->get();
        
        $isUserLikeWiki = false;
        foreach ($wiki->likes as $like) {
            if ($like->user_id === Auth::user()->id) {
                $isUserLikeWiki = true;
            }
        }

        return view('wiki.index', compact('pages', 'wiki', 'team', 'space', 'isUserLikeWiki', 'wikiTags', 'isUserWatchWiki', 'isWikiInReadList'));
    }

    public function edit(Team $team, Space $space, Wiki $wiki)
    {
        $wikiTags = $this->wiki->find($wiki->id)->tags()->get();

        $spaces = $this->space->getTeamSpaces($team->id);

        $editWiki = true;

        return view('wiki.edit', compact('wiki', 'team', 'spaces', 'space', 'editWiki', 'wikiTags'));
    }

    public function update(Team $team, Space $space, Wiki $wiki)
    { 
        $this->wiki->updateWiki($wiki->id, $this->request->all());

        if(!empty($this->request->get('tags'))) {
            (new Tag)->updateTags($this->request->get('tags'), 'App\Models\Wiki', $wiki->id);
        }

        return redirect()->route('wikis.show', [$team->slug, $wiki->space->slug, $wiki->slug])->with([
            'alert'      => 'Wiki successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    public function overviewUpdate(Team $team, Space $space, Wiki $wiki)
    {
        $this->validate($this->request, Wiki::WIKI_RULES);

        $this->wiki->where('id', $wiki->id)->update([
            'name'     => $this->request->get('name'),
            'space_id' => (int)$this->request->get('space'),
            'outline'  => $this->request->get('outline'),
        ]);

        if(!empty($this->request->get('tags'))) {
            (new Tag)->updateTags($this->request->get('tags'), 'App\Models\Wiki', $wiki->id);
        }

        return redirect()->back()->with([
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

    public function getTagWikis(Team $team, Tag $tag)
    {
        $spaces = $this->space->getTeamSpaces($team->id);
        
        $wikis = (new Tag)->getTeamTagWikis($team->id, $tag->id);

        return view('tag.wikis', compact('team', 'wikis', 'tag', 'spaces'));
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
        
        $activities     = $this->wiki->getActivty($wiki->id);

        return view('wiki.activity', compact('team', 'space', 'wiki', 'activities', 'isUserLikeWiki'));
    }

    public function overview(Team $team, Space $space, Wiki $wiki)
    {
        $isUserLikeWiki = $this->isUserLikeWiki($wiki);

        $wikiLastUpdated = Activity::where('subject_type', Wiki::class)->where('subject_id', $wiki->id)->orderBy('created_at', 'desc')->first()->updated_at->timezone(Auth::user()->timezone)->toDayDateTimeString();

        $spaces = $this->space->getTeamSpaces($team->id);

        $wikiTags = $this->wiki->find($wiki->id)->tags()->get();

        return view('wiki.setting.overview', compact('team', 'space', 'wiki', 'isUserLikeWiki', 'wikiLastUpdated', 'spaces', 'wikiTags'));
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

    public function generatePdf(Team $team, Space $space, Wiki $wiki)
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
                    '.$wiki->name.'
                </p>
                <h1></h1>
            </body>
            </html>
        ';

        return Pdf::loadView('pdf.page', compact('wiki'))->setOption('header-html',$header)->inline($wiki->name . '.pdf');
    }

    public function generateWord(Team $team, Space $space, Wiki $wiki)
    {
        $htmltodoc = new HtmlToDocHelper();

        return response()->json($htmltodoc->createDoc($wiki->description, $wiki->name.".doc", true), 200);
    }

    public function watch(Team $team, Space $space, Wiki $wiki)
    {
        WatchWiki::create([
            'wiki_id' => $wiki->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with([
            'alert'      => 'You are now watching this wiki.',
            'alert_type' => 'success',
        ]);
    }

    public function stopWatch(Team $team, Space $space, Wiki $wiki)
    {
        WatchWiki::where('user_id', Auth::user()->id)->where('wiki_id', $wiki->id)->delete();

        return redirect()->back()->with([
            'alert'      => 'You are now ignoring this wiki.',
            'alert_type' => 'success',
        ]);
    }

    public function addToReadList(Team $team, Space $space, Wiki $wiki)
    {
        ReadList::create([
            'subject_id' => $wiki->id,
            'subject_type' => Wiki::class,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with([
            'alert'      => 'Wiki successfully added to read list.',
            'alert_type' => 'success',
        ]);
    }

    public function removeFromReadList(Team $team, Space $space, Wiki $wiki)
    {
        ReadList::where('user_id', Auth::user()->id)->where('subject_id', $wiki->id)->where('subject_type', Wiki::class)->delete();

        return redirect()->back()->with([
            'alert'      => 'Wiki successfully removed from read list.',
            'alert_type' => 'success',
        ]);
    }
}
