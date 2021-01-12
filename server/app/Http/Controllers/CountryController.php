<?php

namespace App\Http\Controllers;



use App\Models\User;
use App\Models\Like;
use App\Models\Review;
use App\Models\Country;
use App\Models\Information;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class CountryController extends Controller
{

    //メインページ表示
    public function index(Request $request)
    {

        $countries = Country::paginate(12);

        $information = Information::orderBy('created_at', 'desc')->first();

        $user_id = Auth::id();


        $like = Like::where('user_id', $user_id)->first();
        if (!isset($like)) {
            $like['check'] = false;
        } else {
            $like['check'] = true;
        }
        return view('pages.main', compact('countries', 'like', 'information'));
    }

    //国詳細ページ
    public function detail(int $id, Review $review)
    {
        $user_id = Auth::id();
        $country = Country::findOrFail($id);
        $user = User::where('id', $user_id)->first();

        return view('pages.detail', ['id' => $country->id], compact('country'));
    }

    //国検索
    public function serch(Request $request)
    {
        $cotegory = $request->category;
        $special = $request->special;
        $keyword = $request->keyword;

        $information = Information::orderBy('created_at', 'desc')->first();

        $query = Country::query();

        if (!empty($cotegory)) {
            $query->where('comment', 'like', '%' . $cotegory . '%');
            if ($cotegory == 'ajia') {
                $message = 'アジア圏';
            } elseif ($cotegory == 'eu') {
                $message = 'ヨーロッパ圏';
            } elseif ($cotegory == 'northa') {
                $message = '北米';
            } elseif ($cotegory == 'latin') {
                $message = '南米';
            } elseif ($cotegory == 'ocea') {
                $message = 'オセアニア圏';
            } elseif ($cotegory == 'africa') {
                $message = 'アフリカ圏';
            } elseif ($cotegory == 'easta') {
                $message = '中東';
            }
        }

        if (!empty($special)) {
            $query->where('comment', 'like', '%' . $special . '%');

            if ($special == 'corona') {
                $message = '入国可能国（コロナ渦）';
            } elseif ($special == 'wh') {
                $message = 'ワーキングホリデー協定国';
            }
        }

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
            $message = $keyword;
        }

        $countries = $query->orderBy('created_at', 'desc')->paginate(12);

        if (count($countries) == 0) {
            session()->flash('danger_message', '検索結果がありません');
            $message = '検索結果がありません';
        } elseif (!empty($message)) {
            session()->flash('info_message', $message . 'を検索をしました');
        }

        return view('pages.main', compact('countries', 'information', 'message'));
    }

    public function ranking()
    {
        return view('pages.ranking');
    }

    public function area()
    {
        return Country::orderBy('area', 'desc')->get();
    }

    public function population()
    {
        return Country::orderBy('population', 'desc')->get();
    }

    public function gdp()
    {
        return Country::orderBy('gdp', 'desc')->get();
    }

    public function happiness()
    {
        return Country::orderBy('happiness', 'desc')->get();
    }
}
