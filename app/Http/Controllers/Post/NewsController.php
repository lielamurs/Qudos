<?php

namespace App\Http\Controllers\Post;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class NewsController extends Controller
{
    public function submitNews(Request $request){

        $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:500',
        ]);

        $ext = $request->file('image')->getClientOriginalExtension();

        switch ($ext){
            case "png":
                break;
            case "jpeg":
                break;
            default:
                return redirect()->back()->with('message', 'Invalid file format!');
        }


        $imageName = time().'.'.$request->file('image')->getClientOriginalExtension();

        DB::table('news')->insert(
            ['title' => $request['title'], 'content' => $request['content'] , 'image' => $imageName, 'admin_id' =>  $request['user'] ]
        );

        $request->file('image')->move('uploads', $imageName);

        return redirect()->back()->with('message', 'Upload successful!');
    }

    public function submitNewsComment(Request $request){

        $request->validate([
            'content' => 'required|string|max:500',
        ]);
        DB::table('news_comments')->insert(
            ['comment' => $request['content'] , 'user_id' =>  $request['user'], 'news_id' => $request['post']]
        );
        return redirect()->back()->with('message', 'YES!');

    }

    public function index()
    {
        $posts = DB::table('news')
            //->join('users', 'feedback.user_id', '=' , 'users.id')
            ->get();

        $comments = DB::table('news_comments')
            //->join('users', 'feedback_comments.user_id', '=', 'users.id')
            ->get();

        return view('Posts.news', ['posts' => $posts, 'comments' => $comments]);
    }
}
