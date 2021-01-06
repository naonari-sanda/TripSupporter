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
    //ユーザーページ表示
    public function index(int $id)
    {
        $user = User::findOrFail($id);

        return view('pages.user', compact('user'));
    }

    //ユーザー一覧表示
    public function list()
    {
        $users = User::all();

        return view('pages.user_list', compact('users'));
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
        if (!isset($request->hobby)) {
            $hobby = '回答なし';
        } else {
            $hobby = $request->hobby;
        }

        $check = Acount::UpdateOrCreate(
            [
                'user_id' => $request->user_id,
            ],
            [
                'gender' => $request->gender,
                'age' => $request->age,
                'profile' => $request->profile,
                'hobby' => $hobby,
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
}
