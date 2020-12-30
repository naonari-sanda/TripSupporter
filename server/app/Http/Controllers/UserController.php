<?php

namespace App\Http\Controllers;

use Session;
use App\Models\User;
use App\Models\Acount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class UserController extends Controller
{
    //ログインユーザーぺージ表示
    public function index()
    {
        $user = Auth::user();

        return view('pages.user', compact('user'));
    }

    //ユーザーの詳細情報追加
    public function create(ProfileRequest $request)
    {
        if ($file = $request->icon) {
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }

        $check = Acount::UpdateOrCreate(
            [
                'user_id' => $request->user_id,
            ],
            [
                'gender' => $request->gender,
                'age' => $request->age,
                'profile' => $request->profile,
                'hobby' => $request->hobby,
                'icon' => $fileName
            ]
        );

        if ($check->wasRecentlyCreated) {
            $message = 'プロフィールを追加しました';
        } else {
            $message = 'プロフィールを変更しました';
        }

        session()->flash('flash_message', $message);
    }

    //ユーザー一覧表示
    public function list()
    {
        $users = User::all();

        return view('pages.user_list', compact('users'));
    }


    //ユーザーページ表示
    public function user(int $id)
    {
        $user = User::findOrFail($id);

        return view('pages.user', compact('user'));
    }
}
