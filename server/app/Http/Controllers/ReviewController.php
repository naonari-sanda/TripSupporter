<?php

namespace App\Http\Controllers;

use Session;
use Storage;
use Illuminate\Http\File;
use \InterventionImage;

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
            $path = Storage::disk('s3')->put('/', $file, 'public');
            $fileName = Storage::disk('s3')->url($path);
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
                'imgpath' => $fileName
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
        $check = $review->delete();

        if ($check) {
            session()->flash('success_message', 'レビューを削除しました');
        } else {
            session()->flash('danger_message', '削除に失敗しました');
        }

        return back();
    }

    //画像アップロード
    public function upload(ImageRequest $request)
    {
        if ($file = $request->file('imgpath')) {

            $file_path = storage_path('app/temp');

            $img = \InterventionImage::make($file)->resize(300, 150)->save($file_path . '/test.jpg');


            $path = Storage::disk('s3')->putFile('/test', new File($file_path . '/test.jpg'), 'public');

            $fileName = Storage::disk('s3')->url($path);
        }

        $check = Image::create(
            [
                'user_id' => $request->user_id,
                'country_id' => $request->country_id,
                'imgpath' => $fileName
            ]
        );

        if ($img) {
            session()->flash('success_message', '画像を追加しました');
        } else {
            session()->flash('danger_message', '画像の保存に失敗しました');
        }
    }

    //画像アップロード
    //   public function upload(ImageRequest $request)
    //   {
    //       if ($file = $request->file('imgpath')) {
    //           $extension = $request->file('imgpath')->getClientOriginalExtension();

    //           $img = \InterventionImage::make($file)
    //               ->resize(400, null, function ($constraint) {
    //                   $constraint->aspectRatio();
    //               })->encode($extension);

    //           $path = Storage::disk('s3')->put('/test', $img, 'public');
    //           $fileName = Storage::disk('s3')->url($path);
    //       }


    //       $check = Image::create(
    //           [
    //               'user_id' => $request->user_id,
    //               'country_id' => $request->country_id,
    //               'imgpath' => $fileName
    //           ]
    //       );

    //       if ($img) {
    //           session()->flash('success_message', '画像を追加しました');
    //       } else {
    //           session()->flash('danger_message', '画像の保存に失敗しました');
    //       }
    //   }

    public function deleteImg(Request $request)
    {
        $img = Image::findOrFail($request->id);
        $check = $img->delete();

        if ($check) {
            session()->flash('success_message', '画像を削除しました');
        } else {
            session()->flash('danger_message', '削除に失敗しました');
        }

        return back();
    }
}
