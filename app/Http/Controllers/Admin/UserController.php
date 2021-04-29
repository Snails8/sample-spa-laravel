<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * ユーザー一覧を返す
     * @Method GET
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = User::all();

        return response()->json($users);
    }
}
