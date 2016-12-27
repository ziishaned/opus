<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Redirect;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Organization;
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

    private $activity;

    /**
     * OrganizationController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Organization $organization
     * @param \App\Models\User         $user
     */
    public function __construct(Request $request, Organization $organization, User $user, ActivityLog $activity)
    {
        $this->request      = $request;
        $this->organization = $organization;
        $this->user         = $user;
        $this->activity     = $activity;
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
    public function create($step)
    {
        return view('organization.create.'.$step, compact('step'));
    }

    /**
     * Creates a new organization.
     *
     * @return mixed
     */
    public function store($step)
    {
        switch ($step)
        {
            case 1:
                $rules = ['email' => 'required|email'];
                break;
            case 2:
                $rules = [
                    'input_1' => 'required',
                    'input_2' => 'required',
                    'input_3' => 'required',
                    'input_4' => 'required',
                    'input_5' => 'required',
                    'input_6' => 'required',
                ];
                break;
            case 3:
                $rules = [
                    'first_name' => 'required|max:15',
                    'last_name' => 'required|max:15',
                    'password' => 'required|min:6|confirmed',
                ];
                break;
            case 4:
                $rules = [
                    'organization_name' => 'required|unique:organization,name',
                ];
                break;
            default:
                abort(404);
        }

        $this->validate($this->request, $rules);

        switch ($step)
        {
            case 1:
                $validation_key = mt_rand(100000, 999999);
                Session::put('email', $this->request->get('email'));
                Session::put('validation_key', $validation_key);

                // $title = "Validate your email";

                // Mail::send('emails.email-validation', ['title' => $title, 'validation_code' => $validation_key], function ($message)
                // {
                //     $message->from('wiki@info.com', 'Wiki');

                //     $message->to($this->request->get('email'));

                // });
                break;
            case 2:
                $validationKey = '';
                foreach ($this->request->all() as $value) {
                    $validationKey .= $value;
                }

                if($validationKey == Session::get('validation_key')) {
                    break;
                }
                return redirect()->back()->with([
                    'alert' => 'Validation key mismatch.',
                    'alert_type' => 'danger'
                ]);
                break;
            case 3:
                Session::put('first_name', $this->request->get('first_name'));
                Session::put('last_name', $this->request->get('last_name'));
                Session::put('password', $this->request->get('password'));
                break;
            case 4:
                $userInfo = [
                    'first_name' => Session::get('first_name'),
                    'last_name' => Session::get('last_name'),
                    'password' => Session::get('password'),
                    'email' => Session::get('email'),
                ];
                $user = (new \App\Models\User)->createUser($userInfo);
                
                $organization = [
                    'organization_name' => $this->request->get('organization_name'),
                    'description' => $this->request->get('description'),
                    'user_id' => $user->id,
                ];
                (new \App\Models\Organization)->postOrganization($organization);
                break;
            default:
                abort(404);
        }

        if ($step == 4) {
            return redirect()->route('home')->with([
                                            'alert'      => 'Organization created successfully. Now sign in to your organization!',
                                            'alert_type' => 'success'
                                        ]);
        }

        return redirect()->action('OrganizationController@create', ['step' => $step+1]);
    }

    public function getWikis() 
    {
        $organization = $this->organization->where('id', '=', $this->request->get('organization_id'))->with(['wikis'])->first();
        $wikis = [];

        foreach($organization->wikis as $key => $wiki) {
            
            if(count($wikis) >= 5) {
                break;
            }

            $wikis[] = [
                'url'  => route('wikis.show', [$wiki->slug]),
                'name' => $wiki->name
            ];
        }

        return $wikis;
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

    public function signin($step) 
    {
        return view('organization.signin.'.$step, compact('step'));
    }

    /**
     * Creates a new organization.
     *
     * @return mixed
     */
    public function postSignin($step)
    {
        $validationMessage = [];
        switch ($step)
        {
            case 1:
                $rules = [
                    'organization_name' => 'required|exists:organization,name',
                ];
                $validationMessage = [
                    'exists' => 'Specified organization does\'t exists.'
                ];
                break;
            case 2:
                $rules = [
                    'email' => 'required|email',
                    'password' => 'required',
                ];
                break;
            default:
                abort(404);
        }

        $this->validate($this->request, $rules, $validationMessage);

        switch ($step)
        {
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
                'email' => $this->request->get('email'),
                'password' => $this->request->get('password'),
                'organization' => Session::get('organization_name'),
            ];
            
            $user = $this->user->validate($userInfo);

            if($user) {
                Auth::login($user, $this->request->get('remember'));

                // Set the cookie having organization slug
                setcookie('organization_slug', Session::get('organization_name'), time() + (86400 * 30), "/");

                return redirect()->route('dashboard', [Session::get('organization_name'), ]);
            }


            return redirect()->back()->with([
                                        'alert'      => 'Email or password is not valid.',
                                        'alert_type' => 'danger'
                                    ]);
        }

        return redirect()->action('OrganizationController@signin', ['step' => $step+1]);
    }

    public function getActivity($organizationSlug) 
    {
        $organization = $this->organization->getOrganization($organizationSlug);   
        $activities   = $this->activity->getOrganizationActivity($organization->id);
        return view('organization.activity', compact('activities', 'organization'));        
    }
}
