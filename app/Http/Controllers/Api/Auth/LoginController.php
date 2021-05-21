<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{

    public $headers_for_forum = [
        'XF-Api-Key' => 'i6R3z6e8k4wkpFyxHY9zxyQri_hlriSz',
        'Content-Type' => 'application/x-www-form-urlencoded'
    ];

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {

        $name = $request->input('username') ? 'username' : 'email';

        $credentials = $request->only($name, 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'You cannot sign with those credentials',
                'errors' => 'Unauthorised'
            ], 401);
        }

//        $response = Http::withHeaders(
//            $this->headers_for_forum
//        )->asForm()
//            ->post('http://ru.caelestis.api/forum/api/auth/', [
//                'login' => $request->input('username'),
//                'password' => $request->input('password'),
//            ]);
//
//
//        $user_id = $response['user']['user_id'];
//
//        $response = Http::withHeaders(
//            $this->headers_for_forum
//        )->asForm()
//            ->post('http://ru.caelestis.api/forum/api/auth/login-token', [
//                'user_id' => $user_id,
//                'limit_ip' => '127.0.0.1',
//                'remember' => $request->remember_me
//            ])->json();
//



        $token = Auth::user()->createToken(config('app.name'));

        $token->token->expires_at = $request->remember_me ?
            Carbon::now()->addMonth() :
            Carbon::now()->addDay();

        $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
//            'forum' => $response
        ], 200);
    }
}
