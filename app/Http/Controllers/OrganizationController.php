<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Redirect;
use Carbon\Carbon;
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

    public function join()
    {
        return view('organization.join');
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

    public function postJoin()
    {
        $this->validate($this->request, Organization::JOIN_ORGANIZATION_RULES, [
            'exists' => 'Specified organization does\'t exists.',
        ]);

        $organization = $this->organization->where('name', $this->request->get('organization_name'))->first();
        $this->validate($this->request, [
            'email' => 'required|organization_has_email:' . $organization->id . '|email',
        ]);
    
        // Create the user        
        $user  = $this->user->createUser($this->request->all());

        // Join the organization
        DB::table('user_organization')->insert([
            'user_type'       => 'normal',
            'user_id'         => $user->id,
            'organization_id' => $organization->id,
            'created_at'      => Carbon::now(),
            'updated_at'      => Carbon::now(),
        ]);

        return redirect()->route('home')->with([
            'alert'      => 'Team successfully joined. You can login to joined team now.',
            'alert_type' => 'success',
        ]);
    }

    public function inviteUsers(Organization $organization)
    {
        return view('organization.users.invite', compact('organization'));
    }

    public function login()
    {
        return view('organization.login');
    }

    public function postLogin()
    {
        $this->validate($this->request, User::LOGIN_RULES, [
            'exists' => 'Organization does not exists.' 
        ]);

        $data = [
            'email' => $this->request->get('email'), 
            'password' => $this->request->get('password'),
            'organization' => $this->request->get('organization'),
        ];

        if($data = $this->user->validate($data)) {
            Auth::login($data, $this->request->get('remember'));

            return redirect()->route('dashboard', [
                $data->organization_slug, 
            ]);
        } 

        return redirect()->back()->with([
            'alert'      => 'Email or password is not valid.',
            'alert_type' => 'danger',
        ]);
    }

    public function create()
    {
        return view('organization.create');
    }

    public function store()
    {
        $this->validate($this->request, Organization::CREATE_ORGANIZATION_RULES);

        $user = $this->user->createUser($this->request->all());

        $organization = collect($this->request->all())->put('user_id', $user->id);
        $this->organization->postOrganization($organization);

        return redirect()->route('home')->with([
            'alert'      => 'Team successfully created. Now sign in to your team!',
            'alert_type' => 'success',
        ]);
    }
}
