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
        $posts = DB::table('suggestions')->get();

        return view('Posts.suggestions', ['posts' => $posts]);
    }
    public function feedback()
    {
        return view('Posts.feedback');
    }
}
