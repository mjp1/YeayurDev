<?php

namespace Yeayurdev\Models;

use DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract,
                                    CanResetPasswordContract
                                    
{
    use Authenticatable, Authorizable, CanResetPassword;

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

    public function getUsername()
    {
        if ($this->username)
        {
            return "{$this->username}";
        }
    }

    public function getImagePath()
    {
        if ($this->username)
        {
            return "{$this->image_path}";
        }
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

    public function followers()
    {
        return $this->belongsToMany('Yeayurdev\Models\User', 'connections', 'connection_id', 'user_id');
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

}
