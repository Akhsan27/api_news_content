<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostDetailResource;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
        // return response()->json(['data'=>$post]);
        return PostResource::collection($post);
    }

    public function show($id)
    {
        $show = Post::with('writer:id,username')->findOrFail($id);
        return new PostDetailResource($show);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required'
        ]);

        $request['author'] = Auth::user()->id;
        $post = Post::create($request->all());
        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }



    public function update(Request $request, $id)
    {

        $validated= $request->validate([
            'title' => 'required|max:255',
            'news_content' => 'required'
        ]);

        $post=Post::findOrFail($id);
        $post->update($request->all());

        return new PostDetailResource($post->loadMissing('writer:id,username'));
    }

    public function destroy($id) {
        $post=Post::findOrFail($id);
        $post->delete();

       return new PostDetailResource($post->loadMissing('writer:id,username'));
    }
}
