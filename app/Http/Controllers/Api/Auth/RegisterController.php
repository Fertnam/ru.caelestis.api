<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\Models\User;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * @param RegisterFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function __invoke(RegisterFormRequest $request)
    {

        $user = User::create(array_merge(
            $request->only('username', 'email'),
            ['password' => bcrypt($request->password)],
            ['activation_code' => Str::random(15)],
            ['group_id' => 1]
        ));

        return response()->json([
            'message' => 'You were successfully registered. Use your email and password to sign in.'
        ], 200);

    }
}
