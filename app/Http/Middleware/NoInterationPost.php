<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoInterationPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $post = Post::find($request->route()->parameter('id'));

        if ($post->votes->count() > 0 || $post->follows->count() > 0)
            abort(401, 'Unauthorized');

        return $next($request);
    }
}
