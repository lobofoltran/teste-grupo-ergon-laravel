<div x-data="{ 
    postConclued: @json($post->conclued),
    followsCount: @json($post->follows->count()),
    isFollowing: @json(auth()->user()->hasFollowing($post)),
    {{-- FOLLOW BUTTON --}}
    toggleFollow: function() {
        if (this.postConclued) return;
        {{-- UNFOLLOW --}}
        if (this.isFollowing) {
            this.followsCount --;
            this.isFollowing = false;
        } else {
            {{-- FOLLOW --}}
            this.followsCount ++;
            this.isFollowing = true;
        }
    } }">
    <a @click.prevent="toggleFollow(); $wire.toggleFollow()" :class="isFollowing ? 'btn btn-sm btn-success' : 'btn btn-sm'">
        <i class="fa-solid fa-heart mr-3"></i>
        <span x-text="followsCount"></span>
        <span class="ml-3" x-text="isFollowing ? 'Seguindo' : 'Seguir'"></span>
    </a>
</div>
