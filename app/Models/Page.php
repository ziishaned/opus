<?php

namespace App\Models;

use Auth;
use Baum\Node;
use Notifynder;
use Illuminate\Notifications\Notifiable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\Page\CreatePageNotification;
use App\Notifications\Page\DeletePageNotification;
use App\Notifications\Page\UpdatePageNotification;

/**
 * Class Page
 *
 * @package App\Models
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 */
class Page extends Node
{
    use Sluggable, RecordsActivity, SoftDeletes, Notifiable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'page';

    /**
     * Column that is use to order the fetched records.
     *
     * @var string
     */
    protected $orderColumn = 'position';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'outline', 'description', 'position', 'parent_id', 'user_id',
        'wiki_id', 'team_id', 'created_at', 'updated_at', 'lft', 'rgt', 'depth',
    ];

    const PAGE_RULES = [
        'name' => 'required|max:35',
    ];

    protected $dates = ['deleted_at'];

    public function routeNotificationForSlack()
    {
        $integration = Team::getIntegration(Auth::user()->getTeam()->id);

        return $integration ? $integration->url : null;
    }

    public static function boot()
    {
        parent::boot();

        static::created(function ($page) {
            $page->notify(new CreatePageNotification($page));

            $watchingList = (new WatchWiki)->getWikiWatchers($page->wiki_id);

            if (!empty($watchingList)) {
                foreach ($watchingList as $watch) {
                    $url = route('pages.show', [Auth::user()->getTeam()->slug, $watch->wiki->space->slug, $watch->wiki->slug, $page->slug]);
                    Notifynder::category('page.created')
                        ->from(Auth::user()->id)
                        ->to($watch->user_id)
                        ->url($url)
                        ->extra(['wiki_name' => $watch->wiki->name, 'username' => Auth::user()->name, 'page_name' => $page->name])
                        ->send();
                }
            }
        });

        static::updated(function ($page) {
            $page->notify(new UpdatePageNotification($page));

            $watchingList = (new WatchWiki)->getWikiWatchers($page->wiki_id);

            if (!empty($watchingList)) {
                foreach ($watchingList as $watch) {
                    $url = route('pages.show', [Auth::user()->getTeam()->slug, $watch->wiki->space->slug, $watch->wiki->slug, $page->slug]);
                    Notifynder::category('page.updated')
                        ->from(Auth::user()->id)
                        ->to($watch->user_id)
                        ->url($url)
                        ->extra(['wiki_name' => $watch->wiki->name, 'username' => Auth::user()->name, 'page_name' => $page->name])
                        ->send();
                }
            }
        });

        static::deleting(function ($page) {
            $page->notify(new DeletePageNotification($page));

            $watchingList = (new WatchWiki)->getWikiWatchers($page->wiki_id);

            if (!empty($watchingList)) {
                foreach ($watchingList as $watch) {
                    $url = route('pages.show', [Auth::user()->getTeam()->slug, $watch->wiki->space->slug, $watch->wiki->slug, $page->slug]);
                    Notifynder::category('page.deleted')
                        ->from(Auth::user()->id)
                        ->to($watch->user_id)
                        ->url($url)
                        ->extra(['wiki_name' => $watch->wiki->name, 'username' => Auth::user()->name, 'page_name' => $page->name])
                        ->send();
                }
            }
        });
    }

    /**
     * Get the comments that owns the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'subject_id', 'id')->where('comments.subject_type', Page::class)->with('user');
    }

    /**
     * Get the tags that owns the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'page_tags', 'subject_id', 'tag_id')->where('page_tags.subject_type', Page::class);
    }



    /**
     * Get the likes that owns the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function likes()
    {
        return $this->hasMany(Like::class, 'subject_id', 'id')->where('likes.subject_type', Page::class);
    }

    /**
     * Get all the child's of a page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childPages()
    {
        return $this->hasMany(Page::class, 'parent_id', 'id')->with('childPages');
    }

    /**
     * Get the user that owns the wiki.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wiki()
    {
        return $this->belongsTo(Wiki::class, 'wiki_id', 'id')->withTrashed();
    }

    /**
     * Get the user that owns the page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get all the nodes|pages of a wiki.
     *
     * @param $wikiId integer
     * @return mixed
     */
    public function getPages($wikiId)
    {
        return $this->where('wiki_id', $wikiId)->with(['wiki'])->get();
    }

    /**
     * Get all the root|pages of a wiki.
     *
     * @param  $wiki
     * @return mixed
     */
    public function getRootPages($wiki)
    {
        $roots = $this->whereNull('parent_id')->where('wiki_id', $wiki->id)->with(['wiki', 'childPages'])->get();

        return $roots;
    }

    /**
     * Get all the child's of a page|node.
     *
     * @param $pageSlug string
     * @return mixed
     */
    public function getPageChilds($pageSlug)
    {
        $page = $this->where('slug', $pageSlug)->first();

        return $this->where('parent_id', $page->id)->with(['wiki', 'childPages'])->get();
    }

    /**
     * Get a wiki pages tree to a specific node.
     *
     * @param $page object
     * @return mixed
     */
    public function getTreeTo($page)
    {
        return $this->find($page->id)->getAncestorsAndSelf()->toHierarchy();
    }

    /**
     * Store a page.
     *
     * @param $wiki object
     * @param $data array
     * @return static
     */
    public function saveWikiPage($wiki, $data)
    {
        return $this->create([
            'name'        => $data['name'],
            'outline'     => $data['outline'],
            'description' => $data['description'],
            'parent_id'   => !empty($data['page_parent']) ? (int)$data['page_parent'] : null,
            'position'    => $data['position'],
            'user_id'     => Auth::user()->id,
            'wiki_id'     => $wiki->id,
            'team_id'     => Auth::user()->getTeam()->id,
        ]);
    }

    /**
     * Retrieve a page.
     *
     * @param $slug string
     * @return bool|object
     */
    public function getPage($slug)
    {
        $page = $this->where('slug', '=', $slug)->where('user_id', '=', Auth::user()->id)->with(['comments', 'wiki'])->first();
        if (is_null($page)) {
            return false;
        }

        return $page;
    }

    /**
     * Update a page
     *
     * @param $id   integer
     * @param $data array
     * @return mixed
     */
    public function updatePage($id, $data)
    {
        return $this->find($id)->update([
            'name'        => $data['name'],
            'description' => $data['description'],
            'outline'     => $data['outline'],
            'parent_id'   => !empty($data['page_parent']) ? $data['page_parent'] : null,
        ]);
    }

    /**
     * Delete a page
     *
     * @param $id integer
     * @return mixed
     */
    public function deletePage($id)
    {
        return $this->find($id)->delete();
    }
}
