<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
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

        session()->flash('flash_message', 'レビューを投稿しました');
    }

    public function delete(Request $request)
    {
        $review = Review::findOrFail($request->id);
        $review->delete();

        session()->flash('flash_message', 'レビューを削除しました');

        return redirect()->route('mypage');
    }
}
