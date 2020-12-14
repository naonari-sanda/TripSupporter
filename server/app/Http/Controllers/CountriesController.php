<?php

namespace App\Http\Controllers;



use App\Models\User;
use App\Models\Like;
use App\Models\Review;
use App\Models\Country;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class CountriesController extends Controller
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

        return view('pages.detail', ['id' => $country->id], compact('country', 'user'));

        // return view('detail', compact('country', 'reviews'));
    }
}
