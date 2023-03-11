<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class VotesPost extends Component
{
    public Post $post;

    public function togglePositiveVote(): void
    {
        auth()->user()->votePositive($this->post);
    }

    public function toggleNegativeVote(): void
    {
        auth()->user()->voteNegative($this->post);
    }

    public function render(): View
    {
        return view('livewire.votes-post');
    }
}
