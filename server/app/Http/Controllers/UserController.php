<?php

namespace App\Http\Controllers;

use Session;
use Storage;
use App\Models\User;
use App\Models\Acount;
use Illuminate\Http\Request;
use App\Http\Requests\AcountRequest;

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

    //プロフィール情報追加
    public function create(AcountRequest $request)
    {
        if ($file = $request->icon) {
            $path = Storage::disk('s3')->put('/', $file, 'public');
            $fileName = Storage::disk('s3')->url($path);
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
            session()->flash('success_message', 'プロフィールを追加しました');
        } else {
            session()->flash('info_message', 'プロフィールを変更しました');
        }
    }

    //プロフィール情報削除
    public function delete(Request $request)
    {
        $acount = Acount::findOrFail($request->id);

        $check = $acount->delete();

        if ($check > 0) {
            session()->flash('success_message', 'プロフィール情報を削除しました');
        } else {
            session()->flash('danger_message', '削除に失敗しました');
        }

        return back();
    }
}
