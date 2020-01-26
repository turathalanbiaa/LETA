<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Enum\Certificate;
use App\Enum\Gender;
use App\Enum\Stage;
use App\Enum\UserState;
use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Models\User;
use PeterColes\Countries\CountriesFacade as Countries;

class UserController extends Controller
{
    protected $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param Auth $auth
     */
    public function __construct(UserRepository $userRepository, Auth $auth)
    {
        $auth->check();
        $auth->hasRole("User");
        $this->userRepository = $userRepository;
        $this->middleware('filter:userType')
            ->only(['index', 'create']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $type = request()->input("type");
        $users = $this->userRepository->getUsersByType($type, ['id', 'name', 'email', 'phone', 'state']);

        return view("dashboard.admin.user.index")->with([
            "type" => $type,
            "users" => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Countries::lookup(app()->getLocale());
        return view("dashboard.admin.user.create")->with([
            "type" => request()->input("type")
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return void
     */
    public function show(User $user)
    {


        dd("gtuyhui");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function simpleShow()
    {
        $id = base64_decode(request()->input('content'));
        $user = $this->userRepository->getUserById($id);

        if ($user)
        {
            $state = true;
            $collect = array(
                "name" => [
                    "value" => $user->name,
                    "text"  => __('dashboard-admin/user.column.name')
                ],
                "stage" => [
                    "value" => is_null($user->stage)?
                        __('dashboard-admin/user.column.null'):
                        Stage::getStageName($user->stage),
                    "text"  => __('dashboard-admin/user.column.stage')
                ],
                "email" => [
                    "value" => $user->email,
                    "text"  => __('dashboard-admin/user.column.email')
                ],
                "phone" => [
                    "value" => $user->phone,
                    "text"  => __('dashboard-admin/user.column.phone')
                ],
                "certificate" => [
                    "value" => is_null($user->certificate)?
                        __('dashboard-admin/user.column.null'):
                        Certificate::getCertificateName($user->certificate),
                    "text"  => __('dashboard-admin/user.column.certificate')
                ],
                "gender" => [
                    "value" => Gender::getGenderName($user->gender),
                    "text"  => __('dashboard-admin/user.column.gender')
                ],
                "country" => [
                    "value" => Country::getCountryName($user->country),
                    "text"  => __('dashboard-admin/user.column.country')
                ],
                "image" => [
                    "value" => $user->image,
                    "text"  => __('dashboard-admin/user.column.image')
                ],
                "birth_date" => [
                    "value" => is_null($user->birth_date)?
                        __('dashboard-admin/user.column.null'):
                        $user->birth_date,
                    "text"  => __('dashboard-admin/user.column.birth_date')
                ],
                "created_at" => [
                    "value" => $user->created_at,
                    "text"  => __('dashboard-admin/user.column.created_at')
                ],
                "last_login" => [
                    "value" => is_null($user->last_login)?
                        __('dashboard-admin/user.column.last_login_null'):
                        $user->last_login,
                    "text"  => __('dashboard-admin/user.column.last_login')
                ],
                "address" => [
                    "value" => is_null($user->address)?
                        __('dashboard-admin/user.column.null'):
                        $user->address,
                    "text"  => __('dashboard-admin/user.column.address')
                ],
                "state" => [
                    "value" => UserState::getStateName($user->state),
                    "text"  => __('dashboard-admin/user.column.state')
                ]
            );
        }

        return response()->json([
            'state' => $state ?? false,
            'user' => $collect ?? null,
            'message' => __('dashboard-admin/user.index.modal.simple-show.message')
        ]);
    }
}