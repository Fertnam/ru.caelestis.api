<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    private $key = 'wjGXZ}g^]dyL8[AZUtvunw=je$xwz$lw>v!keUrZuzJmY}ZTyzgwm5xJVQ/i#(y]';

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {

        $login = $request->input('username');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email':'username';
        $request->merge([$field => $login]);

        $credentials = $request->only($field, 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Неверный логин или пароль',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $user = Auth::user();

        if (!empty($user->activation_code)) {
            return response()->json([
                'message' => 'Аккаунт не активирован',
                'errors' => 'Unauthorised'
            ], 401);
        }

        $token = $user->createToken(config('app.name'));

        $token->token->expires_at = $request->remember_me ?
            Carbon::now()->addMonth() :
            Carbon::now()->addDay();

        $token->token->save();

        return response()->json([
            'token_type' => 'Bearer',
            'token' => $token->accessToken,
            'expires_at' => Carbon::parse($token->token->expires_at)->toDateTimeString(),
        ], 200);
    }

    public function authOnLauncher(Request $request) {

        $login = $request->input('username');
        $key = $request->get('key');

        if (strcmp($key, $this->key) !== 0) {
            return response('Ошибка авторизации, пожалуйста свяжитесь с Администрацией!', 500)
                ->header('Content-Type', 'text/plain');
        }

        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email':'username';
        $request->merge([$field => $login]);

        $credentials = $request->only($field, 'password');

        if (!Auth::attempt($credentials)) {
            return response('Неверный логин или пароль', 401)
                ->header('Content-Type', 'text/plain');
        }

        $user = Auth::user();

        if (!empty($user->activation_code)) {
            return response('Аккаунт не активирован', 401)
                ->header('Content-Type', 'text/plain');
        }

        return response("OK:{$user->username}")
            ->header('Content-Type', 'text/plain');
    }
}
