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

class UserType extends Model implements AuthenticatableContract, AuthorizableContract,
                                    CanResetPasswordContract
                                    
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_type';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'games',
        'art',
        'music',
        'building_stuff',
        'educational',
    ];

    public function userType()
    {
        return $this->belongsToMany('Yeayurdev\Models\User', 'user_type', 'user_id', 'user_id');
    }

}
