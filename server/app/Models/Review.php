<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    protected $guarded = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    public function createReview($data)
    {
        $sum = $data['safe'] + $data['cost'] + $data['fun'] + $data['tourism'] + $data['food'] + $data['english'];
        $recommend = $sum / 6;

        $review = $this->updateOrCreate(
            [
                'user_id' => $data['user_id'],
                'country_id' => $data['country_id']
            ],
            [
                'recommend' => $recommend,
                'safe' => $data['safe'],
                'cost' => $data['cost'],
                'fun' => $data['fun'],
                'tourism' => $data['tourism'],
                'food' => $data['food'],
                'english' => $data['english'],
                'review' => $data['review'],
                'imgpath' => $data['img_path']
            ]
        );

        if ($review->wasRecentlyCreated) {
            $message = 'レビューを追加しました';
        } else {
            $message = 'レビューを更新しました';
        }


        return $message;
    }
}
