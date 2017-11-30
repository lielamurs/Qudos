<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    public function management(){
        $news = DB::table('news')
            //->join('users', 'feedback.user_id', '=' , 'users.id')
            ->get();

        $feedback = DB::table('feedback')
            //->join('users', 'feedback_comments.user_id', '=', 'users.id')
            ->get();

        $suggestions = DB::table('suggestions')
            //->join('users', 'feedback_comments.user_id', '=', 'users.id')
            ->get();

        return view('Posts.management', ['news' => $news, 'feedbacks' => $feedback, 'suggestions'=> $suggestions]);
    }
}
