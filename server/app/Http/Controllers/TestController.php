<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class TestController extends Controller
{
    public function index()
    {
        $countries = Country::get();

        return $countries;

        // return view('main', compact('countries'));
    }
}
