<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request) {

        $id = Auth::id();

        $user = User::with('group')->findOrFail($id);

        return response()->json($user);
    }
}
