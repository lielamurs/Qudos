<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function submitSuggestion(Request $request){

        $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:500',
        ]);

        if ($request->file('image')){
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

            DB::table('suggestions')->insert(
                ['title' => $request['title'], 'content' => $request['content'] , 'image' => $imageName, 'user_id' =>  $request['user'] ]
            );

            $request->file('image')->move('uploads', $imageName);

            return redirect()->back()->with('message', 'Upload successful!');
        }else{
            DB::table('suggestions')->insert(
                ['title' => $request['title'], 'content' => $request['content'] , 'user_id' =>  $request['user'] ]
            );
            return redirect()->back()->with('message', 'Upload successful!');
        }


    }
    public function submitSuggestionComment(Request $request){

        $request->validate([
            'content' => 'required|string|max:500',
        ]);
        DB::table('suggestion_comments')->insert(
            ['comment' => $request['content'] , 'user_id' =>  $request['user'], 'suggestion_id' => $request['post']]
        );

        return redirect()->back()->with('message', 'YES!');

    }

    public function editSuggestionComment(Request $request){

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        DB::table('suggestion_comments')
            ->where('user_id',  $request['user'])
            ->where('suggestion_id', $request['post'])
            ->where('id', $request['id'])
            ->update('comment', $request['content']);


        return redirect()->back()->with('message', 'YES!');

    }


    public function submitFeedback(Request $request){

        $request->validate([
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:500',
        ]);

        if ($request->file('image')){
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

            DB::table('feedback')->insert(
                ['title' => $request['title'], 'content' => $request['content'] , 'image' => $imageName, 'user_id' =>  $request['user'] ]
            );

            $request->file('image')->move('uploads', $imageName);

            return redirect()->back()->with('message', 'Upload successful!');
        }else{
            DB::table('feedback')->insert(
                ['title' => $request['title'], 'content' => $request['content'] , 'user_id' =>  $request['user'] ]
            );
            return redirect()->back()->with('message', 'Upload successful!');
        }


    }

    public function submitFeedbackComment(Request $request){

        $request->validate([
            'content' => 'required|string|max:500',
        ]);
            DB::table('feedback_comments')->insert(
                ['comment' => $request['content'] , 'user_id' =>  $request['user'], 'feedback_id' => $request['post']]
            );

            return redirect()->back()->with('message', 'YES!');
    }

    public function editFeedbackComment(Request $request){

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        DB::table('feedback_comments')
            ->where('user_id',  $request['user'])
            ->where('feedback_id', $request['post'])
            ->where('id', $request['id'])
            ->update('comment', $request['content']);


        return redirect()->back()->with('message', 'YES!');
    }


    public function suggestionsNew()
    {
        return view('Posts.suggestionsNew');
    }


    public function feedbackNew()
    {
        return view('Posts.feedbackNew');
    }


    public function suggestions()
    {
        $posts = DB::table('suggestions')
            ->join('users', 'suggestions.user_id', '=' , 'users.id')
            ->get();

        $comments = DB::table('suggestion_comments')
            ->join('users', 'suggestion_comments.user_id', '=', 'users.id')
            ->get();

        return view('Posts.suggestions', ['posts' => $posts, 'comments' => $comments]);
    }


    public function feedback()
    {
        $posts = DB::table('feedback')
            ->join('users', 'feedback.user_id', '=' , 'users.id')
            ->get();

        $comments = DB::table('feedback_comments')
            ->join('users', 'feedback_comments.user_id', '=', 'users.id')
            ->get();

        return view('Posts.feedback', ['posts' => $posts, 'comments' => $comments]);
    }


    public function manage(Request $request){
        DB::table($request['type'])
            ->where('id', '=', $request['post'])
            ->delete();

        return redirect()->back()->with('message', 'YES!');
    }

    public function editComment($type , $id, $content){

        return view('Posts.edit', ['comment' => $content, 'type' => $type, 'id' => $id]);
    }

    public function editApply(Request $request){

        $request->validate([
            'content' => 'required|string|max:500',
        ]);
        DB::table($request['type'])
            ->where('id', $request['id'])
            ->update(['comment'=> $request['content']]);
        if ($request['type'] == 'news_comments'){
                return redirect()->route('news');
        }
        if ($request['type'] == 'feedback_comments'){
            return redirect()->route('feedback');
        }
        if ($request['type'] == 'suggestion_comments'){
            return redirect()->route('suggestions');
        }
    }

}
