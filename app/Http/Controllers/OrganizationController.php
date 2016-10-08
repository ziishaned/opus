<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class OrganizationController extends Controller
{
    protected $request;
    protected $organization;
    /**
     * @var \App\Http\Controllers\User
     */
    private $user;

    public function __construct(Request $request, Organization $organization, User $user)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->organization = $organization;
        $this->user = $user;
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
        $organization = $this->organization->getOrganization($id);
        if($organization) {
            return $organization;
        }
        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Get the create organization view.
     */
    public function create()
    {
        $user  = $this->user->getUser(Auth::user()->id);
        return view('organization.create', compact('user'));
    }

    /**
     * Creates a new organization.
     *
     * @return mixed
     */
    public function store()
    {
        $this->validate($this->request, Organization::ORGANIZATION_RULES);
        $organization = $this->organization->postOrganization($this->request->get('organization_name'));
        return redirect()->to('/organization/invite')->with('organization_id', $organization);
    }

    public function getInvite() {
        if(!Session::get('organization_id')) {
            return redirect()->to('/');
        }

        $organizationId = Session::get('organization_id');
        $user  = $this->user->getUser(Auth::user()->id);
        return view('organization.invite', compact('user', 'organizationId'));
    }

    public function inviteUser() {
        $this->organization->inviteUser($this->request->all());
        return response()->json([
            'message' => 'User successfully Invited to organization.'
        ], Response::HTTP_CREATED);
    }

    public function removeInvite() {
        $this->organization->removeInvite($this->request->all());
        return response()->json([
            'message' => 'User removed from organization invitation.'
        ], Response::HTTP_CREATED);
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
        $this->validate($this->request, Organization::ORGANIZATION_RULES);
        $updated = $this->organization->updateOrganization($id, $this->request->get('organization_name'));
        if($updated) {
            return response()->json([
                'message' => 'Organization successfully updated.'
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Deletes an organization.
     *
     * @param  integer $id
     * @return mixed
     */
    public function destroy($id)
    {
        $deleted = $this->organization->deleteOrganization($id);
        if($deleted) {
            return response()->json([
                'message' => 'Organization successfully deleted.'
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Resource not found.'
        ], Response::HTTP_NOT_FOUND);
    }
}
