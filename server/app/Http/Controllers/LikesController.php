<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;

class LikesController extends Controller
{
    //いいね追加
    public function like($id, Request $request)
    {
        $like = Like::create([
            'user_id' => $request->user_id,
            'country_id' => $id
        ]);

        $likeCount = count(Like::where('country_id', $id)->get());

        return response()->json(['likeCount' => $likeCount]);
    }

    //いいねを取り消し
    public function unlike(int $id, Request $request)
    {
        $like = Like::where('user_id', $request->user_id)->where('country_id', $id)->delete();

        $likeCount = count(Like::where('country_id', $id)->get());


        return response()->json(['likeCount' => $likeCount]);
    }
}
