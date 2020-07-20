<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Question;
use App\Models\Us;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 235660542
        $res = file_get_contents('https://www.instagram.com/serenomoreno_cafe?__a=1');
        $res = json_decode($res);
        $posts = $res->graphql->user->edge_owner_to_timeline_media->edges;

        return view('front')
            ->with([
                'plans' => Plan::all(),
                'questions' => Question::all(),
                'us' => Us::where('position', config('constants.us'))->get()->last(),
                'month' => Us::where('position', config('constants.month'))->get()->last(),
                'instaPosts' => $posts,
            ]);
    }
}
