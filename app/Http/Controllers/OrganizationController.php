<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OrganizationController
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Http\Controllers
 */
class OrganizationController extends Controller
{
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * @var \App\Models\Organization
     */
    protected $organization;

    /**
     * @var \App\Http\Controllers\UserController
     */
    private $user;

    /**
     * OrganizationController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organization $organization
     * @param \App\Models\User         $user
     */
    public function __construct(Request $request, Organization $organization, User $user)
    {
        $this->middleware('auth');
        $this->request      = $request;
        $this->organization = $organization;
        $this->user         = $user;
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
     * @param  string $organizationSlug
     * @return mixed
     */
    public function show($organizationSlug)
    {
        $organization       = $this->organization->getOrganization($organizationSlug);
        $organizationWikis  = $this->organization->getWikis($organization);

        if($organization) {
            return view('organization.organization', compact('organization', 'organizationWikis'));
        }

        return abort(404);
    }

    /**
     * Get mem
     *
     * @param $organizationSlug
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMembers($organizationSlug)
    {
        $organization        = $this->organization->getOrganization($organizationSlug);
        $organizationMembers = $this->organization->getMembers($organization);
        return view('organization.members', compact('organization', 'organizationMembers'));
    }

    /**
     * Get the create organization view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
        return redirect()->route('organizations.invite.show')->with('organization_id', $organization);
    }

    /**
     * Get the invite user to organization view.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function getInvite() {
        if(!Session::get('organization_id')) {
            return redirect()->route('dashboard');
        }

        $organizationId = Session::get('organization_id');
        $user  = $this->user->getUser(Auth::user()->id);
        return view('organization.invite', compact('user', 'organizationId'));
    }

    /**
     * Invite user to organization.
     *
     * @return mixed
     */
    public function inviteUser() {
        $this->organization->inviteUser($this->request->all());
        return response()->json([
            'message' => 'User successfully Invited to organization.'
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove a user from organization.
     *
     * @return mixed
     */
    public function removeInvite() {
        $this->organization->removeInvite($this->request->all());
        return response()->json([
            'message' => 'User removed from organization invitation.'
        ], Response::HTTP_CREATED);
    }

    public function getActivity($organizationSlug) {
        $organization = $this->organization->getOrganization($organizationSlug);
        return view('organization.activity', compact('organization'));
    }

    /**
     * Return view with all the wikis of an organization.
     *
     * @param $organizationSlug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getWikis($organizationSlug)
    {
        $organization = $this->organization->getWikis($organizationSlug);
        return view('organization.wikis', compact('organization'));
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
        $organizationDeleted = $this->organization->deleteOrganization($id);
        if($organizationDeleted) {
            return redirect()->route('dashboard')->with([
                'alert' => 'Organization successfully deleted.',
                'alert_type' => 'success'
            ]);
        }
        return response()->json([
            'message' => 'We are having some issues.'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    /**
     * Filter the organization.
     *
     * @param mixed $text
     * @return \App\Models\Organization
     */
    public function filterOrganizations($text)
    {
        return $this->organization->filterOrganizations($text);
    }
}
