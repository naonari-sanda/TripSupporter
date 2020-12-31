<?php

namespace App\Http\Controllers;



use App\Models\User;
use App\Models\Like;
use App\Models\Review;
use App\Models\Country;
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


        $user_id = Auth::id();


        $like = Like::where('user_id', $user_id)->first();
        if (!isset($like)) {
            $like['check'] = false;
        } else {
            $like['check'] = true;
        }

        return view('pages.main', compact('countries', 'like'));
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

        $query = Country::query();

        if (!empty($cotegory)) {
            $query->where('comment', 'like', '%' . $cotegory . '%');
        }

        if (!empty($special)) {
            $query->where('comment', 'like', '%' . $special . '%');
        }

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        $countries = $query->orderBy('created_at', 'desc')->paginate(12);

        if (count($countries) == 0) {
            session()->flash('danger_message', '検索結果がありません');
        } else {
            session()->flash('flash_message', '検索に成功しました');
        }



        return view('pages.main', compact('countries'));
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
