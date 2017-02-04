<?php

namespace App\Http\Controllers;

use Hash;
use Image;
use Session;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UserController
 *
 * @author Zeeshan Ahmed <ziishaned@gmail.com>
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    protected $profileImagePath = 'images/profile-pics';

    /**
     * UserController constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User         $user
     */
    public function __construct(Request $request, User $user)
    {
        $this->user    = $user;
        $this->request = $request;
    }

    /**
     * Display the specified resource.
     *
     * @param         $organizationSlug
     * @param  string $userSlug
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization, User $user)
    {   
        $activities = $this->user->getActivty($user->id)->activity;

        return view('user.user', compact('user', 'organization', 'activities'));
    }

    public function storeAvatar() {
        $image = $this->request->file('profile_image');
        
        $imageName = 'img_' . date('Y-m-d-H-s') .  '.' . $this->request->file('profile_image')->getClientOriginalExtension();

        $path = public_path('images/profile-pics/' . $imageName);

        Image::make($image->getRealPath())->save($path);
        
        User::find(Auth::user()->id)->update([
            'profile_image' => $imageName,
        ]);
        
        return response()->json([
            'message' => 'Profile picture uploaded successfully.',
            'image' => $imageName
        ], \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED);
    }

    public function cropAvatar() 
    {
        $img = Image::make(public_path('/images/profile-pics/' . $this->request->get('image')));
        $img->crop((int) $this->request->get('w'), (int) $this->request->get('h'), (int) $this->request->get('x'), (int) $this->request->get('y'));
        $img->save();

        return response()->json([
            'message' => 'Profile picture successfully cropped.'
        ], \Symfony\Component\HttpFoundation\Response::HTTP_ACCEPTED);
    }

    public function profileSettings(Organization $organization)
    {
        return view('user.setting.profile', compact('organization'));
    }

    public function accountSettings(Organization $organization)
    {
        return view('user.setting.account', compact('organization'));
    }

    public function update($slug)
    {
        $this->validate($this->request, [
            'email'         => 'required|unique:users,email,' . Auth::user()->id . '|email',
            'profile_image' => 'mimes:jpeg,jpg,png|max:1000',
        ]);

        $profile_image = '';
        if($this->request->file('profile_image')) {
            $file = $this->request->file('profile_image');
            $profile_image = md5(microtime() . $file->getClientOriginalName()) . "." . $file->getClientOriginalExtension();
            $this->request->file('profile_image')->move($this->profileImagePath, $profile_image);
        }

        $this->user->updateUser($slug, $this->request->all(), $profile_image);

        return redirect()->back()->with([
            'alert' => 'Profile successfully updated.',
            'alert_type' => 'success'
        ]);
    }

    public function updatePassword($slug)
    {
        $this->validate($this->request, [
            'password' => 'required|hash:' . Auth::user()->password,
            'new_password'  => 'required|same:password_confirmation',
            'password_confirmation'  => 'required'
        ]);

        $this->user->updatePassword($slug, $this->request->all());

        return $this->logout();
    }

    public function deleteAccount($slug)
    {
        $this->user->where('slug', '=', $slug)->delete();

        return $this->logout();
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return redirect('/');
    }

    public function getReadList(Organization $organization, User $user)
    {
        return view('user.readlist', compact('organization'));
    }

    public function createOrganization()
    {
        return view('organization.create');
    }

    public function postCreateOrganization()
    {
        dd($this->request->all());
        switch ($step) {
            case 1:
                $rules = ['email' => 'required|email'];
                break;
            case 2:
                $rules = [
                    'validation_key' => 'required',
                ];
                break;
            case 3:
                $rules = [
                    'first_name' => 'required|max:15',
                    'last_name'  => 'required|max:15',
                    'password'   => 'required|min:6|confirmed',
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

        switch ($step) {
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
                if ($this->request->get('validation_key') == Session::get('validation_key')) {
                    break;
                }

                return redirect()->back()->withErrors([
                    'validation_key' => 'Validation key mismatch.',
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
                    'last_name'  => Session::get('last_name'),
                    'password'   => Session::get('password'),
                    'email'      => Session::get('email'),
                    'active'     => '1',
                ];
                $user     = $this->user->createUser($userInfo);

                $organizationData = [
                    'organization_name' => $this->request->get('organization_name'),
                    'description'       => $this->request->get('description'),
                    'user_id'           => $user->id,
                ];
                $organization     = $this->organization->postOrganization($organizationData);

                $categories = [
                    [
                        'name'            => 'Engineering',
                        'user_id'         => $user->id,
                        'organization_id' => $organization->id,
                    ],
                    [
                        'name'            => 'New Employee Onboarding',
                        'user_id'         => $user->id,
                        'organization_id' => $organization->id,
                    ],
                    [
                        'name'            => 'Marketing',
                        'user_id'         => $user->id,
                        'organization_id' => $organization->id,
                    ],
                    [
                        'name'            => 'Product',
                        'user_id'         => $user->id,
                        'organization_id' => $organization->id,
                    ],
                    [
                        'name'            => 'Human Resuorces',
                        'user_id'         => $user->id,
                        'organization_id' => $organization->id,
                    ],
                    [
                        'name'            => 'Sales',
                        'user_id'         => $user->id,
                        'organization_id' => $organization->id,
                    ],
                ];
                foreach ($categories as $category) {
                    $this->category->create($category);
                }

                break;
            default:
                abort(404);
        }

        if ($step == 4) {
            return redirect()->route('home')->with([
                'alert'      => 'Organization created successfully. Now sign in to your organization!',
                'alert_type' => 'success',
            ]);
        }

        return redirect()->action('OrganizationController@create', ['step' => $step + 1]);
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
    
    public function getOrganizations()
    {
        return response()->json([
            'organizations' => $this->user->where('email', $this->request->get('email'))->with('organizations')->first()->organizations,
        ], \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }    
}
