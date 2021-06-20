<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(Request $request) {

        $id = Auth::id();

        $user = User::with('group')->findOrFail($id);

        return response()->json($user);
    }

    public function changePassword(Request $request) {

        $id = Auth::id();
        $user = User::findOrFail($id);

        if (empty($user)) {
            throw new \Exception('Forbidden', 403);
        }

        $rules = [
            'old_password' => ['required'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

        $messages = [
            'old_password.required' => 'Укажите свой текущий пароль',
            'new_password.required' => 'Укажите новый пароль',
            'new_password.confirmed' => 'Пароли не совпадают',
            'new_password.*' => 'Проверьте правильность введенных данных'
        ];

        $validatedFields = $request->validate($rules, $messages);


        $check = \Hash::check($validatedFields['old_password'], $user->password);

        if(!$check) {
            return response()->json([
                'message' => 'Проверьте правильность введенного пароля',
                'errors' => 'Unprocessable Entity'
            ], 422);
        }

        $data = [
            'password' => bcrypt($validatedFields['new_password'])
        ];

        DB::beginTransaction();

        try {
            $user->update($data);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage(), 500);
        }

        return response()->json([
            'message' => 'Пароль был успешно изменен',
        ]);

    }

    public function activate(Request $request) {

        $code = $request->get('activation_code');

        $user = User::query()
            ->where('activation_code', 'like', $code)
            ->get();

        dd($user);

        if (empty($user)) {
            throw new \Exception('Forbidden', 403);
        }

        DB::beginTransaction();

        try {
            $user->update([
                'activation_code' => null,
            ]);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw new \Exception($exception->getMessage(), 500);
        }

        return response()->json([
            'message' => 'Аккаунт был успешно активирован',
        ]);


    }
}
