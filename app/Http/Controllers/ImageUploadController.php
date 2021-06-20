<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImageUploadController extends Controller
{
    public function upload(Request $request, $dir) {

        $request->validate([
            'image' => 'required|image|mimes:png|max:2048',
        ]);

        if ($image = $request->file('image')) {
            $profileImage = Auth::user()->username . "." . $image->getClientOriginalExtension();
            $image->move($dir, $profileImage);
        }
    }

    public function uploadSkin(Request $request) {

        $this->upload($request, 'cabinet/skins');

        return response()->json([
            'message' => 'Скин успешно загружен',
        ]);
    }

    public function uploadCloak(Request $request) {

        $this->upload($request, 'cabinet/capes');

        return response()->json([
            'message' => 'Плащ успешно загружен',
        ]);
    }


}
