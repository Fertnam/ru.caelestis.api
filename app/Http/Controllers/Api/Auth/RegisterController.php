<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

        $response_forum = Http::withHeaders([
            'XF-Api-Key' => 'i6R3z6e8k4wkpFyxHY9zxyQri_hlriSz',
            'Content-Type' => 'application/x-www-form-urlencoded'
        ])->asForm()
            ->post('http://ru.caelestis.api/forum/api/users/', [
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'api_bypass_permissions' => 1
            ]);


        $user = new User;

        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->activation_code = Str::random(15);
        $user->cs_group_id = 1;
        $user->xf_user_id = $response_forum['user']['user_id'];

        $user->save();







        return response()->json([
            'message' => 'You were successfully registered. Use your email and password to sign in.',
            'forum' => $response_forum['user']['user_id'],
        ], 200);

    }

}
