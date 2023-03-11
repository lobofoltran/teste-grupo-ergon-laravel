<div x-data="{
    postConclued: @json($post->conclued),
    positiveVotesCount: @json($post->positiveVotes->count()),
    negativeVotesCount: @json($post->negativeVotes->count()),
    isPositiveVoted: @json(auth()->user()->hasPositiveVoted($post)),
    isNegativeVoted: @json(auth()->user()->hasNegativeVoted($post)),
    {{-- POSITIVE VOTE --}}
    togglePositiveVote: function() {
        if (this.postConclued) return;
        {{-- UNVOTE --}}
        if (this.isPositiveVoted) {
            this.positiveVotesCount --;
            this.isPositiveVoted = false;
        } else {
            {{-- VOTE POSITIVE --}}
            if (this.isNegativeVoted) {
                this.negativeVotesCount --;
                this.isNegativeVoted = false;    
            }
            this.positiveVotesCount ++;
            this.isPositiveVoted = true;
        }
    },
    {{-- NEGATIVE VOTE --}}
    toggleNegativeVote: function() {
        if (this.postConclued) return;
        {{-- UNVOTE --}}
        if (this.isNegativeVoted) {
            this.negativeVotesCount --;
            this.isNegativeVoted = false;
        } else {
            {{-- VOTE NEGATIVE --}}
            if (this.isPositiveVoted) {
                this.positiveVotesCount --;
                this.isPositiveVoted = false;    
            }
            this.negativeVotesCount ++;
            this.isNegativeVoted = true;
        }
    } }">
    <a @click.prevent="togglePositiveVote(); $wire.togglePositiveVote()" :class="isPositiveVoted ? 'btn btn-sm btn-success' : 'btn btn-sm'">
        <i class="fa-solid fa-thumbs-up mr-3"></i>
        <span x-text="positiveVotesCount"></span>
    </a>
    <a @click.prevent="toggleNegativeVote(); $wire.toggleNegativeVote()" :class="isNegativeVoted ? 'btn btn-sm btn-error' : 'btn btn-sm'">
        <i class="fa-solid fa-thumbs-down mr-3"></i>
        <span x-text="negativeVotesCount"></span>
    </a>
</div>
