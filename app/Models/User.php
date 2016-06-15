<?php

namespace Yeayurdev\Models;

use Auth;
use DB;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\Notification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Passwords\CanResetPassword;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract,
                                    CanResetPasswordContract
                                    
{
    use Authenticatable, Authorizable, CanResetPassword, AlgoliaEloquentTrait;

    /* Create environment-specific index */
    public static $perEnvironment = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'confirm_password',
        'birthdate',
        'username',
        'agreed_terms',
        'image_path',
        'about_me'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token'
    ];

    public function getEmail()
    {
        if ($this->email)
        {
            return "{$this->email}";
        }
    }

    public function getUsername()
    {
        if ($this->username)
        {
            return "{$this->username}";
        }
    }

    public function getTwitchChannel()
    {
        if ($this->twitch_url)
        {
            return "{$this->twitch_url}";
        }
    }

    public function getYoutubeId()
    {
        if ($this->youtube_url)
        {
            return "{$this->youtube_url}";
        }
    }

    public function getYoutubeUsername()
    {
        if ($this->youtube_username)
        {
            return "{$this->youtube_username}";
        }
    }

    public function getImagePath()
    {
        if (!$this->image_path)
        {
            return "";
        }    
            $url = 'https://s3-us-west-2.amazonaws.com/'.env('S3_BUCKET').'/images/';

            return "$url{$this->image_path}";
    }

    public function getAboutMe()
    {
        if ($this->username)
        {
            return "{$this->about_me}";
        }
    }

    public function following()
    {
        return $this->BelongsToMany('Yeayurdev\Models\User', 'connections', 'user_id', 'connection_id');
    }

    // Return array of IDs for user's Auth users is following
    public function followingId()
    {
        return DB::table('connections')->where('user_id', Auth::user()->id)->lists('connection_id');
    }

    public function followers()
    {
        return $this->belongsToMany('Yeayurdev\Models\User', 'connections', 'connection_id', 'user_id');
    }

    public function followerId()
    {
        return DB::table('connections')->where('connection_id', Auth::user()->id)->lists('user_id');
    }

    public function addConnection(User $user)
    {
        $this->following()->attach($user->id);
    }

    public function removeConnection(User $user)
    {
        $this->following()->detach($user->id);
    }

    public function isFollowing(User $user)
    {
        return (bool) $this->following()->get()->where('id', $user->id)->count();
    }

    public function countFollowers() 
    {
        return $this->followers()->get()->count();
    }

    public function posts()
    {
        return $this->hasMany('Yeayurdev\Models\Post', 'user_id');
    }

    public function likes()
    {
        return $this->hasMany('Yeayurdev\Models\Like', 'user_id');
    }

    public function profileVisits()
    {
        return $this->BelongsToMany('Yeayurdev\Models\User', 'recently_visited', 'visitor_id', 'profile_id')->orderBy('times_visited', 'desc')->take(5);
    }

    public function addProfileVisits(User $user)
    {
        $this->profileVisits()->attach($user->id);
    }

    public function previouslyVisited(User $user)
    {
        return (bool) $this->profileVisits()->get()->where('id', $user->id)->count();
    }

    public function UserType()
    {
        return $this->BelongsToMany('Yeayurdev\Models\Type', 'user_type', 'user_id', 'type_id');
    }

    public function hasLikedPost(Post $post)
    {
        return (bool) $post->likes
            ->where('user_id', $this->id)
            ->count();
    }

    public function notifications()
    {
        return $this->belongsToMany('Yeayurdev\Models\User', 'notifications_user', 'user_id', 'notifier_id')->withPivot('notification_type', 'created_at', 'id', 'viewed')->orderBy('pivot_created_at', 'desc');
    }

    public function getNewNotifications()
    {
        return DB::table('notifications_user')->where('user_id', Auth::user()->id)->where('viewed', 0)->count();
    }

    /**
     *  Fan Page Methods
     */

    public function followingFanPage()
    {
        return $this->BelongsToMany('Yeayurdev\Models\Fan', 'connections', 'user_id', 'fan_page_id');
    }

    public function isFollowingFanPage($fan)
    {
        return (bool) $this->followingFanPage()->get()->where('id', $fan->id)->count();
    }

}
