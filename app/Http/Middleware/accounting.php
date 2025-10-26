<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use PharIo\Manifest\Author;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class accounting
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser=Auth::user();
        $post=Post::findOrFail($request->id);
        if($post->author !=$currentUser->id){
            return response()->json(['message','not found'],404);
        }   
        return $next($request);
    }
}
