<?php

namespace Yeayurdev\Models;

use Auth;
use DB;
use Carbon\Carbon;
use Yeayurdev\Models\Post;
use Yeayurdev\Models\Fan;
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

    /* Create custom Algolia index */
    public $indices = ['profilesAndFans'];

    public static $autoIndex = true;
    public static $autoDelete = true;
    public static $objectIdKey = 'algolia_id';

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
        'username',
        'twitch_username',
        'image_path',
        'image_upload',
        'about_me',
        'streamer_details',
        'algolia_id',
        'post_notification',
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

    public function getAlgoliaRecord()
    {
        return array_merge($this->toArray(), [
            'username' => $this->username,
            'image_path' => $this->image_path,
            'about_me' => $this->about_me,
            'streamer_details' => $this->streamer_details,
            'followers_count' => $this->followers_count
        ]);
    }

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
        if ($this->twitch_username)
        {
            return "{$this->twitch_username}";
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

        // If user has uploaded an image, return the S3 bucket, else return absolute URL provided by Twitch
        if ($this->image_upload === 1)
        {
            $url = 'https://s3-us-west-2.amazonaws.com/'.env('S3_BUCKET').'/images/profile/';

            return "$url{$this->image_path}";
        }

        return "{$this->image_path}";
            
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

    // Return array of IDs for user's Auth user is following
    public function followingId()
    {
        return DB::table('connections')->where('user_id', Auth::user()->id)->whereNotIn('connection_id', [0])->lists('connection_id');
    }

    // Return array of IDs for the fan pages Auth user is following
    public function fanPagesId()
    {
        return DB::table('connections')->where('user_id', Auth::user()->id)->whereNotNull('fan_page_id')->lists('fan_page_id');
    }

    public function followers()
    {
        return $this->belongsToMany('Yeayurdev\Models\User', 'connections', 'connection_id', 'user_id');
    }

    public function followerId()
    {
        return DB::table('connections')->where('connection_id', Auth::user()->id)->lists('user_id');
    }

    public function fanPages()
    {
        return $this->belongsToMany('Yeayurdev\Models\Fan', 'connections', 'user_id', 'fan_page_id');
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
    // Profiles that $user has visited
    public function profileVisits()
    {
        return $this->BelongsToMany('Yeayurdev\Models\User', 'recently_visited', 'visitor_id', 'profile_id')->orderBy('times_visited', 'desc')->take(5);
    }

    public function fanPageVisits()
    {
        return $this->BelongsToMany('Yeayurdev\Models\Fan', 'recently_visited', 'visitor_id', 'fan_page_id')->orderBy('times_visited', 'desc')->take(5);
    }

    public function myProfileViews()
    {
        return DB::table('recently_visited')->where('profile_id', $this->id)->sum('times_visited');
    }

    public function addProfileVisits(User $user)
    {
        $this->profileVisits()->attach($user->id);

        DB::table('recently_visited')
            ->where('profile_id',$user->id)
            ->where('visitor_id',Auth::user()->id)
            ->increment('times_visited', 1, ['last_visit' => Carbon::now()]);
    }

    public function addFanPageVisits(Fan $fan)
    {
        $this->fanPageVisits()->attach($fan->id);

        DB::table('recently_visited')
            ->where('fan_page_id',$fan->id)
            ->where('visitor_id',Auth::user()->id)
            ->increment('times_visited', 1, ['last_visit' => Carbon::now()]);
    }

    public function previouslyVisited(User $user)
    {
        return (bool) $this->profileVisits()->get()->where('id', $user->id)->count();
    }

    public function previouslyVisitedFan(Fan $fan)
    {
        return (bool) $this->fanPageVisits()->get()->where('id', $fan->id)->count();
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
        return $this->belongsToMany('Yeayurdev\Models\User', 'notifications_user', 'user_id', 'notifier_id')->withPivot('notification_type', 'created_at', 'id', 'viewed', 'fan_page', 'profile_name')->orderBy('pivot_created_at', 'desc');
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
