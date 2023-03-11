<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get all of the posts for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get all of the votes for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    /**
     * Get all of the follows for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function follows(): HasMany
    {
        return $this->hasMany(Follow::class);
    }

    /**
     * Check if User has positive votted the Post
     * 
     * @param Post $post
     * @return bool
     */
    public function hasPositiveVoted(Post $post): bool
    {
        return $post->positiveVotes->contains('user_id', $this->id);
    }

    /**
     * Check if User has positive votted the Post
     * 
     * @param Post $post
     * @return bool
     */
    public function hasNegativeVoted(Post $post): bool
    {
        return $post->negativeVotes->contains('user_id', $this->id);
    }

    /**
     * User votes positive in a Post
     * 
     * @param Post $post
     * @return void
     */
    public function votePositive(Post $post): void
    {
        if ($post->conclued) return;

        if ($this->hasPositiveVoted($post)) {
            Vote::destroy($post->positiveVotes->where('user_id', $this->id));
        } else {
            if ($this->hasNegativeVoted($post))
                Vote::destroy($post->negativeVotes->where('user_id', $this->id));

            $vote = new Vote;
            $vote->user_id = $this->id;
            $vote->vote = true;
            $vote->post_id = $post->id;
            $vote->save();
        }
    }

    /**
     * User votes negative in a Post
     * 
     * @param Post $post
     * @return void
     */
    public function voteNegative(Post $post): void
    {
        if ($post->conclued) return;

        if ($this->hasNegativeVoted($post)) {
            Vote::destroy($post->negativeVotes->where('user_id', $this->id));
        } else {
            if ($this->hasPositiveVoted($post))
                Vote::destroy($post->positiveVotes->where('user_id', $this->id));
            
            $vote = new Vote;
            $vote->user_id = $this->id;
            $vote->vote = false;
            $vote->post_id = $post->id;
            $vote->save();
        }
    }

    /**
     * Check if User has following the Post
     *
     * @param Post $post
     * @return bool
     */
    public function hasFollowing(Post $post): bool
    {
        return $post->follows->contains('user_id', $this->id);
    }

    /**
     * User follows a Post
     * 
     * @param Post $post
     * @return void
     */
    public function follow(Post $post): void
    {
        if ($post->conclued) return;

        if ($this->hasFollowing($post)) {
            Follow::destroy($post->follows->where('user_id', $this->id));
        } else {            
            $follow = new Follow;
            $follow->user_id = $this->id;
            $follow->post_id = $post->id;
            $follow->save();
        }
    }
}
