<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Review;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\imageRequest;

class ReviewController extends Controller
{
    //ログインユーザーレビュー追加orアップデート
    public function createReview(ReviewRequest $request)
    {
        if ($file = $request->imgpath) {
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }

        $check = Review::UpdateOrCreate(
            [
                'user_id' => $request->user_id,
                'country_id' => $request->country_id,
            ],
            [
                'recommend' => $request->recommend,
                'safe' => $request->safe,
                'cost' => $request->cost,
                'fun' => $request->fun,
                'tourism' => $request->tourism,
                'food' => $request->food,
                'english' => $request->english,
                'city' => $request->city,
                'review' => $request->review,
                'imgpath' => $fileName,
            ]
        );

        if ($check->wasRecentlyCreated) {
            $message = 'レビューを追加しました';
        } else {
            $message = 'レビューを変更しました';
        }

        session()->flash('flash_message', $message);
    }

    //レビュー削除
    public function delete(Request $request)
    {
        $review = Review::findOrFail($request->id);
        $review->delete();

        session()->flash('flash_message', 'レビューを削除しました');

        return back();
    }

    //画像アップロード
    public function upload(imageRequest $request)
    {
        if ($file = $request->imgpath) {
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }

        $check = Image::create(
            [
                'user_id' => $request->user_id,
                'country_id' => $request->country_id,
                'imgpath' => $fileName,
            ]
        );

        if ($check->wasRecentlyCreated) {
            $message = '画像を追加しました';
        } else {
            $message = '画像アップロードを失敗しました';
        }

        session()->flash('flash_message', $message);

        return back();
    }
}
