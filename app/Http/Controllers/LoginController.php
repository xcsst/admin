<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @Controller(prefix="/")
 * @Middleware("web")
 * Class LoginController
 * @package App\Http\Controllers
 */
class LoginController extends Controller
{
    /**
     * @Get("/login", as="login.login")
     * @Middleare("guest")
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        return view('login');
    }

    /**
     * @Post("/login", as="login.doLogin")
     * @Middleare("guest")
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function doLogin(LoginRequest $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect(route('index.index'));
        }

        return back()->withErrors('登录帐号或密码不正确');
    }

    /**
     * @Get("/logout", as="login.logout")
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect(route('index.index'));
    }
}
