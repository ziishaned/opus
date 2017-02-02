<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Organization;

class CategoryConroller extends Controller
{
	private $request;

    private $organization;

    private $category;

    public function __construct(Request $request, Organization $organization, Category $category)
    {
    	$this->category = $category;
        $this->request      = $request;
        $this->organization = $organization;
    }
    public function store(Organization $organization)
    {
        $this->validate($this->request, Category::CATEGORY_RULES);
        
        $this->category->createCategory($this->request->all(), $organization->id);

        return redirect()->back()->with([
            'alert' => 'Category successfully created.',
            'alert_type' => 'success'
        ]);
    }

    public function destroy(Organization $organization, Category $category) 
    {
        $this->category->deleteCategory($category->id);

        return redirect()->back()->with([
            'alert' => 'Category successfully deleted.',
            'alert_type' => 'success'
        ]);
    }

    public function update(Organization $organization, Category $category)
    {
        $this->validate($this->request, Category::CATEGORY_RULES);
        
        $this->category->updateCategory($this->request->all(), $category->id, $organization->id);

        return redirect()->back()->with([
            'alert' => 'Category successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    public function getCategoryWikis(Organization $organization, Category $category)
    {
        return view('organization.categories.wikis', compact('organization', 'category'));
    }
}
