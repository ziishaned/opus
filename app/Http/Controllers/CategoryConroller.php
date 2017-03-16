<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Wiki;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryConroller extends Controller
{
	private $request;

    private $team;

    private $category;

    public function __construct(Request $request, Team $team, Category $category)
    {
    	$this->category     = $category;
        $this->request      = $request;
        $this->team         = $team;
    }

    public function create(Team $team)
    {
        return view('category.create', compact('team'));
    }

    public function store(Team $team)
    {
        $this->validate($this->request, Category::CATEGORY_RULES);
        
        $this->category->createCategory($this->request->all(), $team->id);

        return redirect()->back()->with([
            'alert' => 'Category successfully created.',
            'alert_type' => 'success'
        ]);
    }

    public function destroy(Team $team, Category $category) 
    {
        $this->category->deleteCategory($category->id);

        return redirect()->back()->with([
            'alert' => 'Category successfully deleted.',
            'alert_type' => 'success'
        ]);
    }

    public function update(Team $team, Category $category)
    {
        $this->validate($this->request, Category::CATEGORY_RULES);
        
        $this->category->updateCategory($this->request->all(), $category->id, $team->id);

        return redirect()->back()->with([
            'alert' => 'Category successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    public function getCategoryWikis(Team $team, Category $category)
    {
        $wikis = (new Wiki)->where('team_id', $team->id)->where('category_id', $category->id)->latest()->paginate(30);

        $categories = $this->category->getTeamCategories($team->id);

        return view('category.index', compact('team', 'category', 'categories', 'wikis'));
    }

    public function getTeamCategories(Team $team)
    {
        return $this->category->where('team_id', $team->id)->with(['team'])->orderBy('name', 'asc')->get();
    }
}
