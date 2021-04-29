<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * ログイン処理
 * Class LoginController
 * @package App\Http\Controllers\Admin\Auth
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * @param Request $request
     * @param $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        return $user;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function login(Request $request)
    {
        // validation
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // login成功処理
        if ($this->attemptLogin($request, $credentials)) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);

            return response()->json(['message' => 'OK!'], 200);
        }

        return response()->json(['message' => 'ユーザーが見つかりません!'], 422);
    }

    /**
     * @param Request $request
     * @param $credentials
     * @return mixed
     */
    protected function attemptLogin(Request $request, $credentials)
    {
        return Auth::guard('api')->attempt($credentials, $request->filled('remember'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function logout(Request $request)
    {
        Auth::guard('api')->logout();

        $request->session()->invalidate();

        return response()->json(['message' => 'done logout'],200);
    }
}
