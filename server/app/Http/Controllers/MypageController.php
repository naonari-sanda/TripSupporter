<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use App\Models\Acount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('pages.mypage', compact('user'));
    }

    public function create(ProfileRequest $request)
    {
        if ($file = $request->icon) {
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }

        Acount::create([
            'user_id' => $request->user_id,
            'gender' => $request->gender,
            'age' => $request->age,
            'profile' => $request->profile,
            'hobby' => $request->hobby,
            'icon' => $fileName
        ]);

        session()->flash('flash_message', 'プロフィールを追加しました');
    }
}
