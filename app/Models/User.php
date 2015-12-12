<?php

namespace Yeayurdev\Models;

use DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract
                                    
{
    use Authenticatable;

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
}
