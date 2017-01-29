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
    public function store($organizationSlug)
    {
        $this->validate($this->request, Category::CATEGORY_RULES);

        $organization = $this->organization->getOrganization($organizationSlug);
        
        $this->category->createCategory($this->request->all(), $organization->id);

        return redirect()->back()->with([
            'alert' => 'Category successfully created.',
            'alert_type' => 'success'
        ]);
    }

    public function destroy($organizationSlug, $categoryId) 
    {
        $organization = $this->organization->getOrganization($organizationSlug);
        
        $this->category->deleteCategory($categoryId, $organization->id);

        return redirect()->back()->with([
            'alert' => 'Category successfully deleted.',
            'alert_type' => 'success'
        ]);
    }

    public function update($organizationSlug, $categoryId)
    {
        $this->validate($this->request, Category::CATEGORY_RULES);
        
        $organization = $this->organization->getOrganization($organizationSlug);
        
        $this->category->updateCategory($this->request->all(), $categoryId, $organization->id);

        return redirect()->back()->with([
            'alert' => 'Category successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    public function getCategoryWikis($organizationSlug, $categorySlug)
    {
        $organization = $this->organization->getOrganization($organizationSlug);

        $category = $this->category->getCategory($categorySlug, $organization->id);

        return view('organization.categories.wikis', compact('organization', 'category'));
    }
}
