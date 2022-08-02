<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('admin.login.show');
    }

    /**
     * Handle account login request
     *
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        if(!Auth::validate($request->validated())):
            return redirect()->to(route('admin.login'))
                ->withInput()
                ->withErrors(['auth' => trans('auth.failed', [], 'ru')]);
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($request->validated());

        Auth::login($user);

        return redirect(route('admin.index', ['period' => 7]));
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout()
    {
        session()->flush();

        Auth::logout();

        return redirect(route('admin.login'));
    }
}
