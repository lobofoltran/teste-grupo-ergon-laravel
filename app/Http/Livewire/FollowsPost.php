<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class FollowsPost extends Component
{
    public Post $post;

    public function toggleFollow()
    {
        auth()->user()->follow($this->post);
    }

    public function render(): View
    {
        return view('livewire.follows-post');
    }
}
