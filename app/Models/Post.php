<?php

namespace Yeayurdev\Models;

use DB;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Post extends Model
                                    
{

    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      	'body',
		'profile_id'
    ];

    public function user()
    {
    	return $this->belongsTo('Yeayurdev\Models\User', 'user_id');
    }

    public function likes()
    {
        return $this->morphMany('Yeayurdev\Models\Like', 'likeable');
    }
}
