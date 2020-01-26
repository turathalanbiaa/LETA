<?php


namespace App\Http\Repositories;


use App\Http\Interfaces\AdminRepositoryInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Cookie;

class AdminRepository implements AdminRepositoryInterface
{
    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function getAdmin($username, $password)
    {
        // TODO: Implement getAdmin() method.
        $admin = $this->admin
            ->where('username', $username)
            ->where('password', md5($password))
            ->first();

        return $admin;
    }

    public function generateSession(Admin $admin)
    {
        // TODO: Implement generateSession() method.
        $this->updateLoginDate($admin);
        session()->put('eta.admin.id', $admin->id);
        session()->put('eta.admin.name', $admin->name);
        session()->put('eta.admin.lang', $admin->lang);
        session()->put('eta.admin.username', $admin->username);
        session()->put('eta.admin.token', $admin->remember_token);
        session()->put('eta.admin.roles', $admin->roles
            ->pluck("name")
            ->toArray()
        );
        session()->save();
    }

    public function generateCookie(Admin $admin)
    {
        // TODO: Implement generateCookie() method.
        Cookie::queue(cookie()->forever("ETA-Admin", $admin->remember_token));
    }

    public function getByCookie()
    {
        // TODO: Implement getAdminByCookie() method.
        $admin = $this->admin
            ->where("remember_token", decrypt(Cookie::get("ETA-Admin"), false))
            ->first();

        return $admin;
    }

    public function removeCookie()
    {
        // TODO: Implement removeCookie() method.
        Cookie::queue(cookie()->forget("ETA-Admin"));
    }

    public function updateLoginDate(Admin $admin)
    {
        if (is_null($admin->remember_token))
            $admin->remember_token = hash_hmac("sha256",md5(microtime(true).mt_Rand()),bcrypt($admin->email));
        $admin->last_login_date = date("Y-m-d");
        $admin->save();
    }
}