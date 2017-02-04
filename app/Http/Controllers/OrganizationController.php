<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Redirect;
use App\Models\User;
use App\Models\Category;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class OrganizationController
 *
 * @author  Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Http\Controllers
 */
class OrganizationController extends Controller
{
    private $request;

    private $organization;

    private $user;


    private $category;

    public function __construct(Request $request,
                                Organization $organization,
                                User $user,
                                Category $category)
    {
        $this->user         = $user;
        $this->request      = $request;
        $this->category     = $category;
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
     * Get mem
     *
     *
     * @param \App\Models\Organization $organization
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getMembers(Organization $organization)
    {
        $organizationMembers = $this->organization->getMembers($organization);

        return view('organization.members', compact('organization', 'organizationMembers'));
    }

    public function join($step)
    {
        return view('organization.join.' . $step, compact('step'));
    }

    public function isContentTypeJson()
    {
        return $this->request->header('content-type') == 'application/json';
    }

    public function getCategories(Organization $organization)
    {
        if ($this->isContentTypeJson()) {
            $wikis = [];

            foreach ($organization->wikis as $key => $wiki) {

                if (count($wikis) >= 5) {
                    break;
                }

                $wikis[] = [
                    'url'  => route('wikis.show', [$organization->slug, $wiki->slug]),
                    'name' => $wiki->name,
                ];
            }

            return $wikis;
        }

        $categories = $this->category->where('organization_id', '=', $organization->id)->with(['wikis'])->get();

        return view('organization.category', compact('organization', 'categories'));
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
     *
     * @return mixed
     */
    public function update($id)
    {
        $this->validate($this->request, Organization::ORGANIZATION_RULES);
        $updated = $this->organization->updateOrganization($id, $this->request->get('organization_name'));
        if ($updated) {
            return response()->json([
                'message' => 'Organization successfully updated.',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Resource not found.',
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Deletes an organization.
     *
     * @param  integer $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        $organizationDeleted = $this->organization->deleteOrganization($id);
        if ($organizationDeleted) {
            return redirect()->route('dashboard')->with([
                'alert'      => 'Organization successfully deleted.',
                'alert_type' => 'success',
            ]);
        }

        return response()->json([
            'message' => 'We are having some issues.',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function postJoin($step)
    {
        $rules             = [];
        $validationMessage = [];
        switch ($step) {
            case 1:
                $rules             = [
                    'organization_name' => 'required|exists:organization,name',
                ];
                $validationMessage = [
                    'exists' => 'Specified organization does\'t exists.',
                ];
                break;
            case 2:
                $organization = $this->organization->where('name', 'like', '%' . Session::get('organization_name') . '%')->first();

                $rules = [
                    'email'    => 'required|organization_has_email:' . $organization->id . '|email',
                    'password' => 'required|confirmed',
                ];
                break;
            default:
                abort(404);
        }

        $this->validate($this->request, $rules, $validationMessage);

        switch ($step) {
            case 1:
                Session::put('organization_name', $this->request->get('organization_name'));
                break;
            case 2:
                break;
            default:
                abort(404);
        }

        if ($step == 2) {
            $userInfo = [
                'first_name' => $this->request->get('first_name'),
                'last_name'  => $this->request->get('last_name'),
                'password'   => $this->request->get('password'),
                'email'      => $this->request->get('email'),
                'active'     => '0',
            ];
            $this->user->createUser($userInfo);

            return redirect()->route('home')->with([
                'alert'      => 'A request is sent to admins for joining this '. Session::get('organization_name')  . ' organization. You will be notified on your email.',
                'alert_type' => 'success',
            ]);
        }

        return redirect()->action('OrganizationController@join', ['step' => $step + 1]);
    }

    public function getActivity(Organization $organization)
    {
        $activities = $this->organization->getActivty($organization->id)->activity;

        return view('organization.activity', compact('organization', 'activities'));
    }

    public function inviteUsers(Organization $organization)
    {
        return view('organization.users.invite', compact('organization'));
    }
}
