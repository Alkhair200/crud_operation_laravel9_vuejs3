<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Post::create([
            'title'=>$request->title,
            'body'=>$request->body,
        ]);
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        //
    }


    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }

    public function createPost(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'title' => 'required|max:200|min:3',
            'body' =>'required|min:5'
        ]);

        if ($validate->fails()) {
            return response()->json(['status' =>'error','errors'=>$validate->errors()]);
        }else {
            $post = Post::create([
                'title'=>$request->title,
                'body'=>$request->body,
            ]);
    
            return response()->json(['status'=>'success','data' =>$post]);
        }

    }

    public function getPost()
    {
        $posts = Post::all();
        return response()->json(['status' =>'success' ,'data' =>$posts]);
    }

    public function updatePost(Request $request,$id)
    {
        $validate = Validator::make($request->all(),[
            'title' => 'required|max:200|min:3',
            'body' =>'required|min:5'
        ]);

        if ($validate->fails()) {

            return response()->json(['status' =>'error','errors'=>$validate->errors()]);
        }else {

            $post = Post::findOrfail($id);

            $post->update([
                'title'=>$request->title,
                'body'=>$request->body,
            ]);
    
            return response()->json(['status'=>'success','data' =>$post]);
        }

    }

    public function deletePost($id)
    {
        Post::findOrfail($id)->delete();

        return response()->json(['status'=>'success']);
    }
}
