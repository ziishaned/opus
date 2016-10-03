<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    protected $request;
    protected $organization;

    public function __construct(Request $request, Organization $organization)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->organization = $organization;
    }

    /**
     * Get all organization.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->organization->getOrganizations();
    }

    /**
     * Get a specific organization.
     *
     * @param  integer $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->organization->getOrganization($id);
    }

    /**
     * Get the create organization view.
     */
    public function create()
    {

    }

    /**
     * Creates a new organization.
     *
     * @return mixed
     */
    public function store()
    {
        $this->validate($this->request, [
           'organization_name' => 'required|max:55|unique:organization,name',
        ]);

        return $this->organization->postOrganization($this->request->get('organization_name'));
    }

    /**
     * Get the edit organization view.
     *
     * @param integer $id
     */
    public function edit($id)
    {

    }

    /**
     * This function updates organization data.
     *
     * @param  integer $id
     * @return mixed
     */
    public function update($id)
    {
        $this->validate($this->request, [
            'organization_name' => 'required|max:55|unique:organization,name',
        ]);

        return $this->organization->updateOrganization($id, $this->request->get('organization_name'));
    }

    /**
     * Deletes an organization.
     *
     * @param  integer $id
     * @return mixed
     */
    public function destroy($id)
    {
        return $this->organization->deleteOrganization($id);
    }
}
