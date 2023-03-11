<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    /**
     * Prepare a date for array / JSON serialization.
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d/m/Y H:i');
    }

    /**
     * Get the author of the post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Get the phone associated with the user.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class)->withDefault();
    }

    /**
     * Get the phone associated with the user.
     */
    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class)->withDefault();
    }

    /**
     * Get all of the votes for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Get all of the positive votes for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function positiveVotes(): HasMany
    {
        return $this->votes()->where('vote', true);
    }

    /**
     * Get all of the negative votes for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function negativeVotes(): HasMany
    {
        return $this->votes()->where('vote', false);
    }

    /**
     * Get all of the follows for the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function follows(): HasMany
    {
        return $this->hasMany(Follow::class);
    }

    /**
     * Create post in the database.
     * 
     * @static
     * @param array $post Recieves type, gender and name by safe request
     * @return Post
     */
    public static function createPost(array $post): Post
    {
        $p = new Post;
        $p->conclued = false;
        $p->type_id = $post['type'];
        $p->gender_id = $post['gender'];
        $p->name = $post['name'];
        $p->user_id = Auth::user()->id;
        $p->created_at = Carbon::now()->format('Y-m-d H:i:s');
        $p->save();

        return $p;
    }

    /**
     * Update post in the database.
     * 
     * @static
     * @param string $id PostId
     * @param array $post Recieves type, gender and name by safe request
     * @return Post
     */
    public static function updatePost(string $id, array $post): Post
    {
        $p = Post::findOrFail($id);
        $p->type_id = $post['type'];
        $p->gender_id = $post['gender'];
        $p->name = $post['name'];
        $p->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        $p->save();

        return $p;
    }

    /** 
     * Destroy post in the database.
     * 
     * @static
     * @param string $id PostId
     * @return void
     */
    public static function deletePost(string $id): void
    {
        $p = Post::findOrFail($id);
        $p->delete();
    }

    /** 
     * Destroy post in the database.
     * 
     * @static
     * @param string $id PostId
     * @return Post
     */
    public static function setConcluedPost(string $id): Post
    {
        $p = Post::findOrFail($id);
        $p->conclued = true;
        $p->save();

        return $p;
    }
}
