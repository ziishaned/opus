<?php

namespace App\Http\Controllers;

use Pdf;
use Auth;
use App\Models\Tag;
use App\Models\Team;
use App\Models\Wiki;
use App\Models\Space;
use App\Models\ReadList;
use App\Models\Activity;
use App\Models\WatchWiki;
use Illuminate\Http\Request;
use App\Helpers\HtmlToDocHelper;

/**
 * Class WikiController
 *
 * @package App\Http\Controllers
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class WikiController extends Controller
{
    /**
     * @var \App\Models\Wiki
     */
    private $wiki;

    /**
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * @var \App\Models\Space
     */
    private $space;

    /**
     * @var \App\Models\Tag
     */
    private $tag;

    /**
     * @var \App\Models\ReadList
     */
    private $readList;

    /**
     * @var \App\Models\WatchWiki
     */
    private $watchWiki;

    /**
     * WikiController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Wiki         $wiki
     * @param \App\Models\Space        $space
     * @param \App\Models\Tag          $tag
     * @param \App\Models\ReadList     $readList
     * @param \App\Models\WatchWiki    $watchWiki
     */
    public function __construct(Request $request, Wiki $wiki, Space $space, Tag $tag, ReadList $readList, WatchWiki $watchWiki)
    {
        $this->tag       = $tag;
        $this->wiki      = $wiki;
        $this->space     = $space;
        $this->request   = $request;
        $this->readList  = $readList;
        $this->watchWiki = $watchWiki;
    }

    /**
     * Show a view to create a new wiki. If there is no space exists in team then
     * user will be redirected to create space view.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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

    /**
     * Create a new wiki.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Team $team)
    {
        $this->validate($this->request, Wiki::WIKI_RULES);

        $wiki = $this->wiki->saveWiki($this->request->all(), $team->id);

        if (!empty($this->request->get('tags'))) {
            $this->tag->createTags($this->request->get('tags'), Wiki::class, $wiki->id);
        }

        return redirect()->route('wikis.show', [$team->slug, $wiki->space->slug, $wiki->slug])->with([
            'alert'      => 'Wiki successfully created.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Show a wiki.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
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

    /**
     * Show a view to edit a wiki.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Team $team, Space $space, Wiki $wiki)
    {
        $wikiTags = $this->wiki->find($wiki->id)->tags()->get();

        $spaces = $this->space->getTeamSpaces($team->id);

        $editWiki = true;

        return view('wiki.edit', compact('wiki', 'team', 'spaces', 'space', 'editWiki', 'wikiTags'));
    }

    /**
     * Update an existing wiki.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Team $team, Space $space, Wiki $wiki)
    {
        $this->wiki->updateWiki($wiki->id, $this->request->all());

        if (!empty($this->request->get('tags'))) {
            $this->tag->updateTags($this->request->get('tags'), Wiki::class, $wiki->id);
        }

        return redirect()->route('wikis.show', [$team->slug, $wiki->space->slug, $wiki->slug])->with([
            'alert'      => 'Wiki successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Update the overview(name, space_id, outline) of a wiki.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\RedirectResponse
     */
    public function overviewUpdate(Team $team, Space $space, Wiki $wiki)
    {
        $this->validate($this->request, Wiki::WIKI_RULES);

        $this->wiki->where('id', $wiki->id)->update([
            'name'     => $this->request->get('name'),
            'space_id' => (int)$this->request->get('space'),
            'outline'  => $this->request->get('outline'),
        ]);

        if (!empty($this->request->get('tags'))) {
            $this->tag->updateTags($this->request->get('tags'), Wiki::class, $wiki->id);
        }

        return redirect()->back()->with([
            'alert'      => 'Wiki successfully updated.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Delete a wiki.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Team $team, Space $space, Wiki $wiki)
    {
        $this->wiki->deleteWiki($wiki->id);

        return redirect()->route('dashboard', [$team->slug])->with([
            'alert'      => 'Wiki successfully deleted.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Get all wikis having a specific tag.
     *
     * @param \App\Models\Team $team
     * @param \App\Models\Tag  $tag
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getTagWikis(Team $team, Tag $tag)
    {
        $spaces = $this->space->getTeamSpaces($team->id);

        $wikis = $this->tag->getTeamTagWikis($team->id, $tag->id);

        return view('tag.wikis', compact('team', 'wikis', 'tag', 'spaces'));
    }

    /**
     * Get the setting view of the wiki.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setting(Team $team, Space $space, Wiki $wiki)
    {
        $isUserLikeWiki = self::isUserLikeWiki($wiki);

        $wikiLastUpdated = Activity::where('subject_type', Wiki::class)->where('subject_id', $wiki->id)->orderBy('created_at', 'desc')->first()->updated_at->timezone(Auth::user()->timezone)->toDayDateTimeString();

        $spaces = $this->space->getTeamSpaces($team->id);

        $wikiTags = $this->wiki->find($wiki->id)->tags()->get();

        return view('wiki.setting.overview', compact('team', 'space', 'wiki', 'isUserLikeWiki', 'wikiLastUpdated', 'spaces', 'wikiTags'));
    }

    /**
     * Check if a user liked a wiki or not.
     *
     * @param $wiki
     * @return bool
     */
    public static function isUserLikeWiki($wiki)
    {
        $isLiked = false;
        foreach ($wiki->likes as $like) {
            if ($like->user_id === Auth::user()->id) {
                $isLiked = true;
            }
        }

        return $isLiked;
    }

    /**
     * Generate the .pdf file of wiki.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return mixed
     */
    public function generatePdf(Team $team, Space $space, Wiki $wiki)
    {
        return Pdf::loadView('pdf.page', compact('wiki'))->setOption('header-html', view('pdf.header', compact('wiki')))->inline($wiki->name . '.pdf');
    }

    /**
     * Generate a .doc file of wiki.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateWord(Team $team, Space $space, Wiki $wiki)
    {
        return response()->json((new HtmlToDocHelper)->createDoc($wiki->description, $wiki->name . ".doc", true), 200);
    }

    /**
     * Add wiki to watching list.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\RedirectResponse
     */
    public function watch(Team $team, Space $space, Wiki $wiki)
    {
        $this->watchWiki->watchWiki($wiki->id);

        return redirect()->back()->with([
            'alert'      => 'You are now watching this wiki.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Remove a wiki from watching list.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\RedirectResponse
     */
    public function stopWatch(Team $team, Space $space, Wiki $wiki)
    {
        $this->watchWiki->unwatchWiki($wiki->id);

        return redirect()->back()->with([
            'alert'      => 'You are now ignoring this wiki.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Insert a wiki in read list.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addToReadList(Team $team, Space $space, Wiki $wiki)
    {
        $this->readList->createSubject($wiki->id, Wiki::class);

        return redirect()->back()->with([
            'alert'      => 'Wiki successfully added to read list.',
            'alert_type' => 'success',
        ]);
    }

    /**
     * Remove a wiki from read list.
     *
     * @param \App\Models\Team  $team
     * @param \App\Models\Space $space
     * @param \App\Models\Wiki  $wiki
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFromReadList(Team $team, Space $space, Wiki $wiki)
    {
        $this->readList->deleteSubject($wiki->id, Wiki::class);

        return redirect()->back()->with([
            'alert'      => 'Wiki successfully removed from read list.',
            'alert_type' => 'success',
        ]);
    }
}
