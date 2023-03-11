<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Gender;
use App\Models\Type;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('posts.all', [
            'posts' => Post::where('conclued', false)
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    /**
     * Show all Posts from auth User
     */
    public function history(): View
    {
        return view('posts.all', [
            'posts' => Post::whereBelongsTo(auth()->user())
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    /**
     * Show all Posts where auth User follows
     */
    public function followed(): View
    {
        return view('posts.all', [
            'posts' => Post::whereHas('follows', function (Builder $query) {
                    $query->where('user_id', '=', auth()->user()->id)
                        ->where('conclued', false);
                })
                ->orWhereHas('votes', function (Builder $query) {
                    $query->where('user_id', '=', auth()->user()->id)
                        ->where('conclued', false);
                })
                ->orderBy('id', 'desc')
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('posts.create', [
            'types' => Type::all(),
            'genders' => Gender::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        Post::createPost($request->safe()->all());

        return redirect(route('posts.index'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        return view('posts.edit', [
            'post' => Post::find($id),
            'types' => Type::all(),
            'genders' => Gender::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, string $id): RedirectResponse
    {
        Post::updatePost($id, $request->safe()->all());

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Post::deletePost($id);

        return redirect(route('posts.index'));
    }

    /**
     * Set the post to conclued, now they're find in the History User.
     */
    public function conclued(string $id): RedirectResponse
    {
        Post::setConcluedPost($id);

        return redirect(route('posts.index'));
    }
}
