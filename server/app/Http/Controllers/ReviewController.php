<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    //レビュー作成
    // public function createReview(ReviewRequest $request, Review $review)
    // {
    //     $data = $request->all();

    // if ($file = $request->file('img_path')) {
    //     $fileName = time() . $file->getClientOriginalName();
    //     $target_path = public_path('uploads/');
    //     $file->move($target_path, $fileName);
    // } else {
    //     $fileName = "";
    // }

    // $data['img_path'] = $fileName;

    //     $message = $review->createReview($data);

    //     $review->createReview($data);
    //     Session::flash('flash_message', $message);
    //     // $review = $review->createReview($data);
    //     // return response()->json(['review' => $review]);
    // }

    public function createReview(ReviewRequest $request)
    {
        if ($file = $request->imgpath) {
            $fileName = time() . '.' . $file->getClientOriginalName();
            $file->storeAs('public', $fileName);
        } else {
            $fileName = '';
        }

        Review::create([
            'user_id' => $request->user_id,
            'country_id' => $request->country_id,
            'recommend' => $request->recommend,
            'safe' => $request->safe,
            'cost' => $request->cost,
            'fun' => $request->fun,
            'tourism' => $request->tourism,
            'food' => $request->food,
            'english' => $request->english,
            'review' => $request->review,
            'imgpath' => $fileName,
        ]);

        Session::flash('flash_message', 'レビューを投稿しました');

        return redirect()->route('detail', ['id' => $request->country_id]);
    }
}
