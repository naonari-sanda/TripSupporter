<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Review;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\ImageRequest;

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
            session()->flash('success_message', 'レビューを追加しました');
        } else {
            session()->flash('info_message', 'レビューを変更しました');
        }
    }

    //レビュー削除
    public function delete(Request $request)
    {
        $review = Review::findOrFail($request->id);
        $delete = $review->delete();

        if($delete > 0) {
            session()->flash('success_message', 'レビューを削除しました');
        } else {
            session()->flash('danger_message', '削除に失敗しました');
        }

        return back();
    }

    //画像アップロード
    public function upload(ImageRequest $request)
    {
        if ($file = $request->imgpath) {
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }

        Image::create(
            [
                'user_id' => $request->user_id,
                'country_id' => $request->country_id,
                'imgpath' => $fileName,
            ]
        );

        session()->flash('success_message', '画像を追加しました');
    }

    public function deleteImg(Request $request)
    {
        $img = Image::findOrFail($request->id);
        $delete = $img->delete();

        if($delete > 0) {
            session()->flash('success_message', '画像を削除しました');
        } else {
            session()->flash('danger_message', '削除に失敗しました');
        }

        return back();
    }
}
