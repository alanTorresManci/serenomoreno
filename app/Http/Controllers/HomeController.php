<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Question;
use App\Models\Client;
use App\Models\Product;
use App\Models\Text;
use App\User;
use Ixudra\Curl\Facades\Curl;


class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $res = Curl::to('https://www.instagram.com/serenomoreno_cafe/?__a=1')->asJson()->get();
        $posts = $res->graphql->user->edge_owner_to_timeline_media->edges;

        return view('front')
            ->with([
                'plans' => Plan::all(),
                'questions' => Question::all(),
                'us' => Text::where('position', config('constants.us'))->get()->last(),
                'month' => Text::where('position', config('constants.month'))->get()->last(),
                'products' => Product::all(),
                'instaPosts' => $posts,
            ]);
    }

}
